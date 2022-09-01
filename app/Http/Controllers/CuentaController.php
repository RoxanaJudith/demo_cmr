<?php

namespace App\Http\Controllers;

use App\Mail\CuentaEmail;
use App\Models\Cliente;
use App\Models\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// use PDF;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code_random_number = strval(random_int(462000000000, 462999999999));

        $cuentaCliente = new Cuenta;
        $cuentaCliente->clientes_id = $request->idCliente;
        $cuentaCliente->numero = $code_random_number;
        $cuentaCliente->tipo = 'Caja de Ahorros';

        $cuentaCreada = $cuentaCliente->save();
        $cliente = Cliente::find($request->idCliente);
        $data = [
            "correo_electronico" => $cliente->correo_electronico,
            "nombre_cliente" => $cliente->nombre,
            "apellido_paterno" => $cliente->apellido_paterno,
            "apellido_materno" => $cliente->apellido_materno,
            "cedula_identidad" => $cliente->cedula_identidad,
            "numero_cuenta" => $cuentaCliente->numero
        ];

        // $pdf = PDF::loadView('email.cuenta', $data);

        Mail::to($cliente->correo_electronico)
            ->send(new CuentaEmail($data));
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function show(Cuenta $cuenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuenta $cuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuenta $cuenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuenta $cuenta)
    {
        //
    }
}
