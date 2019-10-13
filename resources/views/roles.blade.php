<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Prueba</title>
    </head>
    <body>
        <h2>Roles</h2>
        <ul>
            @foreach($roles as $rol)
                <li style="font-size: 20px;"><strong>id:</strong> {{$rol->id}} tipo: {{$rol->Descripcion}}</li>
            @endforeach
        </ul>
    </body>
</html>
