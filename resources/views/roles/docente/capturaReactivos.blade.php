@extends('layouts.menuDocente')
@section('contentRol')

{{$idTema=""}}
<div class="col-sm-9 mx-auto">
    <input type="text" name="tipoPregunta" id="tipoPregunta" value="{{$tipoPregunta}}" hidden>
    <input type="text" id="edit" name="edit" value="false" hidden>

    <div class="panel-body" style="margin: 0;">
        <div class="table-responsive text-center">
            <table id="evaluacionesTabla" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Reactivo</th>
                        <th>Respuesta correcta</th>
                    </tr>
                </thead>
                <tbody id="preguntasCapturadas">

                </tbody>

            </table>

        </div>
        <form class="form-lista-evaluaciones" id="formularioPreguntas">
            @csrf
            <a type="text" name="urlGuardarReactivos" id="urlGuardarReactivos" href="{{route('guardarReactivos') }}" hidden></a>
            <input type="text" id="mat_ev_id" name="mat_ev_id" value="{{$mat_ev_id}}" hidden>
            <button type="submit" class="btn btn-primary btn-raised btn-mini float-end" id="btnCapturas">
                <i class="fa fa-eye"></i> Guardar capturas
            </button>
        </form>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">CAPTURA DE REACTIVOS</h3>
        </div>
        <form id="formPregunta">
            <div class="panel-body">
                <div class="col-sm-12">
                    <a type="text" name="urlForm" id="urlForm" href="{{route('getSubtema') }}" hidden></a>
                    <a type="text" name="urlDominio" id="urlDominio" href="{{route('getNivelDominio') }}" hidden></a>

                    <div class="form-group col-sm-12 mb-4" style="margin: 0;">
                        <label for="pregunta" class="label-color">PREGUNTA</label>
                        <input type="text" name="pregunta" id="pregunta" class="form-control" required>
                    </div>

                    <span id="respuestas" class="mb-4">

                    </span>

                    <div class="form-group col-lg-6 col-sm-12 mb-4" style="margin: 0;">
                        <label for="tema">TEMA</label>
                        <select name="tema" id="tema" class="form-control" style="padding: 0px;" onfocus="this.selectedIndex = -1;" required>
                            <option value="" disabled selected hidden>Seleccionar una opción</option>
                            @foreach($temas as $tema)
                            <option value="{{$tema->id}}">{{$tema->tema}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-6 col-sm-12 mb-4" style="margin: 0;">
                        <label for="subtema">SUBTEMA</label>
                        <select name="subtema" id="subtema" class="form-control" style="padding: 0px;" onfocus="this.selectedIndex = -1;" required>
                            <option value="" disabled selected hidden>Seleccionar una opción</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-sm-12 mb-4" style="margin: 0;">
                        <label for="dominio">DOMINIO</label>
                        <select name="dominio" id="dominio" class="form-control" style="padding: 0px;" required>
                            <option value="" disabled selected hidden>Seleccionar una opción</option>
                            @foreach($dominios as $dominio)
                            <option value="{{$dominio->id}}">{{$dominio->dominio}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-6 col-sm-12 mb-4" style="margin: 0;">
                        <label for="nivelDominio">NIVEL DE DOMINIO</label>
                        <select name="nivelDominio" id="nivelDominio" class="form-control" style="padding: 0px;" onfocus="this.selectedIndex = -1;" required>
                            <option value="" disabled selected hidden>Seleccionar una opción</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="panel-footer text-right">
                <button id="btn-agregarPregunta" class="btn btn-primary btn-raised btn-sm">Añadir</button>
            </div>
        </form>
    </div>

</div>


@endsection