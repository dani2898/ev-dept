@extends('layouts.menuPD')
@section('contentRol')

<div class="col-sm-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center text-uppercase fw-bold">{{$materia}} / {{$claveMat}}</h3>
            <h2 class="panel-title text-center text-uppercase pt-3">
                {{ $docentes->implode(', ') }}
            </h2>
        </div>

        <!-- <div class="row mr-2 mt-2 pe-3">
            <div class="col-lg-12">

                <button id="myBtn" class="btn btn-primary btn-raised btn-sm float-end mx-2 mt-2" id="myBtn">
                    Enviar mensaje
                </button>

            </div>
        </div> -->

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
                            <strong >Tipo de pregunta:</strong> {{$pregunta->tipoPregunta}} <br>
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
                            <strong>Evaluacion departamental:</strong>  EvaluacionDepartamentalAbril2021 
            
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


<div id="myModal" class="modalExamen pb-2" style="height:100%">

    <!-- Modal content -->
    <div class="modal-content">


        <div class="card" id="myModal mb-2" style="margin: 0;">
            <div class="card-header text-center">
                MENSAJE
                <span class="close">&times;</span>

            </div>
            <div class="col-sm-12 mt-4">
                <div class="alert alert-info" role="alert">
                   Escribir mensaje a docente.</div>
                
                <form id="formPregunta" method="POST">
                    @csrf

                    <input type="text" id="mat_ev_id" name="mat_ev_id" value="{{$mat_ev_id}}" hidden>

                    <div class="form-group col-sm-12 mb-4" style="margin: 0;">
                        <label for="mensaje" class="label-color">Mensaje</label>
                        <textarea type="text" name="mensaje" id="mensaje" class="form-control" required></textarea>
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