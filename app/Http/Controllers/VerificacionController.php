<?php

namespace App\Http\Controllers;

use App\Mail\CodigoEmail;
use App\Models\Verificacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerificacionController extends Controller
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
        $request->validate([
            'correo_electronico' => 'required',
        ]);

        $code_random_number = strval(random_int(100000, 999999));
        $fecha_expiracion = Carbon::now('America/La_Paz')->addMinutes(5);

        $verificacion = new Verificacion;
        $verificacion->correo_electronico = $request->correo_electronico;
        $verificacion->codigo_verificacion = $code_random_number;
        $verificacion->fecha_expiracion = $fecha_expiracion->format('Y-m-d H:i:m');
        $verificacion->verificado = false;

        $verificacion->save();

        $mailData = [
            "correo_electronico" => $verificacion->correo_electronico,
            "codigo_verificacion" => $verificacion->codigo_verificacion,
            "fecha_expiracion" => $fecha_expiracion->format('d/m/Y H:i:m')

        ];

        Mail::to($verificacion->correo_electronico)->send(new CodigoEmail($mailData));

        return $verificacion;
    }

    public function validar(Request $request)
    {
        $fecha_actual = Carbon::now('America/La_Paz')->format('d/m/Y H:i:m');
        $verificacion_existe = Verificacion::where([
            ['correo_electronico', '=', $request->correo_electronico],
            ['codigo_verificacion', '=', $request->codigoVerificar],
            ['fecha_expiracion', '>=', $fecha_actual]
        ])->first();

        if (!$verificacion_existe) return 0;

        $verificacion_existe->verificado = true;
        $verificacion_existe->save();
        return $verificacion_existe->id;
    }

    public function findOne($id)
    {
        return Verificacion::find($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function show(Verificacion $verificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Verificacion $verificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verificacion $verificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verificacion $verificacion)
    {
        //
    }
}
