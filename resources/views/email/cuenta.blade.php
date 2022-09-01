<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Confirmación de Creación de Cuenta</title>
</head>
<body>
  <h1>Cooperativa Magisterio Rural LTDA.</h1>
  <h2>Creación de Cuenta</h2>
  <p>Su cuenta de ahorros en la Cooperativa Magisterio Rural ha sido creada correctamente, bajo el nombre de
    {{ $mailData['nombre_cliente'] }} {{ $mailData['apellido_paterno'] }} {{ $mailData['apellido_materno'] }} con ci: {{ $mailData['cedula_identidad'] }}
  </p>
  <h3 style="font-weight: bold;">Su número de cuenta es:{{ $mailData['numero_cuenta'] }}</h3>
  <p>Ahora puede gozar de todos los beneficios con los que cuenta como cliente.</p>
  <p>Bienvenido a la gran familia de CMR.</p>
  <br>
  <p>La cooperativa CMR LTDA. nunca enviará un correo electrónico para solicitar que revele o verifique su contraseña o número de cuenta.</p>
</body>
</html>