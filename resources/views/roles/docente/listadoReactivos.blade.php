@extends('layouts.menuDocente')
@section('contentRol')

<div class="col-sm-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Reactivos capturados</h3>
        </div>
        <div class="row mr-2 mt-2 pe-3">
            <div class="col-lg-12">


                <!-- <a href="{{route('bancoPreguntas', ['mat_ev_id' => $mat_ev_id])}}"><button class="btn btn-info btn-raised btn-sm float-end mx-3">
                    Banco de preguntas
                </button></a> -->

                <button class="btn btn-primary btn-raised btn-sm float-end" id="myBtn">
                    Nuevo reactivo
                </button>

            </div>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table id="evaluacionesTabla" class="table table-bordered table-striped">
                    <thead>
                        <tr class="px-3">
                            <th>#</th>
                            <th>Reactivo</th>
                            <th>Tipo</th>
                            <th>Respuesta Correcta</th>
                            <th>Dominio</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{{$noPregunta=1}}-->
                        @foreach ($preguntasMateria as $pregunta)
                        <tr>
                            <td class="px-2">{{$noPregunta++}} </td>
                            <td class="px-2">{{$pregunta->pregunta}}</td>
                            <td class="px-2">{{$pregunta->tipoPregunta}} </td>
                            <td class="text-center px-2">{{$pregunta->respuestaCorrecta}}</td>
                            <td class="px-2">{{$pregunta->dominio}}</td>
                            <td class="text-center px-2">
                                <a href="{{route('editarPregunta', ['idPregunta' => $pregunta->id, 'idMateriaEvaluacion' => $mat_ev_id])}}"><button type="submit" class="btn btn-info btn-raised btn-mini">
                                        Editar
                                    </button></a>
                                <a href="{{route('eliminarPregunta', ['idPregunta' => $pregunta->id, 'idMateriaEvaluacion' => $mat_ev_id])}}"><button type="submit" class="btn btn-danger btn-raised btn-mini">
                                        Eliminar
                                    </button></a>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Trigger/Open The Modal -->
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">


            <div class="card" id="myModal" style="margin: 0;">
                <div class="card-header">
                    SELECCIONE EL TIPO DE PREGUNTA
                    <span class="close">&times;</span>
                </div>
                <div class="card-body">
                    <form action="{{route('capturaReactivos', ['mat_ev_id' => $mat_ev_id])}}" method="get">
                        <div class="form-group col-sm-12" style="margin: 0;">
                            <label for="tipoPregunta">Tipo de reactivo</label>
                            <select name="tipoPregunta" id="tipoPregunta" class="form-control" style="padding:0px;" required>
                                <option value="" disabled selected hidden>Seleccionar una opción</option>
                                @foreach($tiposPregunta as $tipoPregunta)
                                <option value="{{$tipoPregunta->id}}" class="form-control">{{$tipoPregunta->tipo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-raised btn-sm float-end mb-3 me-4">Continuar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection