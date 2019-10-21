<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <script type="text/javascript" src="{{asset('js/vehiculos.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/login.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('css/estilos.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Vehículos maritimos</title>
    </head>
    <body>
        <header class="header">
            <h2 class="container titulo" style="display: inline-block;">
                Vehiculos
            </h2>
            <ul class="nav justify-content-end listaMenu">
              <li class="nav-item">
                <a class="nav-link active" href="{{ url('/') }}">INICIO</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">CONTACTO</a>
              </li>
              @if(!session()->has('user_session'))
                  <li class="nav-item">
                    <a class="nav-link login_modal" href="#">INICIAR SESIÓN</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ action('UsuariosController@create') }}">REGISTRARSE</a>
                  </li>
              @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ action('UsuariosController@logout') }}">CERRAR SESIÓN</a>
                </li>
                @yield('opcMenu')
              @endif
              
            </ul>
        </header>
        <div class="container cuerpo" id="cuerpo">
            @yield('cuerpo')
        </div>
        @include('login_modal')
        @if($errors->any())
        <script>
            $('#login').modal('show');
        </script>
        @endif
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
