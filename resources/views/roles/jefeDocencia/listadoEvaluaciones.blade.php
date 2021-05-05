@extends('layouts.menuPD')
@section('contentRol')

<div class="col-sm-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Listado de evaluaciones departamentales</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive text-center">
                <table id="evaluacionesTabla" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Evaluación</th>
                            <th>Fecha de recolección</th>
                            <th>Fecha de aplicación</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluaciones as $evaluacion)
                        <tr>
                            <td>{{$evaluacion->nombre}} </td>
                            <td><b>{{$evaluacion->fechaRecoleccionInicio}}</b> a <b>{{$evaluacion->fechaRecoleccionFin}}</b> </td>
                            <td><b>{{$evaluacion->aplicacionInicio}}</b> a <b>{{$evaluacion->aplicacionFin}}</b> </td>
                            <td>{{$evaluacion->status}}</td>
                            <td class="text-center">
                                <form action="{{route('evaluacionOpciones')}}" class="form-lista-evaluaciones" method="POST">
                                    @csrf
                                    <input type="text" id="idEvaluacion" name="idEvaluacion" value="{{$evaluacion->id }}" hidden>
                                    <input type="text" id="idStatus" value="{{$evaluacion->idStatus }}" hidden>
                                    <button type="submit" class="btn btn-primary btn-raised btn-mini">
                                      Ver
                                    </button>
                                </form>
                                    <a href="{{route('editarEvaluacion', ['idEvaluacion' => $evaluacion->id] )}}"><button type="submit" class="btn btn-info btn-raised btn-mini">
                                       Editar
                                    </button></a>
                                <form action="{{route('eliminarEvaluacion')}}" class="form-lista-evaluaciones" method="POST">
                                    @csrf
                                    <input type="text" id="idEvaluacion" name="idEvaluacion" value="{{$evaluacion->id }}" hidden>
                                    <button type="submit" class="btn btn-danger btn-raised btn-mini">
                                       Eliminar
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