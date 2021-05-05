@extends('layouts.menuDocente')
@section('contentRol')


<div class="col-sm-9 mx-auto">
    <input type="text" name="tipoPregunta" id="tipoPregunta" value="{{$pregunta->idTipoPregunta}}" hidden>
    <input type="text" id="mat_ev_id" name="mat_ev_id" value="{{$idMateriaEvaluacion}}" hidden>
    <input type="text" id="edit" name="edit" value="true" hidden>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">EDITAR REACTIVO</h3>
        </div>
        <form action="{{route('updatePregunta', ['idPregunta' => $pregunta->id])}}" id="formPregunta" method="POST">
            @csrf
            <div class="panel-body">
                <div class="col-sm-12">
                    <a type="text" name="urlForm" id="urlForm" href="{{route('getSubtema') }}" hidden></a>
                    <a type="text" name="urlDominio" id="urlDominio" href="{{route('getNivelDominio') }}" hidden></a>
                    @if($pregunta->idTipoPregunta == 1)
                    <input type="text" name="respuestaCorrecta" id="respuestaCorrecta" value="{{$pregunta->respuestaCorrecta['respuesta']}}" hidden>
                    <!-- {{$inciso="A"}} -->
                    @foreach($pregunta->respuestasIncorrectas as $respuestaIncorrecta)
                    <input type="text" name="incorrecta{{++$inciso}}" id="incorrecta{{$inciso}}" value="{{$respuestaIncorrecta->respuesta}}" hidden>
                    @endforeach
                    @elseif($pregunta->idTipoPregunta == 2)
                    <input type="text" name="verdaderoFalso" id="verdaderoFalso" value="{{$pregunta->respuestaCorrecta['respuesta']}}" hidden>
                    @else
                    <input type="text" name="relacionColumna" id="relacionColumna" value="{{$pregunta->respuestaCorrecta['respuesta']}}" hidden>
                    @endif

                    <div class="form-group col-sm-12 mb-4" style="margin: 0;">
                        <label for="pregunta" class="label-color">PREGUNTA</label>
                        <textarea type="text" name="pregunta" id="pregunta" class="form-control" required>{{$pregunta->pregunta}}</textarea>
                    </div>

                    <span id="respuestas" class="mb-4">

                    </span>

                    <div class="form-group col-lg-6 col-sm-12 mb-4" style="margin: 0;">
                        <label for="tema">TEMA</label>
                        <input type="text" id="idTema" name="idTema" value="{{$pregunta->idTema}}" hidden>
                        <select name="tema" id="tema" class="form-control" style="padding: 0px;" onfocus="this.selectedIndex = -1;" required>
                            <option value="" disabled selected hidden>Seleccionar una opción</option>
                            @foreach($temas as $tema)
                            <option value="{{$tema->id}}">{{$tema->tema}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-6 col-sm-12 mb-4" style="margin: 0;">
                        <label for="subtema">SUBTEMA</label>
                        <input type="text" id="idSubtema" name="idSubtema" value="{{$pregunta->idSubtema}}" hidden>
                        <select name="subtema" id="subtema" class="form-control" style="padding: 0px;" onfocus="this.selectedIndex = -1;" required>
                            <option value="" disabled selected hidden>Seleccionar una opción</option>
                            @foreach($subtemas as $subtema)
                            <option value="{{$subtema->id}}">{{$subtema->subtema}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-sm-12 mb-4" style="margin: 0;">
                        <label for="dominio">DOMINIO</label>
                        <input type="text" id="idDominio" name="idDominio" value="{{$pregunta->idDominio}}" hidden>
                        <select name="dominio" id="dominio" class="form-control" style="padding: 0px;" required>
                            <option value="" disabled selected hidden>Seleccionar una opción</option>
                            @foreach($dominios as $dominio)
                            <option value="{{$dominio->id}}">{{$dominio->dominio}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-6 col-sm-12 mb-4" style="margin: 0;">
                        <label for="nivelDominio">NIVEL DE DOMINIO</label>
                        <input type="text" id="idNivelDominio" name="idNivelDominio" value="{{$pregunta->idNivelDominio}}" hidden>
                        <select name="nivelDominio" id="nivelDominio" class="form-control" style="padding: 0px;" onfocus="this.selectedIndex = -1;" required>
                            <option value="" disabled selected hidden>Seleccionar una opción</option>
                            @foreach($nivelDominios as $nivelDominio)
                            <option value="{{$nivelDominio->id}}">{{$nivelDominio->nivel}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

            <div class="panel-footer text-right">
                <button type="submit" id="btn-updatePregunta" class="btn btn-primary btn-raised btn-sm">Guardar cambios</button>
            </div>
        </form>
    </div>

</div>


@endsection