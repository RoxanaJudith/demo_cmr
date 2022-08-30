@extends('clientes.layout')

@section('content')
<form id="msform" action="{{ route('clientes.store') }}" method="POST">
    @csrf
    <!-- progressbar -->
    <ul id="progressbar">
        <li class="{{ $model->paso1 }}">Datos para verificación</li>
        <li class="{{ $model->paso2 }}">Datos Personales</li>
        <li class="{{ $model->paso3 }}">Account Setup</li>
    </ul>
    <!-- fieldsets -->
    @if (!$model->paso2 && !$model->paso3)
    <fieldset>
        <h2 class="fs-title">Apertura de Cuenta en Línea</h2>
        <h3 class="fs-subtitle">Datos para verificación</h3>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="{{ $model->verificacion->correo_electronico }}" placeholder="name@example.com" autocomplete="off">
            <label for="correo_electronico">Correo electrónico</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" name="enviarCodigo" class="btn btn-success next">
                <i class="fas fa-paper-plane"></i> Enviar código de verificación
            </button>

        </div>
        @if ($model->verificacion->id || Session::get('msgCodigoIvalido'))
        <div class="mt-3 text-start">
            <label>Ingrese el código que fue enviado a su correo electrónico:</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 form-group text-center mb-3">
            <div class="form-floating col-6" style="margin:auto;">
                <input type="text" class="form-control" id="codigo" name="codigoVerificar" placeholder="123456" autocomplete="off">
                <label for="codigoVerificar">Código</label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="button" class="btn btn-danger next">
                <i class="fas fa-paper-plane"></i> Cancelar
            </button>
            <button type="submit" name="validarCodigo" class="btn btn-success next">
                <i class="fas fa-paper-plane"></i> Verificar y Continuar
            </button>
        </div>
        @if (Session::get('msgCodigoIvalido'))
        <div class="alert alert-danger mt-3">
            <p>{{ Session::get('msgCodigoIvalido') }}</p>
        </div>
        @endif
        @endif
    </fieldset>
    @endif
    @if ($model->paso2 && !$model->paso3)
    <fieldset>
        <h2 class="fs-title">Apertura de Cuenta en Línea</h2>
        <h3 class="fs-subtitle">Datos Personales</h3>

        <div class="row row-cols-3 g-3 ">
            <div class="form-floating mb-3 col">
                <input type="number" class="form-control" id="cedula_identidad" name="cedula_identidad" placeholder="cedula_identidad" autocomplete="off">
                <label for="cedula_identidad">Cédula de Identidad</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" id="complemento" name="complemento" placeholder="complemento_ci" autocomplete="off" style="text-transform:uppercase;">
                <label for="complemento">Complemento</label>
            </div>

            <div class="form-floating mb-3 col">
                <select class="form-select" id="expedido" name="expedido" aria-label="Estado civil">
                    <option selected></option>
                    <option value="1">BN</option>
                    <option value="2">CB</option>
                    <option value="3">CH</option>
                    <option value="4">LP</option>
                    <option value="5">OR</option>
                    <option value="6">PD</option>
                    <option value="6">PT</option>
                    <option value="6">SC</option>
                    <option value="7">TJ</option>
                </select>
                <label for="expedido">Expedido</label>
            </div>
        </div>
        <div class="row row-cols-3 g-3 ">
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" autocomplete="off">
                <label for="nombre">Nombre</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="apellido" autocomplete="off">
                <label for="apellido_paterno">Primer Apellido</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="apellido" autocomplete="off">
                <label for="apellido_materno">Segundo Apellido</label>
            </div>
        </div>

        <div class="row row-cols-3 g-3 ">
            <div class="form-floating mb-3 col">
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="fecha_nacimiento" autocomplete="off">
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
            </div>

            <div class="form-floating mb-3 col">
                <select class="form-select" id="estado_civil" name="estado_civil" aria-label="Estado civil">
                    <option selected>Estado civil</option>
                    <option value="1">Soltero</option>
                    <option value="2">Casado</option>
                    <option value="3">Viudo</option>
                    <option value="3">Divorciado</option>
                </select>
                <label for="estado_civil">Género</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" placeholder="nacionalidad" autocomplete="off">
                <label for="nacionalidad">Nacionalidad</label>
            </div>
        </div>
        <div class="row row-cols-3 g-3">
            <div class="form-floating mb-3 col">
                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="{{ $model->cliente->correo_electronico }}" placeholder="name@example.com" autocomplete="off">
                <label for="correo_electronico">Correo electrónico</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" id="celular" name="celular" placeholder="celular" autocomplete="off">
                <label for="celular">Celular</label>
            </div>

            <div class="form-floating mb-3 col">
                <select class="form-select" id="genero" name="genero" aria-label="Estado civil">
                    <option selected></option>
                    <option value="1">Femenino</option>
                    <option value="2">Masculino</option>
                </select>
                <label for="genero">Género</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" autocomplete="off">
                <label for="direccion">Dirección</label>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="button" class="btn btn-danger next">
                <i class="fas fa-paper-plane"></i> Cancelar
            </button>
            <button type="submit" name="guardarCliente" class="btn btn-success next">
                <i class="fas fa-paper-plane"></i> Guardar y Continuar
            </button>
        </div>
    </fieldset>
    @endif
    @if ($model->paso3)
    <fieldset>
        <h2 class="fs-title">Selfie</h2>
        <h3 class="fs-subtitle">ja;slkfjalksjflkas</h3>

        <div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br />
                <input type=button class="btn btn-success" value="Tomar Fotografía" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results">Tu fotografía aparecerá aquí</div>
            </div>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" name="enviarSelfie" class="btn btn-success next">
                    <i class="fas fa-paper-plane"></i> Enviar y Continuar
                </button>
            </div>
        </div>
    </fieldset>
    <script language="JavaScript">
        Webcam.set({
            width: 490,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });
        }
    </script>
    @endif
</form>






<!-- <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Datos</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('clientes.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('clientes.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Primer Apellido:</strong>
                <input type="text" name="primer-apellido" class="form-control" placeholder="Apellido">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Segundo Apellido:</strong>
                <input type="text" name="segundo-apellido" class="form-control" placeholder="Apellido">
            </div>
        </div>
        <iv class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cédula de identidad:</strong>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre">
            </div>
    </div>
    <iv class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Complemento:</strong>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre">
        </div>
        </div>
        <iv class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Expedio en:</strong>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre">
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Correo Electrónico:</strong>
                    <input type="text" name="email" class="form-control" placeholder="correo@email.com">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha de Nacimiento:</strong>
                    <input type="text" name="fecha_nacimiento" class="form-control" placeholder="">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nacionalidad:</strong>
                    <input type="text" name="nacionalidad" class="form-control" placeholder="Nacionalidad">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Dirección:</strong>
                    <input type="text" name="direccion" class="form-control" placeholder="Direccion">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Celular:</strong>
                    <input type="text" name="celular" class="form-control" placeholder="Celular">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Género:</strong>
                    <input type="text" name="genero" class="form-control" placeholder="Genero">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Guardar Datos</button>
            </div>
            </div>

</form>-->
@endsection