@extends('base')
@section('options')
<div class="item">
    <a href="{{route('listadoEnCaptura')}}" class="item-dropdown"><i class="fa fa-book" aria-hidden="true"></i> Evaluaciones Departamentales</a>
</div>
<div class="item">
        <form action="{{route('logout')}}" method="post">
            @csrf<button type="submit" class="item-dropdown text-left" style="background: none; border: 0px;">
                <i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar sesión</button></form>
    </div>
@endsection


@section('content')
@yield('contentRol')
@endsection