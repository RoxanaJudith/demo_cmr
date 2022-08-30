<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Email</title>
</head>
<body>
    <h1>Cooperativa Magisterio Rural</h1>
    <h2>Código de Verificación</h2>
    <p>Correo electrónico: {{ $mailData['correo_electronico'] }}</p>
    <p>Código de Verificación:</p>
    <h3 style="font-weight: bold;">{{ $mailData['codigo_verificacion'] }}</h3>
    <p>Válido hasta: {{ $mailData['fecha_expiracion'] }}</p>
    <p>La cooperativa CMR LTDA. nunca enviará un correo electrónico para solicitar que revele o verifique su contraseña o número de cuenta.</p>
</body>
</html>