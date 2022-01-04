<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p>Recibiste un mensaje de {{ $msg['nombre'] }} - {{ $msg['email']}}</p>
<p><strong>Asunto: </strong> {{ $msg['subject'] }}</p>
<p><strong>Contenido: </strong> {{ $msg['content'] }}</p>
</body>
</html>