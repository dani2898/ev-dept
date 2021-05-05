<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\evaluacionDepartamentalController;
use App\Http\Controllers\materia_evaluacion;
use App\Http\Controllers\materiaController;
use App\Http\Controllers\preguntaController;
use App\Http\Controllers\dominioController;
use App\Http\Controllers\examenController;
use App\Http\Controllers\fechaAplicacionExamenController;
use App\Http\Controllers\grupoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\nivelDominioController;
use App\Http\Controllers\reporteController;
use App\Http\Controllers\subtemaController;
use App\Models\Pregunta;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});


// RUTAS JEFE DOCENCIA

Route::get('/nueva-evaluacion',  function () {
    return view('roles.jefeDocencia.nuevaEvaluacion');
})->name('nuevaEvaluacion')->middleware('auth', 'role:Jefe Docencia');

Route::get('/seleccion-materias',  function () {
    return view('roles.jefeDocencia.seleccionMaterias');
})->name('seleccionMaterias')->middleware('auth', 'role:Jefe Docencia');

Route::get('/listado-evaluaciones', [evaluacionDepartamentalController::class, 'show'])->name('listadoEvaluaciones')->middleware('auth', 'role:Jefe Docencia');

Route::get('/obtenerMaterias/{idEvaluacion}', [materiaController::class, 'show'],)->name('obtenerMaterias')->middleware('auth', 'role:Jefe Docencia');

Route::post('/nuevaEvaluacion', [evaluacionDepartamentalController::class, 'store'])->name('agregarEvaluacion')->middleware('auth', 'role:Jefe Docencia');

Route::post('/guardarMaterias', [materia_evaluacion::class, 'store'])->name('guardarMaterias')->middleware('auth', 'role:Jefe Docencia');

Route::get('/editarEvaluacion/{idEvaluacion}', [evaluacionDepartamentalController::class, 'obtenerDatosEvaluacion'])->name(('editarEvaluacion'))->middleware('auth', 'role:Jefe Docencia');

Route::post('/actualizarEvaluacion/{idEvaluacion}', [evaluacionDepartamentalController::class, 'update'])->name(('actualizarEvaluacion'))->middleware('auth', 'role:Jefe Docencia');


Route::post('/eliminarEvaluacion', [evaluacionDepartamentalController::class, 'destroy'])->name(('eliminarEvaluacion'))->middleware('auth', 'role:Jefe Docencia');

Route::post('/evaluacionOpciones', [evaluacionDepartamentalController::class, 'redirectEv'])->name(('evaluacionOpciones'))->middleware('auth', 'role:Jefe Docencia');

Route::post('/evaluacionOpcionesRedirect', [evaluacionDepartamentalController::class, 'redirectOpciones'])->name(('evaluacionOpcionesRedirect'))->middleware('auth', 'role:Jefe Docencia');

Route::get('/materiasCaptura/{idEvaluacion}', [materia_evaluacion::class, 'show'])->name(('materiasEnCaptura'))->middleware('auth', 'role:Jefe Docencia');

Route::get('/materiasReactivos/{idMateriaEvaluacion}', [preguntaController::class, 'showJefe'])->name(('listCapturaReactivos'))->middleware('auth', 'role:Jefe Docencia');

Route::get('/eliminarMateria/{idMateriaEvaluacion}/{idEvaluacion}', [materia_evaluacion::class, 'destroy'])->name(('eliminarMateria'))->middleware('auth', 'role:Jefe Docencia');

Route::post('/generarExamen', [examenController::class, 'store'])->name('generarExamen')->middleware('auth', 'role:Jefe Docencia');

Route::get('/eliminarExamen/{idMateriaEvaluacion}/{idEvaluacion}', [examenController::class, 'destroy'])->name('eliminarExamen')->middleware('auth', 'role:Jefe Docencia');

Route::get('/reporte/{idEvaluacion}', [reporteController::class, 'generarReporte'])->name(('reporte'))->middleware('auth', 'role:Jefe Docencia');

Route::get('/verExamenJD/{idMateriaEvaluacion}', [examenController::class, 'showExamenJD'])->name('verExamenJD')->middleware('auth', 'role:Jefe Docencia');



//RUTAS DOCENTE

Route::get('/evaluacion-departamental', [evaluacionDepartamentalController::class, 'showEnCaptura'])->name('listadoEnCaptura')->middleware('auth', 'role:Docente');

Route::get('/materias/{idEvaluacion}', [materia_evaluacion::class, 'showMateriasDocente'])->name('consultarMateriasDocente')->middleware('auth', 'role:Docente');

Route::get('/captura-materia/{idMateriaEvaluacion}', [preguntaController::class, 'show'])->name('verCapturasMateria')->middleware('auth', 'role:Docente');

Route::get('/captura-reactivos/{mat_ev_id}',  [dominioController::class, 'show'])->name('capturaReactivos')->middleware('auth', 'role:Docente');

Route::post('/guardar-reactivos',  [PreguntaController::class, 'store'])->name('guardarReactivos')->middleware('auth', 'role:Docente');

Route::get('/eliminarPregunta/{idPregunta}/{idMateriaEvaluacion}', [preguntaController::class, 'destroy'])->name('eliminarPregunta')->middleware('auth', 'role:Docente');

Route::get('/getSubtema', [subtemaController::class, 'show'])->name('getSubtema')->middleware('auth', 'role:Docente');

Route::get('/getNivelDominio', [nivelDominioController::class, 'show'])->name('getNivelDominio')->middleware('auth', 'role:Docente');

Route::get('/editarPregunta/{idPregunta}/{idMateriaEvaluacion}', [preguntaController::class, 'obtenerDatosPregunta'])->name('editarPregunta')->middleware('auth', 'role:Docente');

Route::post('/updatePregunta/{idPregunta}', [preguntaController::class, 'update'])->name(('updatePregunta'))->middleware('auth', 'role:Docente');

Route::get('/bancoPreguntas/{mat_ev_id}', [preguntaController::class, 'bancoPreguntas'])->name('bancoPreguntas')->middleware('auth', 'role:Docente');

Route::post('/agregarReactivoBanco/{mat_ev_id}/{idReactivo}', [preguntaController::class, 'agregarReactivoBanco'])->name(('agregarReactivoBanco'))->middleware('auth', 'role:Docente');

Route::get('/asignarFechaAplicacion/{idMateriaEvaluacion}', [grupoController::class, 'show'])->name(('asignarFechaAplicacion'))->middleware('auth', 'role:Docente');

Route::post('/guardarFechas/{idMatEv}', [fechaAplicacionExamenController::class, 'store'])->name(('guardarFechas'))->middleware('auth', 'role:Docente');

Route::get('/obtenerFechasAplicacion/{idMateriaEvaluacion}', [fechaAplicacionExamenController::class, 'show'])->name(('obtenerFechasAplicacion'))->middleware('auth', 'role:Docente');

Route::post('/updateFechas/{idMatEv}', [fechaAplicacionExamenController::class, 'update'])->name(('updateFechas'))->middleware('auth', 'role:Docente');





//RUTAS ALUMNO

Route::get('/evaluacion-departamental-alumno', [evaluacionDepartamentalController::class, 'showAplicando'])->name('listadoDepartamentalAlumno')->middleware('auth', 'role:Alumno');

Route::get('/examenes/{idEvaluacion}', [examenController::class, 'show'])->name('consultarExamenesAlumno')->middleware('auth', 'role:Alumno');

Route::get('/examen/{idMatEv}/{idGrupo}/{claveMat}/{idEvaluacion}', [examenController::class, 'showExamen'])->name('consultarExamen')->middleware('auth', 'role:Alumno');

Route::post('/responderExamen/{idExamen}/{idAlumnoGrupo}/{claveMat}/{idEvaluacion}', [examenController::class, 'guardarRespuestasAlumno'])->name('responderExamen')->middleware('auth', 'role:Alumno');

Route::get('/home',[HomeController::class, 'index'])->middleware('auth');


//TEST MIDDLEWARE

Route::get('/jefe-docencia', function () {
    return view('roles.jefeDocencia.homeJefe');
})->middleware('jefeDocencia:Jefe Docencia')->name('jefeDocencia');

 Route::get('/servidor-social', function () {
     return view('roles.jefeDocencia.homeJefe');
 })->middleware('servidorSocial:Servidor Social')->name('servidorSocial');

Route::get('/docente', function () {
    return view('roles.docente.homeDocente');
})->middleware('docente:Docente')->name('docente');

Route::get('/alumno', function () {
    return view('roles.alumno.homeAlumno');
})->middleware('alumno:Alumno')->name('alumno');


Route::get('/test', [evaluacionDepartamentalController::class, 'test']);


