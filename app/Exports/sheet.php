<?php

namespace App\Exports;

use App\Http\Middleware\Docente;
use App\Models\Docente as ModelsDocente;
use App\Models\evaluacionDepartamental;
use App\Models\Examen;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\materia_Evaluacion;
use App\Models\Pregunta;
use App\Models\ResultadoExamen;
use App\Models\User;
use GrahamCampbell\ResultType\Result;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Break_;

use function PHPSTORM_META\type;

class sheet implements FromCollection, WithTitle, WithHeadings
{
    private $sheet;
    private $idEvaluacion;

    public function __construct(String $sheet, Int $idEvaluacion)
    {
        $this->sheet = $sheet;
        $this->idEvaluacion = $idEvaluacion;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function collection()
    {

        switch ($this->sheet) {
            case "PROFESORES":
                $materiasEvaluacion = materia_Evaluacion::where('idEvaluacion', $this->idEvaluacion)->get()->pluck('claveMat');
                $grupos = Grupo::with('materias:claveMat,nombre')->whereIn('claveMateria', $materiasEvaluacion)->get();
                $idDocentes = $grupos->pluck('docentes.idUsuario');
                $gruposMateria = $grupos->pluck('materias.nombre');
                $var = 0;

                foreach ($grupos as $group) {
                    $usuario = User::where('id', $idDocentes[$var])->first();
                    $group->docente = $usuario->name;
                    $group->materia = $gruposMateria[$var];
                    $var++;
                }


                $subset = $grupos->map->only(['docente', 'materia']);
                return $subset->sortBy('docente')->sortBy('materia');
                exit;
                break;

            case "GRUPO":
                $materiasEvaluacion = materia_Evaluacion::where('idEvaluacion', $this->idEvaluacion)->get()->pluck('claveMat');
                $grupos = Grupo::with('materias:claveMat,nombre,claveCarrera')->whereIn('claveMateria', $materiasEvaluacion)->get();
                $idDocentes = $grupos->pluck('docentes.idUsuario');
                $gruposMateria = $grupos->pluck('materias.nombre');
                $gruposCarrera = $grupos->pluck('materias.claveCarrera');
                $idGrupos = $grupos->pluck('id');
                $var = 0;

                foreach ($grupos as $group) {
                    $usuario = User::where('id', $idDocentes[$var])->first();
                    $group->docente = $usuario->name;
                    $group->materia = $gruposMateria[$var];
                    $group->carrera = $gruposCarrera[$var];
                    $totalAlumnos = $group->noAlumnos = strval(ResultadoExamen::where('idGrupo', $idGrupos[$var])->get()->count());
                    if ($group->noAlumnos != 0) {
                        $group->promedio = strval((ResultadoExamen::where('idGrupo', $idGrupos[$var])->sum('calificacion')) / $group->noAlumnos);
                        $aprobados = $group->aprobados = strval(ResultadoExamen::where('idGrupo', $idGrupos[$var])->where('aprobado', 1)->get()->count());
                        $group->indAprobacion = strval(($aprobados * 100) / $totalAlumnos);
                        $reprobados = $group->reprobados = strval(ResultadoExamen::where('idGrupo', $idGrupos[$var])->where('aprobado', 0)->get()->count());
                        $group->indReprobacion = strval(($reprobados * 100) / $totalAlumnos);
                    } else {
                        $group->promedio = "0";
                        $group->aprobados = "0";
                        $group->indAprobacion = "0";
                        $group->reprobados = "0";
                        $group->indReprobacion = "0";
                    }
                    $var++;
                }


                $subset = $grupos->map->only([
                    'docente', 'materia', 'grupo', 'carrera',
                    'claveMateria', 'noAlumnos', 'promedio', 'aprobados',
                    'indAprobacion', 'reprobados', 'indReprobacion'
                ]);
                return $subset->sortBy('materia');

                break;
            case "MATERIA":
                $materias = materia_Evaluacion::with('materias:claveMat,nombre')->where('idEvaluacion', $this->idEvaluacion)->get();
                $nombreMaterias = $materias->pluck('materias.nombre');
                $var = 0;
                foreach ($materias as $materia) {
                    $materia->materia = $nombreMaterias[$var++];
                }
                foreach ($materias as $materia) {
                    if (ResultadoExamen::where('claveMat', $materia->claveMat)->get()->count() > 0) {
                        $materia->alumnos = ResultadoExamen::where('claveMat', $materia->claveMat)->get()->count();
                        $materia->promedio =  strval(intval(ResultadoExamen::where('claveMat', $materia->claveMat)->sum('calificacion') / $materia->alumnos));
                        $materia->aprobados =  strval(ResultadoExamen::where('claveMat', $materia->claveMat)->where('aprobado', 1)->get()->count());
                        $materia->indAprobacion =  strval(intval(($materia->aprobados * 100) / $materia->alumnos));
                        $materia->reprobados =  strval(ResultadoExamen::where('claveMat', $materia->claveMat)->where('aprobado', 0)->get()->count());
                        $materia->indReprobacion =  strval(intval(($materia->reprobados * 100) / $materia->alumnos));
                        $preguntas = Examen::where('mat_ev_id', $materia->id)->first();
                        $idPreguntas =  substr($preguntas->preguntas, 1);
                        $arrayPreguntas = array_map('intval', explode(',', $idPreguntas));

                        $cantPreguntasCognoscitivo = Pregunta::whereIn('id', $arrayPreguntas)->where('idDominio', 1)->get()->count();
                        $cantPreguntasPsicomotor = Pregunta::whereIn('id', $arrayPreguntas)->where('idDominio', 2)->get()->count();
                        $cantPreguntasAfectivo = Pregunta::whereIn('id', $arrayPreguntas)->where('idDominio', 3)->get()->count();

                        $cantidadAlumnosMateria = ResultadoExamen::where('claveMat', $materia->claveMat)->get()->count();
                        if ($cantPreguntasCognoscitivo != 0) $materia->promedioCognoscitivo = strval(intval((((ResultadoExamen::where('claveMat', $materia->claveMat)->sum('dominioCogniscitivo')) / $cantidadAlumnosMateria) * 100) / $cantPreguntasCognoscitivo));
                        if ($cantPreguntasPsicomotor != 0) $materia->promedioPsicomotor = strval(intval((((ResultadoExamen::where('claveMat', $materia->claveMat)->sum('dominioPsicomotor')) / $cantidadAlumnosMateria) * 100) / $cantPreguntasPsicomotor));
                        if ($cantPreguntasAfectivo != 0) $materia->promedioAfectivo = strval(intval((((ResultadoExamen::where('claveMat', $materia->claveMat)->sum('dominioAfectivo')) / $cantidadAlumnosMateria) * 100) / $cantPreguntasAfectivo));
                    }
                }
                $subset = $materias->map->only([
                    'materia', 'alumnos', 'promedio', 'aprobados',
                    'indAprobacion', 'reprobados', 'indReprobacion',
                    'promedioCognoscitivo', 'promedioPsicomotor', 'promedioAfectivo'
                ]);
                return $subset->sortBy('materia');

                break;

                case "DEPARTAMENTAL":
                    $evaluacionDepartamental = evaluacionDepartamental::where('id',$this->idEvaluacion)->get();
                    foreach($evaluacionDepartamental as $evDept){
                        $noAlumnos=$evDept->noAlumnos = ResultadoExamen::get()->count();
                        if($noAlumnos!=0){
                        $evDept->promedio = intval(ResultadoExamen::sum('calificacion')/ResultadoExamen::get()->count());
                        $noAprobados=$evDept->aprobados = ResultadoExamen::where('aprobado',1)->get()->count();
                        $evDept->indAprobacion = intval(($noAprobados*100)/$noAlumnos);
                        $noReprobados=$evDept->reprobados = ResultadoExamen::where('aprobado',0)->get()->count();
                        $evDept->indReprobacion = intval(($noReprobados*100)/$noAlumnos);
                    }
                    }
                    $subset = $evaluacionDepartamental->map->only([
                        'noAlumnos', 'promedio', 'aprobados', 'indAprobacion',
                        'reprobados','indReprobacion'
                    ]);
                    return $subset;
    
                    break;

            case "SOBRESALIENTES":
                $materias = materia_Evaluacion::with('materias:claveMat,nombre')->where('idEvaluacion', $this->idEvaluacion)->get();
                $nombreMaterias = $materias->pluck('materias.nombre');
                $claveMat = $materias->pluck('claveMat');

                $sobresalientes = ResultadoExamen::with('materias:claveMat,nombre', 'alumno:id,name')->whereIn('claveMat', $claveMat)
                    ->where('calificacion', '>=', '90')->where('calificacion', '<', '100')->get();
                $materias = $sobresalientes->pluck('materias.nombre');
                $alumnos = $sobresalientes->pluck('alumno.name');
                $var = 0;
                foreach ($sobresalientes as $sobresaliente) {
                    $sobresaliente->materia = $materias[$var];
                    $sobresaliente->alumnoNombre = $alumnos[$var];
                    $var++;
                }

                $subset = $sobresalientes->map->only([
                    'alumnoNombre', 'materia', 'calificacion'
                ]);
                return $subset->sortBy('materia')->sortBy('alumnoNombre');

                break;

            case "EXCELENTES":
                $materias = materia_Evaluacion::with('materias:claveMat,nombre')->where('idEvaluacion', $this->idEvaluacion)->get();
                $nombreMaterias = $materias->pluck('materias.nombre');
                $claveMat = $materias->pluck('claveMat');

                $sobresalientes = ResultadoExamen::with('materias:claveMat,nombre', 'alumno:id,name')->whereIn('claveMat', $claveMat)->where('calificacion', '100')->get();
                $materias = $sobresalientes->pluck('materias.nombre');
                $alumnos = $sobresalientes->pluck('alumno.name');
                $var = 0;
                foreach ($sobresalientes as $sobresaliente) {
                    $sobresaliente->materia = $materias[$var];
                    $sobresaliente->alumnoNombre = $alumnos[$var];
                    $var++;
                }

                $subset = $sobresalientes->map->only([
                    'alumnoNombre', 'materia', 'calificacion'
                ]);
                return $subset->sortBy('materia')->sortBy('alumnoNombre');

                break;
            default:
                return User::all();
                break;
        }
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->sheet;
    }

    public function headings(): array
    {
        switch ($this->sheet) {
            case "PROFESORES":
                return [
                    'PROFESOR',
                    'MATERIA'
                ];
                break;
            case "GRUPO":
                return [
                    'PROFESOR',
                    'MATERIA',
                    'GRUPO',
                    'CARRERA',
                    'CLAVE',
                    'ALUMNOS',
                    'PROMEDIO',
                    'APROBADOS',
                    'IND APROBACION',
                    'REPROBADOS',
                    'IND REPROBACION'
                ];
                break;

            case "MATERIA":
                return [
                    'MATERIA',
                    'ALUMNOS',
                    'PROMEDIO',
                    'APROBADOS',
                    'IND APROBACION',
                    'REPROBADOS',
                    'IND REPROBACION',
                    'DOM COGNOSCITIVO',
                    'DOM PSICOMOTOR',
                    'DOM AFECTIVO'
                ];
                break;

            case "DEPARTAMENTAL":
                return [
                    'ALUMNOS',
                    'PROMEDIO',
                    'APROBADOS',
                    'IND APROBACION',
                    'REPROBADOS',
                    'IND REPROBACION'
                ];
                break;

            case "SOBRESALIENTES":
                return [
                    'NOMBRE',
                    'MATERIA',
                    'CALIFICACION'
                ];
                break;

            case "EXCELENTES":
                return [
                    'NOMBRE',
                    'MATERIA',
                    'CALIFICACION'
                ];
                break;
            default:
                return [
                    '#',
                    'PRUEBE',
                    'Date',
                ];
                break;
        }
    }
}
