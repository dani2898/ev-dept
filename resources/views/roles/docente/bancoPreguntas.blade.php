@extends('layouts.menuDocente')
@section('contentRol')

<div class="col-sm-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center text-uppercase fw-bold">{{$materia}} / {{$claveMat}}</h3>
            <h2 class="panel-title text-center text-uppercase pt-3">
                {{ $docentes->implode(', ') }}
            </h2>
        </div>

        <div class="alert alert-primary m-4 mb-0 fw-bold" role="alert">
            Hacer clic en la pregunta para obtener más detalles.
        </div>

        <div class="panel-body fs-4">
            <div class="accordion" id="accordionExample">
                <!-- {{$numeroPregunta=1}} -->
                @foreach ($preguntasMateria as $pregunta)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{$pregunta->id}}">
                        <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$pregunta->id}}" aria-expanded="false" aria-controls="collapse{{$pregunta->id}}">
                            {{$numeroPregunta++}}. {{$pregunta->pregunta}}
                        </button>
                    </h2>
                    <div id="collapse{{$pregunta->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$pregunta->id}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>Tipo de pregunta:</strong> {{$pregunta->tipoPregunta}} <br>
                            <strong>Dominio:</strong> {{$pregunta->dominio}} <br>
                            <strong>Tema:</strong> {{$pregunta->tema}} <br>
                            <strong>Respuesta correcta:</strong> {{$pregunta->respuestaCorrecta}} <br>
                            <!--{{$inciso='A'}} -->
                            @if($pregunta->idTipoPregunta==1)
                            <strong>Respuestas incorrectas:</strong> <br>
                            @foreach($pregunta->respuestasIncorrectas as $incorrecta)
                            {{$inciso++}}. {{$incorrecta->respuesta}} <br>
                            @endforeach
                            @endif
                            <strong>Evaluacion departamental:</strong> EvaluacionDepartamentalAbril2021

                            <form action="{{route('agregarReactivoBanco', ['mat_ev_id' => $mat_ev_id, 'idReactivo' => $pregunta->id])}}" method="post" class="mb-4">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-raised btn-mini float-end">
                                    Añadir reactivo
                                </button>
                            </form>


                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            <!-- Acordion final -->

        </div>
    </div>

</div>
</div>




@endsection