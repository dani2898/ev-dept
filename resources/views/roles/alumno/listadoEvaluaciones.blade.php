@extends('layouts.menuAlumno')
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
                            <th>Fecha de aplicación</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluaciones as $evaluacion)
                        <tr>
                            <td>{{$evaluacion->nombre}} </td>
                            <td><b>{{$evaluacion->fechaRecoleccionInicio}}</b> a <b>{{$evaluacion->fechaRecoleccionFin}}</b> </td>
                            <td><b>{{$evaluacion->aplicacionInicio}}</b> a <b>{{$evaluacion->aplicacionFin}}</b> </td>
                            <td class="text-center">
                                
                                    <a href="{{route('consultarExamenesAlumno', $evaluacion->id)}}">
                                    <button type="submit" class="btn btn-primary btn-raised btn-mini">
                                        <i class="fa fa-eye"></i> Consultar
                                    </button></a>
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