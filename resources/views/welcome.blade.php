@extends('../plantilla')
@isset($rol)
@section('opcMenu')
	@if($rol == 3 || $rol==2)
    <li class="nav-item" id="opcpanel">
        <a class="nav-link btn btn-warning" href="{{ url('paneladmin') }}">PANEL ADMINISTRATIVO</a>
    </li>
    @endif
@endsection
@endisset

@section('cuerpo')
<p class="gradiente">
	VEHÍCULOS MARÍTIMOS
</p>
@endsection