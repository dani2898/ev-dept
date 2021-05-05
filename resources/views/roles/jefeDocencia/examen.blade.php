@extends('layouts.menuPD')
@section('contentRol')

<div class="col-sm-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center text-uppercase fw-bold">{{$materia}} / {{$claveMat}}</h3>
            <h2 class="panel-title text-center text-uppercase pt-3">
            {{ $docentes->implode(', ') }}</h2>
        </div>

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
                <!-- {{$inciso='A'}} -->
                @foreach($pregunta->respuesta as $respuesta)
                <div class='form-group col-sm-12' style='margin: 0;'>
                    @if($respuesta->respuestaCorrecta)
                    <label class='ml-4 fw-bold' style="color: #04c496;">{{$inciso++}}. {{$respuesta->respuesta}}</label>
                    @else
                    <label class='ml-4'>{{$inciso++}}. {{$respuesta->respuesta}}</label>
                    @endif
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
                <!-- {{$inciso='A'}} -->
                @foreach($pregunta->respuesta as $respuesta)
                <div class='form-group col-sm-6' style='margin: 0;'>
                    @if($respuesta->respuestaCorrecta)
                    <label class='ml-4 fw-bold' style="color: #04c496;">{{$inciso++}}. {{$respuesta->respuesta}}</label>
                    @else
                    <label class='ml-4'>{{$inciso++}}. {{$respuesta->respuesta}}</label>
                    @endif
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
                                <th>PREGUNTA</th>
                                <th>RESPUESTA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($relacionPreguntas as $pregunta)
                            <tr style="border-bottom:gray solid 1px;">
                                <td class="px-4 ">{{$pregunta->pregunta}}</td>
                                <td class="px-4 ">{{$pregunta->respuesta}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                @endif
            </div>
        </div>

    </div>
</div>

@endsection