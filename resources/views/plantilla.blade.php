<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
         <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <script type="text/javascript" src="{{asset('js/vehiculos.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('css/estilos.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Vehículos maritimos</title>
    </head>
    <body>
        <header class="header">
            <h2 class="container titulo">
                Vehiculos
            </h2>
        </header>
        <div class="container cuerpo">
            @yield('cuerpo')
        </div>
        <footer class="footer">
            <div class="container">
                <h4>&copy; 2019 Todos los derechos reservados</h4>
                <ul>
                    <li><a href="#">Acerca de</a></li>
                    <li><a href="#">Contactanos</a></li>
                    <li><a href="#">Redes Sociales</a></li>
                </ul>   
            </div>
        </footer>
    </body>
</html>
