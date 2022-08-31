@extends('clientes.layout')

@section('content')
<form id="msform" action="{{ route('clientes.store') }}" method="POST">
    @csrf
    <!-- progressbar -->
    <ul id="progressbar">
        <li class="{{ $model->paso1 }}">Datos para verificación</li>
        <li class="{{ $model->paso2 }}">Datos Personales</li>
        <li class="{{ $model->paso3 }}">Tomar Selfie</li>
        <li class="{{ $model->paso4 }}">Fotografia Anverso Ci</li>
        <li class="{{ $model->paso5 }}">Fotografia Reverso Ci</li>
    </ul>
    <!-- fieldsets -->
    @if (!$model->paso2 && !$model->paso3 && !$model->paso4)
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
    @if ($model->paso2 && !$model->paso3 && !$model->paso4)
    <fieldset>
        <h2 class="fs-title">Apertura de Cuenta en Línea</h2>
        <h3 class="fs-subtitle">Datos Personales</h3>

        <div class="row row-cols-3 g-3 ">
            <div class="form-floating mb-3 col">
                <input type="number" class="form-control" id="cedula_identidad" name="cedula_identidad" placeholder="cedula_identidad" autocomplete="off">
                <label for="cedula_identidad">Cédula de Identidad</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" id="complemento" name="complemento" maxlength="2" placeholder="complemento_ci" autocomplete="off" style="text-transform:uppercase;">
                <label for="complemento">Complemento</label>
            </div>

            <div class="form-floating mb-3 col">
                <select class="form-select" id="expedido" name="expedido" aria-label="Estado civil">
                    <option selected></option>
                    <option value="BN">BN</option>
                    <option value="CB">CB</option>
                    <option value="CH">CH</option>
                    <option value="LP">LP</option>
                    <option value="OR">OR</option>
                    <option value="PD">PD</option>
                    <option value="PT">PT</option>
                    <option value="SC">SC</option>
                    <option value="TJ">TJ</option>
                </select>
                <label for="expedido">Expedido</label>
            </div>
        </div>
        <div class="row row-cols-3 g-3 ">
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" id="nombre" name="nombre" pattern="[a-zA-Z'-'\s]*" maxlength="50" placeholder="nombre" autocomplete="off">
                <label for="nombre">Nombre</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control alphaonly" id="apellido_paterno" name="apellido_paterno" pattern="[a-zA-Z'-'\s]*" placeholder="apellido" maxlength="50" autocomplete="off">
                <label for="apellido_paterno">Primer Apellido</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" pattern="[a-zA-Z'-'\s]*" maxlength="50" placeholder="apellido" autocomplete="off">
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
                    <option selected></option>
                    <option value="Soltero">Soltero</option>
                    <option value="Casado">Casado</option>
                    <option value="Viudo">Viudo</option>
                    <option value="Divorciado">Divorciado</option>
                </select>
                <label for="estado_civil">Estado Civil</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" pattern="[a-zA-Z'-'\s]*" maxlength="255" placeholder="nacionalidad" autocomplete="off">
                <label for="nacionalidad">Nacionalidad</label>
            </div>
        </div>
        <div class="row row-cols-3 g-3">
            <div class="form-floating mb-3 col">
                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" maxlength="50" value="{{ $model->cliente->correo_electronico }}" placeholder="name@example.com" autocomplete="off">
                <label for="correo_electronico">Correo electrónico</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="number" class="form-control" id="celular" name="celular" min="60000000" max="79999999" length="" placeholder="celular" autocomplete="off">
                <label for="celular">Celular</label>
            </div>

            <div class="form-floating mb-3 col">
                <select class="form-select" id="genero" name="genero" aria-label="Estado civil">
                    <option selected></option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                </select>
                <label for="genero">Género</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" id="direccion" name="direccion" maxlength="250" placeholder="Dirección" autocomplete="off">
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
    <!-- Selfie Cliente -->
    @if ($model->paso3 && !$model->paso4)
    <fieldset>
        <h2 class="fs-title">Tomate un selfie</h2>
        <h3 class="fs-subtitle">Para tomarte la selfie toma en cuenta que debes hacerlo sin lentes, gorra u otros objetos que eviten ver claramente tu rostro. </h3>

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
    <!-- Anverso ci -->
    @if ($model->paso4 && !$model->paso5)
    <fieldset>
        <h2 class="fs-title">Fotografía de CI</h2>
        <h3 class="fs-subtitle">Tomar Fotografía de Anverso de CI </h3>
        <h4 class="fs-subtitle">Para tomar la fotografía de la cédula de identidad debes asegurarte de encuadrarla lo mejor posible y que los datos sean nítidos para su lectura. </h3>

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
                    <button type="submit" name="enviarCiAnverso" class="btn btn-success next">
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
    <!-- Reverso ci -->
    @if ($model->paso5 && !$model->paso6)
    <fieldset>
        <h2 class="fs-title">Fotografía de CI</h2>
        <h3 class="fs-subtitle">Tomar Fotografía de Reverso de CI </h3>
        <h4 class="fs-subtitle">Para tomar la fotografía de la cédula de identidad debes asegurarte de encuadrarla lo mejor posible y que los datos sean nítidos para su lectura. </h3>

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
                    <button type="submit" name="enviarCiReverso" class="btn btn-success next">
                        <i class="fas fa-paper-plane"></i> Enviar y Finalizar
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

@endsection