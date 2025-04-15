<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Inscripcion;
use App\Models\GradoGWDATA;
use App\Livewire\Inscripcion\InscripcionDataTrait;
use App\Livewire\Inscripcion\Index\Searchable;
use App\Livewire\Inscripcion\Index\Sortable;

class InscripcionExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    use InscripcionDataTrait;
    use Searchable;
    use Sortable;

    public $selectedRecordIds = [];

    public $filters;

    public $pais;

    private $rowNumber = 1;

    public $data;

    public $hasPnc;

    public function __construct($selectedRecordIds, $filters, $pais, $search, $sortCol = null, $sortAsc = false, $hasPnc = false)
    {
        $this->selectedRecordIds = $selectedRecordIds;
        $this->filters = $filters;
        $this->pais = $pais;
        $this->search = $search;
        $this->sortCol = $sortCol;
        $this->sortAsc = $sortAsc;
        $this->hasPnc = $hasPnc;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function query()
    {
        $query = Inscripcion::with([
            "tipoBeneficiatio:id,name",
            "perteneceDepartamento:id,codeState,name",
            "perteneceMunicipio:id,name,codeMunicipality,fkCodeState",
            "perteneceSede:id,name,alias",
            "personalInstitucional:id,name",
            "beneficiarioSubtipoEducacion:id,name,institutional_person_id",
            "beneficiarioSubtipoOrganizaciones:id,name,id_institucional,id_beneficiaries_sub",
            "sanamenteSubtiposPolicia:id,name,id_institucional,id_beneficiaries_sub",
            "beneficiarioSubtipoPoliciaRango:id,name,institutional_person_id",
            "sanamenteSubtiposSalud:id,name,id_institucional,id_beneficiaries_sub",
            "beneficiarioSubtipoSalud:id,name,institutional_person_id",
            "grados:id,name",
            "secciones:id,name",
            "jornadas:id,name",
            "ultimoGrados:id,name",
            "discapacidades.discapacidad:id,name",
            "centroEducativoTipos:id,nombre",
            "centroEducativoCargos:id,nombre",
            "centroEducativoNiveles:id,nombre",
            "centroEducativoCiclos:id,nombre",
        ])
            ->where('pais_id', $this->pais->id)
            ->when($this->selectedRecordIds, function ($subquery) {
                $subquery->whereIn('id', $this->selectedRecordIds);
            });

        $query = $this->applySearch($query);

        $query = $this->applySorting($query);

        $query = $this->filters->apply($query);

        return $query;
    }

    public function headings(): array
    {
        $header = [
            '#',
           // 'Updated By',
            'Fecha de Nacimiento',
            'Institucion u Organización',
            'Nombres',
            'Apellidos',
            'Nombres mayúscula',
            'Apellidos mayúscula',
            'Sexo',
            'Pais',
            'Departamento',
            'Municipio',
            'Nacionalidad',
            'DNI',
            'Telefono',
            'Correo Electrónico',
            '¿Te encuentras actualmente estudiando?',
            'Grado Actual',
            'Seccion',
            'Turno o Jornada',
            'Último grado alcanzado',
            '¿Posees alguna discapacidad?',
            'Discapacidad',
            '¿Has participado en años anteriores en actividades de Glasswing?',
            'Perfil con el que te identificas',
            'Personal Institucional',
            'Perfil',
        ];

        if ($this->pais->slug == 'el-salvador' && $this->hasPnc) {
            $header = array_merge($header, [
                'Rango/Categoria',
            ]);
        }

        $header = array_merge($header, [
            'Perfil de personal de Salud',
            'Departamento a la que perteneces',
            'Muicipio a la que perteneces',
            'Sede a la que perteneces',
        ]);

        if ($this->pais->slug == 'honduras') {
            $header = array_merge($header, [
                'Nombre del centro educativo donde labora',
                'Tipo de centro educativo donde labora',
                'Cargo que tiene en el centro educativo donde labora',
                'Departamento donde esta ubicado el centro educativo donde labora',
                'Municipio donde esta ubicado el centro educativo donde labora',
                'Aldea donde esta ubicado el centro educativo donde labora',
                'Caserío donde esta ubicado el centro educativo donde labora',
                'Código SACE del donde esta ubicado el centro educativo donde labora',
                'Jornada que atiende en el centro educativo donde labora',
                'Nivel que atiende en el centro educativo donde labora',
                'Ciclo que atiende en el centro educativo donde labora',
                'Zona Geográfica donde esta ubicado el centro educativo donde labora',
            ]);
        }

        $header = array_merge($header, [
            'Autorización de información',
            'Derechos de uso de imagen y voz',
            'Consentimiento de participación',
            'Fecha de registro',
        ]);

        return $header;
    }

    public function map($row): array
    {
        $nacionalidad = 'Extranjero(a)';

        if ($row->nacionalidad == 1) {
            $labels = $this->getLabels();
            $nacionalidad = $labels['nacionalidad'];
        }

        $grado = null;
        $seccion = null;
        $turno = null;
        $ultimoGrado = null;

        if ($row->estudiando == 1) {
            $grado = $row->grados->name ?? null;

            $gradoSuperior = match($grado) {
                GradoGWDATA::TECNICO, GradoGWDATA::UNIVERSITARIOS, GradoGWDATA::MASTER => true,
                default => false,
            };

            if ($gradoSuperior) {
                $seccion = $row->secciones->name ?? null;
                $turno = $row->jornadas->name ?? null;
            }
        } else {
            $ultimoGrado = $row->ultimoGrados->name ?? null;
        }


        $discapacidades = [];

        if ($row->discapacidades()->count()) {
            foreach ($row->discapacidades as $value) {
                $discapacidades[] = $value->discapacidad->name;
            }
        }


        $perfilIdentificas = $row->tipoBeneficiatio->name ?? null;
        $perfilInstitucional = $row->personalInstitucional->name ?? null;
        $perfil = null;
        $rango = null;
        $personalSalud = null;

        if ($perfilInstitucional) {
            if (str_contains($perfilInstitucional, 'Docentes de Educación')) {
                $perfil = $row->beneficiarioSubtipoEducacion->name ?? null;
            }

            if (str_contains($perfilInstitucional, 'Personal de organizaciones')) {
                $perfil = $row->beneficiarioSubtipoOrganizaciones->name ?? null;
            }

            if (str_contains($perfilInstitucional, 'Personal de la Policía')) {
                $perfil = $row->sanamenteSubtiposPolicia->name ?? null;

                if ($row->sanamenteSubtiposPolicia->name == 'Personal de la Policía Nacional') {
                    $rango = $row->beneficiarioSubtipoPoliciaRango->name ?? null;
                }
            }

            if (str_contains($perfilInstitucional, 'Personal de Salud')) {
                $perfil = $row->sanamenteSubtiposSalud->name ?? null;

                if (str_contains($row->sanamenteSubtiposSalud->name, 'Personal de Hospital')
                    || str_contains($row->sanamenteSubtiposSalud->name, 'Personal de Unidad')) {
                    $personalSalud = $row->beneficiarioSubtipoSalud->name ?? null;
                }
            }
        }


        $tipoCentro = null;
        $cargoCentro = null;
        $jornadaCentro = null;
        $nivelCentro = null;
        $cicloCentro = null;
        $zonaCentro = null;

        if ($this->pais->slug == 'honduras') {
            $tipoCentro = $row->centroEducativoTipos->nombre ?? null;
            $cargoCentro = $row->centroEducativoCargos->nombre ?? null;
            $nivelCentro = $row->centroEducativoNiveles->nombre ?? null;
            $cicloCentro = $row->centroEducativoCiclos->nombre ?? null;

            $jornadaCentro = collect([1 => 'Matutina', 2 => 'Vespertina', 3 => 'Nocturna'])
                ->get($row->centro_educativo_jornada);

            $zonaCentro = $row->centro_educativo_zona_geografica == 1 ? 'Urbana' : 'Rural';
        }


        $build = [
            $row->id,
           // $row->updated_by,
            Carbon::parse($row->fecha_nacimiento)->format('d/m/Y'),
            $row->institucionOrganizacion->nombre ?? null,
            $row->nombres,
            $row->apellidos,
            $row->formatted_nombres_to_upper_case,
            $row->formatted_apellidos_to_upper_case,
            $row->sexo == 1 ? 'Hombre' : 'Mujer',
            $this->pais->nombre,
            $row->departamento->name ?? null,
            $row->municipio->name ?? null,
            $nacionalidad,
            $row->documento_identidad,
            $row->telefono,
            $row->email,
            $row->estudiando == 1 ? 'Si' : 'No',
            $grado,
            $seccion,
            $turno,
            $ultimoGrado,
            $row->discapacidad == 1 ? 'Si' : 'No',
            $row->discapacidad == 1 ? implode(', ', $discapacidades) : '',
            $row->ha_participado_actividades_glasswing == 1 ? 'Si' : 'No',
            $perfilIdentificas,
            $perfilInstitucional,
            $perfil,
        ];

        if ($this->pais->slug == 'el-salvador' && $this->hasPnc) {
            $build = array_merge($build, [$rango]);
        }

        $build = array_merge($build, [
            $personalSalud,
            $row->perteneceDepartamento->name ?? null,
            $row->perteneceMunicipio->name ?? null,
            $row->perteneceSede->name ?? null,
        ]);

        if ($this->pais->slug == 'honduras') {
            $build = array_merge($build, [
                $row->centro_educativo,
                $tipoCentro,
                $cargoCentro,
                $row->laboraDepartamento->name ?? null,
                $row->laboraMunicipio->name ?? null,
                $row->labora_aldea_id,
                $row->labora_caserio_id,
                $row->labora_codigo_sace,
                $jornadaCentro,
                $nivelCentro,
                $cicloCentro,
                $zonaCentro,
            ]);
        }

        $build = array_merge($build, [
            $row->autorizacion_informacion == 1 ? 'Si' : 'No',
            $row->derechos_image_voz == 1 ? 'Si' : 'No',
            $row->consentimiento == 1 ? 'Si' : 'No',
            $row->created_at->format("d/m/Y H:i:s"),
        ]);

        return $build;
    }

    // protected function applySearch($query)
    // {
    //     if($this->search === ''){
    //         return $query;
    //     }

    //     $this->search = trim($this->search);

    //     $getSchoolsIds = \App\Models\EscuelaGWDATA::where('fkCodeCountry', $this->pais->codigo)
    //         ->where('name', 'like', '%'.$this->search.'%')
    //         ->orWhere('alias', 'like', '%'.$this->search.'%')
    //         ->pluck('id')->toArray();


    //     return $query->where(function($query) use ($getSchoolsIds){
    //         $query->where('nombres', 'like', '%'.$this->search.'%')
    //         ->orWhere('apellidos', 'like', '%'.$this->search.'%')
    //         ->orWhere('codigo_confirmacion', 'like', '%'.$this->search.'%')
    //         ->orWhere('documento_identidad', 'like', '%'.$this->search.'%')
    //         ->orWhereIn('pertenece_sede_id', $getSchoolsIds);
    //     });
    // }
}
