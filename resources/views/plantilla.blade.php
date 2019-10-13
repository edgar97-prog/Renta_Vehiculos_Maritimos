<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <title>Vehículos maritimos</title>
    </head>
    <body>
        <header class="container header">
            <h2>
                @yield('cabecera')
            </h2>
        </header>
        <div class="container">
            @yield('cuerpo')
        </div>
        <footer class="container footer">
            @yield('piepag')
        </footer>
    </body>
</html>
