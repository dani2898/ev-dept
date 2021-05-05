@extends('base')
@section('options')
<div class=" item">
    <div class="item">
        <a href="#collapse-99" class="item-dropdown" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse-2"><i class="fa fa-book" aria-hidden="true"></i> Ev. departamentales</a>
        <div class="collapse" id="collapse-99">
            <div class=" item">
                <a href="{{route('nuevaEvaluacion')}}" class="item-dropdown">Nueva evaluación</a>
            </div>
            <div class="item">
                <a href="{{route('listadoEvaluaciones')}}" class="item-dropdown">Listado de evaluaciones</a>
            </div>
        </div>
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