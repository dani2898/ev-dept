@extends('layouts.menuPD')
@section('contentRol')

<div class="container-fluid text-uppercase">

    <div class="col-sm-12 ">
        <h3>Selección de materias</h3>
        <h5>Seleccionar las materias que formaran parte de la evaluación departamental.</h5><br>
    </div>

    <div class="col-sm-12">
        <div class="table-responsive ">
            <form action="{{ route('guardarMaterias') }}"  method="POST">
                @csrf
                <table id="seleccionMaterias" class="table table-striped  ">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Materia</th>
                            <th>Docentes</th>
                            <th>Alumnos inscritos</th>
                            <th>Selección</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($materias as $materia)
                        <tr class="text-center bold text-uppercase">
                            <td>{{$materia->claveMat}}</td>
                            <td>{{$materia->nombre}}</td>
                            <td>@if($materia->nombreDocentes)
                                {{ $materia->nombreDocentes->implode(', ') }}
                                @else
                                DOCENTE SIN ASIGNAR
                                @endif
                            </td>
                            <td>{{$materia->noAlumnos}}</td>
                            <td><input type="checkbox" class="checkbox-visible" name="materias[]" value={{$materia->claveMat}}></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="">
                                <div class=" text-right mb-4 mt-4 mr-4">
                                    <input type="text" id="idEvDept"   name="idEvDept" value={{$id}} hidden>
                                    <button type="submit" id="btn-guardar-materias" class="btn btn-primary btn-raised btn-sm">Guardar</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>




@endsection