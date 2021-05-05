@extends('layouts.menuPD')
@section('contentRol')

<div class="col-sm-8 col-sm-offset-2">
    <form action="{{route('evaluacionOpcionesRedirect')}}" method="post">
        @csrf
        <input type="text" value="{{$evaluacion->id}}" name="idEvaluacion" hidden>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{$evaluacion->nombre}}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group col-sm-12" style="margin: 0;">
                    <p>Selecciona una opción para consultar</p>
                    <label for="opcionLabel">Opción</label>
                    <select name="opciones" id="opciones" class="form-control" style="height: 100%;" required>
                        <option value="" disabled selected hidden>Seleccionar una opción</option>
                        <option value="01Opcion">Materias en captura</option>

                        <option value="02Opcion">Reportes</option>
                    </select>
                </div>
            </div>
            <div class="panel-footer text-right">
                <!-- <a href="https://morelia.tecsge.com/alumnos" class="btn btn-default btn-raised btn-sm">Atrás</a>  -->
                <button type="submit" class="btn btn-primary btn-raised btn-sm">Buscar</button>
            </div>
        </div>
    </form>
</div>

@endsection