@extends('../plantilla')
@isset($rol)
@section('opcMenu')
	@if($rol == 3)
    <li class="nav-item">
        <a class="nav-link" href="{{ action('UsuariosController@create') }}">REGISTRAR EMPLEADO</a>
    </li>
    @endif
@endsection
@endisset