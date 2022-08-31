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
        } else if (session('idValidado')) {
            $model->cliente = new Cliente;
            $model->cliente->correo_electronico = session('correoElectronico');
            $model->paso2 = 'active';
        }
        else if (session('datosPersonales')) {
            $model->cliente = new Cliente;
            $model->cliente->id = session('idCliente');
            $model->paso2 = 'active';
            $model->paso3 = 'active';
        }
        else if (session('selfieCliente')) {
            $model->paso2 = 'active';
            $model->paso3 = 'active';
            $model->paso4 = 'active';
        }
        else if (session('anversoCi')) {
            $model->paso2 = 'active';
            $model->paso3 = 'active';
            $model->paso4 = 'active';
            $model->paso5 = 'active';
        }
        else if (session('reversoCi')) {
            $model->paso2 = 'active';
            $model->paso3 = 'active';
            $model->paso4 = 'active';
            $model->paso5 = 'active';
            $model->paso6 = 'active';

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
                    ->with('msgCodigoIvalido', 'El Código de Verificación es Incorrecto');
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
                ->with('datosPersonales', true);
        }
        if (isset($_POST['enviarSelfie'])) {
            // dd($request);
            $selfieCliente = (new WebcamController)->store($request);

            // $cliente = Cliente::find($request->id);
            // $cliente->foto_selfie = $selfieCliente;
            // $cliente->save();

            return redirect()->route('clientes.create')
                ->with('selfieCliente', true);
        }
        if (isset($_POST['enviarCiAnverso'])) {
            $anversoCi = (new WebcamController)->store($request);

            // $cliente = Cliente::find($request->id);
            // $cliente->foto_ci_anverso = $anversoCi;
            // $cliente->save();

            return redirect()->route('clientes.create')
                ->with('anversoCi', true);
        }
        if (isset($_POST['enviarCiReverso'])) {
            $reversoCi = (new WebcamController)->store($request);

            // $cliente = Cliente::find($request->id);
            // $cliente->foto_ci_reverso = $reversoCi;
            // $cliente->save();
            
            $cuentaCliente = (new CuentaController)->store($request->id);
            // Modal cuenta creada correo con datos fue eviado

            return redirect()->route('clientes.create')
                ->with('reversoCi', true);
        }
        


        // return redirect()->route('clientes.index')
        //                 ->with('success','Cliente creado');
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
