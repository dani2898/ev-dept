@extends('layouts.menuDocente')
@section('contentRol')

<div class="col-sm-9 col-sm-offset-2">
    <div class="panel panel-default">
    <div class="panel-heading">


<h3 class="panel-title text-center">Nueva Pregunta</h3>
</div>  
<form action="" method="POST" >
    @csrf
    <div class="panel-body">
    <div class="col-sm-12">
      {{$mat_ev_id}}
      {{$tipoPregunta}}
       <div class="form-group col-sm-12" style="margin: 0;">
       <label for="periodoRecoleccion">Nueva Pregunta</label>

       </div>
        <div class="form-group col-sm-6" style="margin: 0;">
            <label for="inicioRecoleccion">Unidad</label>
            <input type="number" id="inicioRecoleccion" name="inicioRecoleccion" class="form-control" required>
            
        </div>
        <div class="form-group col-sm-6" style="margin: 0;">
            <label for="finRecoleccion">Numero subtema</label>
            <input type="number" id="finRecoleccion" name="finRecoleccion" class="form-control" required>
            
        </div>


        <div class="form-group col-sm-12" style="margin: 0;">
            <label for="inicioAplicacion">Pregunta</label>
            <textarea type="date" rows="1" id="inicioAplicacion" name="inicioAplicacion" class="form-control" required> </textarea>
            
        </div>
            <div class="form-group col-sm-6" style="margin: 0;">
                <label for="finAplicacion">Tipo de reactivo</label>
                <select name="" id="" class="form-control">
                    <option value=""></option>
                    <option value="" class="form-control">Opcion múltiple</option>
                    <option value="" class="form-control">Verdadero o Falso</option>
                    <option value="" class="form-control">Relacionar columnas</option>
                </select>
                
            </div>

        <div class="form-group col-sm-6" style="margin: 0;">
            <label for="finAplicacion">Taxonomía de Bloom</label>
            <select name="" id="" class="form-control">
                <option value=""></option>
                <option value="" class="form-control">Cognoscitivo</option>
                <option value="" class="form-control">Psicomotor</option>
                <option value="" class="form-control">Afectivo</option>
            </select>
            
        </div>

        <div class="form-group col-sm-6" style="margin: 0;">
            <label for="finAplicacion">Respuestas</label>
            <input type="text" class="form-control" placeholder="VERDADERO">
            
        </div>

        <div class="form-group col-sm-6" style="margin: 0;">
        <label for="finAplicacion" style="color:white"></label>
            <input type="text" class="form-control" placeholder="FALSO">
        </div>

       
        



    </div>
    </div>

    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-primary btn-raised btn-sm">Siguiente</button>
    </div>
    </div>
</form>

</div>
@endsection