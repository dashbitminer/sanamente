<?php

namespace Database\Seeders;

use App\Models\Formulario;
use App\Models\Pais;
use App\Models\TipoFormulario;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormularioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //FORM OPTIONS
        $pais = Pais::find(1);

        $perfiles = $pais->perfilesSeguimiento()->whereNotNull("perfil_seguimientos.active_at")
                            ->select("perfil_seguimientos.nombre", "perfil_seguimientos.id", "pais_perfil_seguimientos.id as pivotid")
                            ->get();

        $perfilDocente = $pais->perfilesSeguimientoDocente()->whereNotNull("perfil_seguimiento_docentes.active_at")
                                ->select("perfil_seguimiento_docentes.nombre", "perfil_seguimiento_docentes.id", "pais_perfil_seguimiento_docentes.id as pivotid")
                                ->get();

        $perfilPolicia = $pais->perfilesSeguimientoPolicia()->whereNotNull("perfil_seguimiento_policias.active_at")
                        ->select("perfil_seguimiento_policias.nombre", "perfil_seguimiento_policias.id", "pais_perfil_seguimiento_policias.id as pivotid")
                        ->get();

        $rangoPolicia = $pais->rangoPerfilesSeguimientoPolicia()
                        ->whereNotNull("rango_seguimiento_policias.active_at")
                        ->select("rango_seguimiento_policias.nombre", "rango_seguimiento_policias.id", "pais_rango_seguimiento_policias.id as pivotid")
                        ->get();

        $perfilOrganizaciones = $pais->perfilesSeguimientoOrganizacion()
                        ->whereNotNull("perfil_seguimiento_organizaciones.active_at")
                        ->select("perfil_seguimiento_organizaciones.nombre", "perfil_seguimiento_organizaciones.id", "pais_perfil_seguimiento_organizaciones.id as pivotid")
                        ->get();

        $perfilSalud = $pais->perfilesSeguimientoSalud()
                        ->whereNotNull("perfil_seguimiento_salud.active_at")
                        ->select("perfil_seguimiento_salud.nombre", "perfil_seguimiento_salud.id", "pais_perfil_seguimiento_salud.id as pivotid")
                        ->get();

        $perfilHospital = $pais->perfilesSeguimientoHospital()
                        ->whereNotNull("perfil_seguimiento_hospitales.active_at")
                        ->select("perfil_seguimiento_hospitales.nombre", "perfil_seguimiento_hospitales.id", "pais_perfil_seguimiento_hospitales.id as pivotid")
                        ->get();

        $departamentos = \App\Models\EscuelaGWDATA::getUniqueStatesWithActiveSchoolsAndComponents($pais->codigo)->pluck('name', 'fkCodeState')->toArray();
        $actividades = $pais->actividadesSeguimiento()
                            ->whereNotNull("actividad_seguimientos.active_at")
                            ->pluck("actividad_seguimientos.nombre", "pais_actividad_seguimientos.id")
                            ->toArray();

        $perfilesOpt = collect($perfiles)->map(function ($perfil) {
            return [
                'nombre' => $perfil['nombre'],
                'id' => $perfil['id'],
                'pivotid' => $perfil['pivotid']
            ];
        })->toArray();

        $perfilDocenteOpt = collect($perfilDocente)->map(function ($perfil) {
            return [
                'nombre' => $perfil['nombre'],
                'id' => $perfil['id'],
                'pivotid' => $perfil['pivotid']
            ];
        })->toArray();

        $perfilPoliciaOpt = collect($perfilPolicia)->map(function ($perfil) {
            return [
                'nombre' => $perfil['nombre'],
                'id' => $perfil['id'],
                'pivotid' => $perfil['pivotid']
            ];
        })->toArray();

        $rangoPoliciaOpt = collect($rangoPolicia)->map(function ($perfil) {
            return [
                'nombre' => $perfil['nombre'],
                'id' => $perfil['id'],
                'pivotid' => $perfil['pivotid']
            ];
        })->toArray();

        $perfilOrganizacionesOpt = collect($perfilOrganizaciones)->map(function ($perfil) {
            return [
                'nombre' => $perfil['nombre'],
                'id' => $perfil['id'],
                'pivotid' => $perfil['pivotid']
            ];
        })->toArray();

        $perfilSaludOpt = collect($perfilSalud)->map(function ($perfil) {
            return [
                'nombre' => $perfil['nombre'],
                'id' => $perfil['id'],
                'pivotid' => $perfil['pivotid']
            ];
        })->toArray();

        $perfilHospitalOpt = collect($perfilHospital)->map(function ($perfil) {
            return [
                'nombre' => $perfil['nombre'],
                'id' => $perfil['id'],
                'pivotid' => $perfil['pivotid']
            ];
        })->toArray();

        $estructuraFGSM = json_encode([
            [
                'id'       => 1,
                'type'     => 'radiobutton', // boolean
                'label'    => '¿Es la primera vez que participas en un seguimiento?',
                'name'     => 'form.participacion',
                'field'    => 'participacion',
                'required' => true,
                'condition' => []
            ],
            [
                'id'       => 2,
                'type'     => 'radiobutton', //'smallInteger',
                'label'    => 'Nacionalidad',
                'name'     => 'form.nacionalidad',
                'field'    => 'nacionalidad',
                'options' => [
                    ['label' => 'Nacional', 'value' => 1],
                    ['label' => 'Extranjero', 'value' => 2],
                ],
                'required' => true,
                'condition' => []
            ],
            [
                'id'        => 3,
                'type'      => 'text',
                'label'     => 'Documento unico de identidad',
                'name'      => 'form.documento_identidad',
                'field'     => 'documento_identidad',
                'required'  => true,
                'condition' => []
            ],
            [
                'id'        =>  4,
                'type'      => 'text',
                'label'     => 'Nombres',
                'name'      => 'form.nombres',
                'field'     => 'nombres',
                'required'  => true,
                'condition' => []
            ],
            [
                'id'        =>  5,
                'type'      => 'text',
                'label'     => 'Apellidos',
                'name'      => 'form.apellidos',
                'field'     => 'apellidos',
                'required'  => true,
                'condition' => []
            ],
            [
                'id'        => 6,
                'type'      => 'dropdown',
                'label'     => 'Selecciona su perfil',
                'name'      => 'form.perfilSelected',
                'field'     => 'pais_perfil_seguimiento_id',
                'required'  => true,
                'options'   => $perfilesOpt,
                'condition' => []
            ],
            [
                'id'        => 7,
                'type'      => 'dropdown',
                'label'     => 'Seleccione su perfil docente:',
                'name'      => 'form.perfilDocenteSelected',
                'field'     => 'pais_perfil_seguimiento_docente_id',
                'required'  => true,
                'options'   => $perfilDocenteOpt,
                'condition' => array(
                    array(
                        array(
                            'field' => '6',
                            'operator' => '==',
                            'value' => \App\Models\PerfilSeguimiento::PERFIL_DOCENTE_BASICA
                        )
                    ),
                    array(
                        array(
                            'field' => '6',
                            'operator' => '==',
                            'value' => \App\Models\PerfilSeguimiento::PERFIL_DOCENTE_SUPERIOR
                        )
                    )
                )
            ],
            [
                'id'        => 8,
                'type'      => 'dropdown',
                'label'     => 'Selecciona su perfil policia:',
                'name'      => 'form.perfilPoliciaSelected',
                'field'     => 'pais_perfil_seguimiento_policia_id',
                'required'  => true,
                'options'   => $perfilPoliciaOpt,
                'condition' => array(
                    array(
                        array(
                            'field' => '6',
                            'operator' => '==',
                            'value' => \App\Models\PerfilSeguimiento::PERFIL_POLICIA
                        )
                    )
                )
            ],
            [
                'id'        => 9,
                'type'      => 'dropdown',
                'label'     => 'Selecciona su rango/categoria:',
                'name'      => 'form.rangoPoliciaSelected',
                'field'     => 'pais_rango_seguimiento_policia_id',
                'required'  => true,
                'options'   => $rangoPoliciaOpt,
                'condition' => array(
                    array(
                        array(
                            'field' => '6',
                            'operator' => '==',
                            'value' => \App\Models\PerfilSeguimiento::PERFIL_POLICIA
                        ),
                        array(
                            'field' => '8',
                            'operator' => '==',
                            'value' => \App\Models\PerfilSeguimientoPolicia::PERFIL_POLICIA_NACIONAL
                        ),
                    )
                )
            ],
            [
                'id'        => 10,
                'type'      => 'dropdown',
                'label'     => 'Selecciona su perfil organizaciones:',
                'name'      => 'form.perfilOrganizacionSelected',
                'field'     => 'pais_perfil_seguimiento_organizacion_id',
                'required'  => true,
                'options'   => $perfilOrganizacionesOpt,
                'condition' => array(
                    array(
                        array(
                            'field' => '6',
                            'operator' => '==',
                            'value' => \App\Models\PerfilSeguimiento::PERFIL_ORGANIZACIONES
                        ),
                    )
                )
            ],
            [
                'id'        => 11,
                'type'      => 'dropdown',
                'label'     => 'Selecciona su perfil salud:',
                'name'      => 'form.perfilSaludSelected',
                'field'     => 'pais_perfil_seguimiento_salud_id',
                'required'  => true,
                'options'   => $perfilSaludOpt,
                'condition' => array(
                    array(
                        array(
                            'field' => '6',
                            'operator' => '==',
                            'value' => \App\Models\PerfilSeguimiento::PERFIL_SALUD
                        ),
                    )
                )
            ],
            [
                'id'        => 12,
                'type'      => 'dropdown',
                'label'     => 'Selecciona su perfil de personal de salud:',
                'name'      => 'form.perfilHospitalSelected',
                'field'     => 'pais_perfil_seguimiento_hospital_id',
                'required'  => true,
                'options'   => $perfilHospitalOpt,
                'condition' => array(
                    array(
                        array(
                            'field' => '6',
                            'operator' => '==',
                            'value' => \App\Models\PerfilSeguimiento::PERFIL_SALUD
                        ),
                        array(
                            'field' => '11',
                            'operator' => 'IN',
                            'value' => [\App\Models\PerfilSeguimientoSalud::PERFIL_PERSONAL_HOSPITAL, \App\Models\PerfilSeguimientoSalud::PERFIL_UNIDAD_SALUD]
                        ),
                    )
                )
            ],
            [
                'id'        => 13,
                'type'      => 'dropdown',
                'label'     => 'Selecciona el departamento donde se encuentra la escuela/sede a la que pertenece:',
                'name'      => 'form.departamentoSelected',
                'field'     => 'departamento_id',
                'required'  => true,
                'options'   => $departamentos,
                'condition' => [],
            ],
            [
                'id'        => 14,
                'type'      => 'dropdown',
                'label'     => 'Selecciona el municipio donde se encuentra la escuela/sede a la que perteneces:',
                'name'      => 'form.ciudadSelected',
                'field'     => 'ciudad_id',
                'required'  => true,
                'options'   => [],
                'condition' => [],
                'cascade' => array(
                    array(
                        array(
                            'field' => '13',
                        )
                    ),
                )
            ],
            [
                'id'        => 14,
                'type'      => 'dropdown',
                'label'     => 'Selecciona la sede/escuela a la que perteneces:',
                'name'      => 'form.escuelaSelected',
                'field'     => 'escuela_id',
                'required'  => true,
                'options'   => [],
                'condition' => [],
                'cascade' => array(
                    array(
                        array(
                            'field' => '14',
                        )
                    ),
                )
            ],
            [
                'id'             => 15,
                'type'           => 'checkbox',
                'label'          => 'Selecciona la actividad en la que participas:',
                'name'           => 'form.actividadesSelected',
                'field'          => '',
                'pivot_table'    => 'formacion_pais_actividad',
                'relation_table' => 'pais_actividad_seguimientos',
                'required'       => true,
                'options'        => $actividades,
                'condition'      => [],
                'cascade'        => []
            ],

        ]);


        $formularioFGSM = Formulario::create([
            'nombre' => 'Registro de seguimiento a FGSM',
            'tipo_formulario_id' => TipoFormulario::FGSM,
            'version' => '1.0.0',
            'estructura' => $estructuraFGSM,
            'active_at' => now(),
        ]);

        $formularioFGSM->paises()->attach([1, 2, 3], ['active_at' => now()]);
    }
}
