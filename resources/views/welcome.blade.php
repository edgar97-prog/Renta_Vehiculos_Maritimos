@extends('../plantilla')
@isset($rol)
@section('opcMenu')
	@if($rol == 3 || $rol==2)
    <li class="nav-item">
        <a class="nav-link btn btn-warning" href="{{ url('paneladmin') }}">PANEL ADMINISTRATIVO</a>
    </li>
    @endif
@endsection
@endisset

@section('cuerpo')
<p style="font-size: 70px;text-align: center;padding-top: 100px;">
	CARROUSEL BIEN CHIDO
</p>
@endsection