@extends('layouts.menuAlumno')
@section('contentRol')

<div class="col-sm-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">EXAMEN</h3>
        </div>
        <form action="{{route('responderExamen', ['idExamen' => $idExamen, 'idAlumnoGrupo' => $idGrupo, 'claveMat' => $claveMat, 'idEvaluacion' => $idEvaluacion])}}" method="post" id="formPregunta">
            @csrf
            <div class="panel-body">
                <div class="col-sm-12">
                    <!-- {{$numeroPregunta=1}} -->

                    @if(!$opcionMultiple->isEmpty())
                    <div class="form-group col-sm-12 mb-4 mt-4" style="margin: 0;">
                        <input type="text" name="arrayOpcionMultiple" id="arrayOpcionMultiple" value="{{ $opcionMultiple->pluck('id')->implode(', ') }}" hidden>

                        <label for="indicacion" class="label-color fw-bold">OPCION MÚLTIPLE: SELECCIONA LA RESPUESTA CORRECTA DE ACUERDO A LA SENTENCIA</label>
                    </div>

                    @foreach($opcionMultiple as $pregunta)
                    <div class="form-group col-sm-12 mb-4 mt-4" style="margin: 0;">
                        <input type="text" name="OMPregunta{{$pregunta->id}}" id="OMPregunta{{$pregunta->id}}" value="{{$pregunta->id}}" hidden>
                        <label for="pregunta" class="label-color fw-bold">{{$numeroPregunta++}}. {{$pregunta->pregunta}}</label>
                    </div>
                    @foreach($pregunta->respuesta as $respuesta)
                    <div class='form-group col-sm-12' style='margin: 0;'>
                        <input type="radio" name="OMRespuesta{{$pregunta->id}}" id="OMRespuesta{{$pregunta->id}}" value="{{$respuesta->id}}" required>
                        <label class='ml-4' >{{$respuesta->respuesta}}</label>
                    </div>
                    @endforeach
                    @endforeach
                    @endif

                    @if(!$verdaderoFalso->isEmpty())
                    <div class="form-group col-sm-12 mb-4 mt-4" style="margin: 0;">
                        <label for="indicacion" class="label-color fw-bold">VERDADERO O FALSO: SELECCIONA LA RESPUESTA CORRECTA DE ACUERDO A LA SENTENCIA</label>
                    </div>

                    <input type="text" name="arrayVerdaderoFalso" id="arrayVerdaderoFalso" value="  {{ $verdaderoFalso->pluck('id')->implode(', ') }}" hidden>

                    @foreach($verdaderoFalso as $pregunta)
                    <div class="form-group col-sm-12 mb-4 mt-4" style="margin: 0;">
                        <input type="text" name="VFPregunta{{$pregunta->id}}" id="VFPregunta{{$pregunta->id}}" value="{{$pregunta->id}}" hidden>
                        <label for="pregunta" class="label-color fw-bold">{{$numeroPregunta++}}. {{$pregunta->pregunta}}</label>
                    </div>
                    @foreach($pregunta->respuesta as $respuesta)
                    <div class='form-group col-sm-6' style='margin: 0;'>
                        <input type='radio' name="VFRespuesta{{$pregunta->id}}" id="VFRespuesta{{$pregunta->id}}" value='{{$respuesta->id}}' required>
                        <label class='ml-4' >{{$respuesta->respuesta}}</label>
                    </div>
                    @endforeach
                    @endforeach
                    @endif

                    @if(!$relacionPreguntas->isEmpty())
                    <div class="form-group col-sm-12 mb-4 mt-4" style="margin: 0;">
                        <label for="indicacion" class="label-color fw-bold">RELACIONAR RESPUESTA: SELECCIONA LA RESPUESTA CORRECTA DE ACUERDO A LA SENTENCIA</label>
                    </div>
                    <input type="text" name="arrayRelacionPreguntas" id="arrayRelacionPreguntas" value="{{ $relacionPreguntas->pluck('id')->implode(', ') }}" hidden>

                    <div>
                        <table id="evaluacionesTabla" class="table table-striped">
                            <thead style="background-color: #04c496;">
                                <tr>
                                    <th>NÚMERO</th>
                                    <th>RESPUESTA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- {{$numeroRelacion='A'}} -->
                                @foreach($relacionRespuestas as $respuesta)
                                <tr style="border-bottom:gray solid 1px;">
                                    <td class="text-center">{{$numeroRelacion++}}</td>
                                    <td>{{$respuesta->respuesta}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    @foreach($relacionPreguntas as $pregunta)
                    <div class="form-group col-sm-12 mb-4 mt-4" style="margin: 0;">
                        <input type="text" name="RPPregunta{{$pregunta->id}}" id="RPPregunta{{$pregunta->id}}" value="{{$pregunta->id}}" hidden>
                        <label for="pregunta" class="label-color fw-bold">{{$numeroPregunta++}}. {{$pregunta->pregunta}}</label>
                    </div>

                    <div class='form-group col-sm-6 ' style='margin: 0;'>
                        <select name="RRRespuesta{{$pregunta->id}}" id="RRRespuesta{{$pregunta->id}}" class="form-control" style="padding: 0px;" required>
                            <option value="" disabled selected>Seleccionar</option>
                            <!-- {{$numeroRelacion='A'}} -->
                            @foreach($relacionRespuestas as $respuesta)
                            <option value="{{$respuesta->id}}">{{$numeroRelacion++}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endforeach

                    @endif
                </div>
            </div>

            <div class="panel-footer text-right">
                <button id="btn-responderExamen" class="btn btn-primary btn-raised btn-sm">Enviar examen</button>
            </div>
        </form>
    </div>
</div>

@endsection