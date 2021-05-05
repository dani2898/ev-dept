@extends('layouts.menuDocente')
@section('contentRol')

<div class="col-sm-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Materias a capturar</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive text-center">
                <table id="evaluacionesTabla" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Materia</th>
                            <th>Carrera</th>
                            <th>Preguntas capturadas</th>
                            <th>Fecha de aplicación</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materiasEvaluacionDocente as $materia)
                        <tr>
                            <td>{{$materia->claveMat}} </td>
                            <td><b>{{$materia->nombre}}</td>
                            <td>{{$materia->carrera}}</td>
                            <td><b>{{$materia->cantPreguntas}}</b> </td>
                            <td>
                            @if($materia->fechaAplicacionFlag->isEmpty()) <a href="{{route('asignarFechaAplicacion', ['idMateriaEvaluacion' => $materia->idMateriaEvaluacion])}}"><button type="submit" class="btn btn-info btn-raised btn-mini">
                                    Asignar
                                </button></td></a>
                            @else
                            <a href="{{route('obtenerFechasAplicacion', ['idMateriaEvaluacion' => $materia->idMateriaEvaluacion])}}"><button type="submit" class="btn btn-info btn-raised btn-mini">
                                    Editar
                                </button></td></a>
                            @endif
                            <td class="text-center">
                                <form action="{{route('verCapturasMateria',  [$materia->idMateriaEvaluacion])}} " class="form-lista-evaluaciones" method="GET">
                                    @csrf
                                    <!-- <input type="text" id="idMateriaEvaluacion" name="idMateriaEvaluacion" value="{{$materia->idMateriaEvaluacion}}" hidden> -->
                                    <button type="submit" class="btn btn-primary btn-raised btn-mini">
                                        Ver capturas
                                    </button>

                                </form>


                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection