@extends('layouts.menuPD')
@section('contentRol')


<div class="col-sm-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Listado de evaluaciones departamentales</h3>
        </div>

        <div class="row mr-2 mt-2 pe-3">
            <div class="col-lg-12">

                <a href="{{route('obtenerMaterias', ['idEvaluacion' => $idEvaluacion])}}"><button class="btn btn-primary btn-raised btn-sm float-end mx-3">
                    Añadir materia
                </button></a>

            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive text-center">

                <table id="seleccionMaterias" class="table table-bordered default ">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Materia</th>
                            <th>Docente</th>
                            <th>Preguntas capturadas</th>
                            <th>Examen</th>
                            <th colspan="3">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materias as $materia)
                        <tr class="text-center">
                            <td>{{$materia->claveMat}}</td>
                            <td>{{$materia->nombre}}</td>
                            <td>@if($materia->nombreDocentes)
                                {{ $materia->nombreDocentes->implode(', ') }}
                                @else
                                DOCENTE SIN ASIGNAR
                                @endif
                            </td>
                            <td>{{$materia->cantPreguntas}}</td>

                            <td>
                                @if($materia->examen==0)


                                <a><button type="submit" onclick="mostrarReactivos('{{$materia->opcionMultiple}}', '{{$materia->verdaderoFalso}}', 
                            '{{$materia->relacionColumna}}', '{{$materia->id}}', '{{$materia->idMateriaEvaluacion}}')" class="btn btn-info btn-raised btn-mini">
                                        Generar</button> </a>
                                @else
                                <a href="{{route('verExamenJD', [$materia->idMateriaEvaluacion])}}" class="btn btn-info btn-raised btn-mini">
                                    Ver
                                </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('listCapturaReactivos', [$materia->idMateriaEvaluacion])}}" class="btn btn-primary btn-raised btn-mini">
                                    Preguntas
                                </a>
                            </td>

                            <td>
                                <a href="{{route('eliminarExamen', [$materia->idMateriaEvaluacion, $materia->id])}}" class="btn btn-eliminar-examen btn-raised btn-mini">
                                    Eliminar examen
                                </a>
                            </td>

                            <td>
                                <a href="{{route('eliminarMateria', [$materia->idMateriaEvaluacion, $materia->id])}}" class="btn btn-danger btn-raised btn-mini">
                                    Eliminar materia
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


<!-- Trigger/Open The Modal -->
<!-- The Modal -->
<div id="myModal" class="modalExamen pb-2" style="height:100%">

    <!-- Modal content -->
    <div class="modal-content">


        <div class="card" id="myModal mb-2" style="margin: 0;">
            <div class="card-header text-center">
                CANTIDAD DE REACTIVOS
                <span class="close">&times;</span>

            </div>
            <div class="col-sm-12 mt-4">
                <div class="alert alert-info" role="alert">
                    Reactivos capturados, seleccionar la cantidad de cada tipo de reactivo para generar el examen.</div>
                <div class="table-responsive ">
                    <table id="seleccionMaterias" class="table table-bordered default ">
                        <thead>
                            <tr>
                                <th>OPCIÓN MÚLTIPLE</th>
                                <th>VERDADERO/FALSO</th>
                                <th>RELACIONAR COLUMNA</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="text-center">
                                <td id="opcionMultipleTable"></td>
                                <td id="verdaderoFalsoTable"></td>
                                <td id="relacionColumnaTable"></td>
                            </tr>


                        </tbody>

                    </table>
                </div>

                <form id="formPregunta" action="{{route('generarExamen')}}" method="POST">
                    @csrf

                    <input type="text" id="idEvaluacionForm" name="idEvaluacionForm" hidden>
                    <input type="text" id="idMateriaEvaluacionForm" name="idMateriaEvaluacionForm" hidden>

                    <div class="col-sm-4  text-center">
                        <div class="form-group col-sm-12 mb-4" style="margin: 0;">
                            <label for="cantOM" class="label-color">Opción múltiple</label>
                            <input type="number" name="opcionMultipleInput" id="opcionMultipleInput" class="form-control" placeholder="Seleccionar" required />
                        </div>
                    </div>

                    <div class="col-sm-4  text-center">
                        <div class="form-group col-sm-12 mb-4" style="margin: 0;">
                            <label for="cantOM" class="label-color">Verdadero o falso</label>
                            <input type="number" name="verdaderoFalsoInput" id="verdaderoFalsoInput" class="form-control" placeholder="Seleccionar" required />
                        </div>
                    </div>

                    <div class="col-sm-4 d-flex text-center justify-content-center">
                        <div class="form-group col-sm-12 mb-2" style="margin: 0;">
                            <label for="cantOM" class="label-color">Relacionar columna</label>
                            <input type="number" name="relacionColumnaInput" id="relacionColumnaInput" class="form-control" placeholder="Seleccionar" required />
                        </div>
                    </div>


                    <div class="text-right mr-4 mb-4">
                        <button type="submit" id="btnGenera" class="btn btn-primary btn-raised btn-sm">Generar examen</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>



@endsection