<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\VerificacionController;
use App\Models\RegistroCliente;
use App\Models\Verificacion;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = Cliente::latest()->paginate(5);

        return view('clientes.index', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new RegistroCliente();
        $model->paso1 = 'active';
        $model->verificacion = new Verificacion;
        if (session('idVerificacion')) {
            $model->verificacion->id = session('idVerificacion');
            $model->verificacion->correo_electronico = session('correoElectronico');
        } else if (session('idValidado')) { // Paso 2: Ingreso a Datos Personales
            $model->cliente = new Cliente;
            $model->cliente->correo_electronico = session('correoElectronico');
            $model->paso2 = 'active';
        } else if (session('clienteGuardado')) { // Ingreso a Foto Selfie
            $model->cliente = new Cliente;
            $model->cliente->id = session('idCliente');
            $model->paso2 = 'active';
            $model->paso3 = 'active';
        } else if (session('selfieClienteGuardada')) { // Ingreso a Foto CI Anverso
            $model->cliente = new Cliente;
            $model->cliente->id = session('idCliente');
            $model->paso2 = 'active';
            $model->paso3 = 'active';
            $model->paso4 = 'active';
        } else if (session('anversoCiGuardado')) { // Ingreso a Foto CI Reverso
            $model->cliente = new Cliente;
            $model->cliente->id = session('idCliente');
            $model->paso2 = 'active';
            $model->paso3 = 'active';
            $model->paso4 = 'active';
            $model->paso5 = 'active';
        } else if (session('reversoCiGuardado')) { // Cuenta Creada
            $model->cliente = new Cliente;
            $model->cliente->id = session('idCliente');
            $model->paso2 = 'active';
            $model->paso3 = 'active';
            $model->paso4 = 'active';
            $model->paso5 = 'active';
        }
        return view('clientes.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($_POST['enviarCodigo'])) {
            $verificacion = (new VerificacionController)->store($request);

            return redirect()->route('clientes.create')
                ->with('correoElectronico', $request->correo_electronico)
                ->with('idVerificacion', $verificacion->id);
        }
        if (isset($_POST['validarCodigo'])) {
            $idValidado = (new VerificacionController)->validar($request);

            if ($idValidado != 0) {
                return redirect()->route('clientes.create')
                    ->with('correoElectronico', $request->correo_electronico)
                    ->with('idValidado', $idValidado);
            } else {
                return redirect()->route('clientes.create')
                    ->with('idVerificacion', -1)
                    ->with('correoElectronico', $request->correo_electronico)
                    ->with('msgCodigoIvalido', 'El C??digo de Verificaci??n es Incorrecto');
            }
        }
        if (isset($_POST['guardarCliente'])) {

            $request->validate([
                'cedula_identidad' => 'required',
            ]);

            $request->foto_selfie = '';
            $request->foto_ci_anverso = '';
            $request->foto_ci_reverso = '';
            $nuevoCliente = Cliente::create($request->all());

            return redirect()->route('clientes.create')
                ->with('idCliente', $nuevoCliente->id)
                ->with('clienteGuardado', true);
        }
        if (isset($_POST['guardarSelfie'])) {
            // dd($request);
            $selfieCliente = (new WebcamController)->store($request);

            $cliente = Cliente::find($request->idCliente);
            $cliente->foto_selfie = $selfieCliente;
            $cliente->save();

            return redirect()->route('clientes.create')
                ->with('idCliente', $request->idCliente)
                ->with('selfieClienteGuardada', true);
        }
        if (isset($_POST['guardarCiAnverso'])) {
            $anversoCi = (new WebcamController)->store($request);

            $cliente = Cliente::find($request->idCliente);
            $cliente->foto_ci_anverso = $anversoCi;
            $cliente->save();

            return redirect()->route('clientes.create')
                ->with('idCliente', $request->idCliente)
                ->with('anversoCiGuardado', true);
        }
        if (isset($_POST['guardarCiReverso'])) {
            $reversoCi = (new WebcamController)->store($request);

            $cliente = Cliente::find($request->idCliente);
            $cliente->foto_ci_reverso = $reversoCi;
            $cliente->finalizado = true;
            $cliente->save();

            $cuentaCliente = (new CuentaController)->store($request);

            return redirect()->route('clientes.create')
                ->with('idCliente', $request->idCliente)
                ->with('reversoCiGuardado', true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            // 'name' => 'required',
            // 'detail' => 'required',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
