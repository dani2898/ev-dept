@extends('layouts.menuAlumno')
@section('contentRol')

<div class="col-sm-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Exámenes</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive text-center">
                <table id="evaluacionesTabla" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Materia</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($materiaDatos as $materia)
                        <tr>
                            <td>{{$materia->claveMat}} </td>
                            <td><b>{{$materia->nombre}}</td>
                            <td class="text-center">
                                <a href="{{route('consultarExamen', ['idMatEv' => $materia->id, 'idGrupo' => $materia->idGrupo, 'claveMat' => $materia->claveMat, 'idEvaluacion' => $idEvaluacion])}}">
                                    <button type="submit" class="btn btn-primary btn-raised btn-mini">
                                        <i class="fa fa-eye"></i>Resolver examen
                                    </button>
                                </a>
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