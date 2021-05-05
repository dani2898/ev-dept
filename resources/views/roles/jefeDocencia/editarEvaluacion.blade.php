@extends('layouts.menuPD')
@section('contentRol')
<script src="{{ asset('js/date-comparison.js') }}" defer></script>


<div class="col-sm-9 col-sm-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">


            <h3 class="panel-title text-center">Editar Evaluación Departamental</h3>
        </div>
        <form action="{{route('actualizarEvaluacion', ['idEvaluacion' => $evaluacionDepartamental->id])}}" method="POST" id="formNuevaEvaluacion">
            @csrf
            <div class="panel-body">
                <div class="col-sm-12">

                    <div class="form-group col-sm-12" style="margin: 0;">
                        <label for="periodoRecoleccion">Periodo de recolección de preguntas</label>

                    </div>
                    <div class="form-group col-sm-6" style="margin: 0;">
                        <label for="inicioRecoleccion">Inicio</label>
                        <input type="date" id="inicioRecoleccion" name="inicioRecoleccion" class="form-control" value="{{$evaluacionDepartamental->fechaRecoleccionInicio}}" required>

                    </div>
                    <div class="form-group col-sm-6" style="margin: 0;">
                        <label for="finRecoleccion">Final</label>
                        <input type="date" id="finRecoleccion" name="finRecoleccion" class="form-control" value="{{$evaluacionDepartamental->fechaRecoleccionFin}}" required>

                    </div>

                    <div class="form-group col-sm-12" style="margin: 0;">
                        <label for="periodoAplicacion">Perido de aplicación</label>

                    </div>
                    <div class="form-group col-sm-6" style="margin: 0;">
                        <label for="inicioAplicacion">Inicio</label>
                        <input type="date" id="inicioAplicacion" name="inicioAplicacion" class="form-control" value="{{$evaluacionDepartamental->aplicacionInicio}}" required>

                    </div>
                    <div class="form-group col-sm-6" style="margin: 0;">
                        <label for="finAplicacion">Final</label>
                        <input type="date" id="finAplicacion" name="finAplicacion" class="form-control"  value="{{$evaluacionDepartamental->aplicacionFin}}" required>

                    </div>

                </div>
            </div>

            <div class="panel-footer text-right">
                <button type="submit" id="btn-nvaEvaluacion" class="btn btn-primary btn-raised btn-sm">Siguiente</button>
            </div>
    </div>
    </form>

</div>
@endsection