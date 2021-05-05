@extends('layouts.menuDocente')
@section('contentRol')
<script src="{{ asset('js/date-comparison.js') }}" defer></script>


<div class="col-sm-9 col-sm-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">


            <h3 class="panel-title text-center">Asignación de fecha de aplicación de examen</h3>
        </div>
        <form action="{{route('guardarFechas', ['idMatEv' => $idMateriaEvaluacion])}}" method="POST" id="formFechaAplicacion">
            @csrf
            <input type="text" name="grupos" id="grupos" value={{$gruposDocente}} hidden>
            <div class="panel-body">
                <div class="col-sm-12">

                    <div class="alert alert-danger fw-bold" role="alert" style="color:white;">
                        Las fechas permitidas para aplicar examen son entre {{$fechaAplicacionInicio}} y {{$fechaAplicacionFin}}</div>

                    @foreach($gruposDocente as $grupo)
                    <div class="form-group col-sm-12 fw-bold" style="margin: 0;">
                        <label for="periodoRecoleccion">Grupo {{$grupo->grupo}}</label>

                    </div>
                    <div class="form-group col-sm-12" style="margin: 0;">
                        <label for="inicioRecoleccion">Inicio</label>
                        <input type="date" id="aplicacion{{$grupo->id}}" name="aplicacion{{$grupo->id}}" min="{{$fechaAplicacionInicio}}" max="{{$fechaAplicacionFin}}" class="form-control" required>

                    </div>
                    @endforeach

                </div>
            </div>

            <div class="panel-footer text-right">
                <button type="submit"  class="btn btn-primary btn-raised btn-sm">Guardar</button>
            </div>
    </div>
    </form>

</div>
@endsection