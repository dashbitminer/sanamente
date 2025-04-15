<?php

namespace App\Livewire\Inscripcion\Index;

use Carbon\Carbon;
use App\Models\Pais;
use Livewire\Component;
use App\Models\Inscripcion;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Reactive;
use App\Exports\InscripcionExport;
use App\Models\DepartamentoGWDATA;
use App\Models\ParticipanteGWDATA;
use App\Models\UserGWDATA;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Renderless;
use App\Livewire\Inscripcion\Forms\InscripcionForm;

class Table extends Component
{
    use WithPagination, Searchable, Sortable;

    public Pais $pais;

    public Inscripcion $inscripcion;

    #[Reactive]
    public Filters $filters;

    public InscripcionForm $form;

    public $perPage = 10;

    public $selectedRecordIds = [];

    public $recordsIdsOnPage = [];

    public $ciudades = [];

    public $escuelas = [];

    public $selectedDeptos = [];

    public $openDrawer = false;

    public $showSuccessIndicator = false;

    public $showValidationErrorIndicator = false;

    public array $items = [];

    public $isOpen = false;

    public $progress = 0;

    public $processing = false;

    public $count_imported = 0;

    #[Renderless]
    public function export()
    {
        if (!auth()->user()->can('Descargar inscripción formaciones SM')){
            abort(404);
        }

        $hasPnc = false;

        if ($this->pais->slug == 'el-salvador') {
            $inscripciones = Inscripcion::where('pais_id', $this->pais->id)
                ->when($this->selectedRecordIds, function ($subquery) {
                    $subquery->whereIn('id', $this->selectedRecordIds);
                })
                ->get();

            $filter = $inscripciones->filter(fn ($value, int $key) => $value->is_pnc == 1);
            $hasPnc = $filter->count();
        }

        return (new InscripcionExport(
            $this->selectedRecordIds,
            $this->filters,
            $this->pais,
            $this->search,
            $this->sortCol,
            $this->sortAsc,
            $hasPnc
            ))
                ->download('inscripciones.xlsx');
    }

    public function render()
    {
        if(!$this->filters->selectedEstadosIds){
            $formularios = Inscripcion::with([
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
            ])
                ->where('created_by', -1)->paginate($this->perPage);

        }else{

            $query = Inscripcion::with([
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
            ])
                ->select(
                    'id',
                    'pais_id',
                    'nombres',
                    'apellidos',
                    'documento_identidad',
                    'sexo',
                    'fecha_nacimiento',
                    'derechos_image_voz',
                    'codigo_confirmacion',
                    'perfil_identificas',
                    'perfil_institucional_id',
                    'perfil_institucional_educacion_id',
                    'perfil_rango_organizacion_id',
                    'perfil_institucional_policia_id',
                    'perfil_rango_id',
                    'perfil_rango_salud_id',
                    'perfil_personal_salud_id',
                    'pertenece_departamento_id',
                    'pertenece_ciudad_id',
                    'pertenece_sede_id',
                    'is_pnc',
                    'created_by',
                    'created_at',
                    'deleted_at',
                    'imported_at',
                )
                ->where('pais_id', $this->pais->id);

            $query = $this->applySearch($query);

            $query = $this->applySorting($query);

            $query = $this->filters->apply($query);

            $formularios = $query->paginate($this->perPage);

            $this->recordsIdsOnPage = $formularios->reject(fn($form) => $form->deleted_at || $form->imported_at)
                ->pluck('id')
                ->toArray();
        }

        $departamentos = DepartamentoGWDATA::where('fkCodeCountry', $this->pais->codigo)
            ->pluck('name', 'codeState');

        return view('livewire.inscripcion.index.table', [
            'formularios' => $formularios,
            'departamentos' => $departamentos,
            'ciudades' => $this->ciudades,
            //'escuelas' => $this->escuelas,
        ]);
    }

    public function updated($propertyName, $value)
    {

        if ($propertyName == 'form.departamentoSelected') {
            $this->form->ciudades = \App\Models\MunicipioGWDATA::where('fkCodeState', $value)
                                        ->orderBy('name')
                                        ->pluck("name", "codeMunicipality");

            $this->form->escuelas = [];
                                        // $this->dispatch('refresh-choices', []);

        } elseif($propertyName == 'form.ciudadSelected') {

            $this->form->escuelas =  \App\Models\EscuelaGWDATA::active()
                                    ->where('fkCodeMunicipality', $value)
                                    ->where('fkCodeCountry', $this->pais->codigo)
                                    ->orderBy('name')
                                    ->pluck('name', 'id');



        } elseif ($propertyName == 'form.departamentoResideSelected') {

            $this->form->municipiosReside = \App\Models\MunicipioGWDATA::where('fkCodeState', $value)
                                        ->orderBy('name')
                                        ->pluck("name", "codeMunicipality");
        }

    }

    #[On('manual-reset-page')]
    public function manualResetPage()
    {
        $this->resetPage();
    }

    public function procesarSelected()
    {
        if (!auth()->user()->can('Importar inscripción formaciones SM a GWDATA')){
            abort(404);
        }

        /**
         * GWDATA
         * Tabla:type_beneficiarios
         * Condición typePerson 1 and active_at not null
         */
        $this->isOpen = true;

        $imported_by = UserGWDATA::where('email', auth()->user()->email)
            ->first();


        Inscripcion::with([
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
        ])
            ->whereIn('id', $this->selectedRecordIds)
            ->whereNull('imported_at')
            ->each(function ($participante, $index) use ($imported_by) {

                $this->progress = ($index + 1) * (100 / count($this->selectedRecordIds));

                DB::transaction(function () use ($participante, $imported_by) {

                    //$this->progress = $i * 10;

                    try {

                        $miescuela = \App\Models\EscuelaGWDATA::find($participante->pertenece_sede_id);
                        $mipais = Pais::find($participante->pais_id);

                         //quitamos el codigo del pais al codigo  de la school
                        // build the participant code using names, surnames, birth date, school code, and year of entry
                        if ($mipais && $miescuela) {
                            $fkCode = str_replace($mipais->codigo . ',', '', $miescuela->code);
                            $fechaNacimiento = trim(str_replace('-', '', $participante->fecha_nacimiento));
                            $codigoBenef = str_replace(' ', '', (strtolower($participante->nombres))) . str_replace(' ', '', (strtolower($participante->apellidos))) . $fechaNacimiento . '-' . $fkCode;
                        } else {
                            throw new \Exception('Country or school not found.');
                        }

                        $beneficiaries_subtype_id = null;

                        // Docentes de Educación
                        if ($participante->personalInstitucional) {
                            if (str_contains($participante->personalInstitucional->name, 'Docentes de Educación')) {
                                $beneficiaries_subtype_id = $participante->beneficiarioSubtipoEducacion->id ?? null;
                            }

                            if (str_contains($participante->personalInstitucional->name, 'Personal de organizaciones')) {
                                $beneficiaries_subtype_id = $participante->beneficiarioSubtipoOrganizaciones->id_beneficiaries_sub ?? null;
                            }

                            if (str_contains($participante->personalInstitucional->name, 'Personal de la Policía')) {
                                $beneficiaries_subtype_id = match ($participante->sanamenteSubtiposPolicia->name) {
                                    'Personal de la Policía Nacional' => $participante->beneficiarioSubtipoPoliciaRango->id ?? null,
                                    default => $participante->sanamenteSubtiposPolicia->id_beneficiaries_sub ?? null,
                                };
                            }

                            if (str_contains($participante->personalInstitucional->name, 'Personal de Salud')) {
                                if (str_contains($participante->sanamenteSubtiposSalud->name, 'Personal de Hospital')
                                    || str_contains($participante->sanamenteSubtiposSalud->name, 'Personal de Unidad')) {
                                    $beneficiaries_subtype_id = $participante->beneficiarioSubtipoSalud->id ?? null;
                                }
                            }
                        }


                        $voice_image = $participante->derechos_image_voz;

                        // Para PNC la imagen y voz sera NO o Id 2
                        if ($participante->is_pnc == 1 && $voice_image == 0) {
                            $voice_image = 2;
                        }


                        // 1 CREATE PARTICIPANT
                        $participanteGWDATA = ParticipanteGWDATA::create([
                            'code'                     => $codigoBenef,
                            'codGenerate'              => date("Y") . '-' . ParticipanteGWDATA::max('id'),
                            'DNI'                      => $participante->documento_identidad,
                            'year'                     => date("Y"), // PREGUNTAR SI ESTO ESTA BIEN
                            'name'                     => Str::upper($participante->nombres),
                            'surname'                  => Str::upper($participante->apellidos),
                            'fechaNac'                 => Carbon::parse($participante->fecha_nacimiento)->format('Y-m-d'),
                            'genre_id'                 => $participante->sexo,
                            'fkCodeCountry'            => $mipais->codigo,
                            'fkCodeState'              => $participante->departamento_id,
                            'fkCodeMunicipality'       => $participante->ciudad_id,
                            'fkIdTypeBeneficiarity'    => $participante->perfil_identificas,
                            'last_grade_id'            => $participante->grado_alcanzado_id,
                            'voice_image'              => $voice_image,
                            // 'created_at'               => Carbon::now(),
                            // 'updated_at'               => Carbon::now(),
                            'current_year'             => date("Y"),
                            'address'                  => NULL,
                            'institutional_person_id'  => $participante->perfil_institucional_id,
                            'beneficiaries_subtype_id' => $beneficiaries_subtype_id,
                            'phone_participante'       => $participante->telefono,
                            'email_participante'       => $participante->email,
                            'first_year_of_participation' => $participante->ha_participado_actividades_glasswing,
                            'institucion'              => NULL,
                            'is_imported'              => 1,
                            'date_imported'            => Carbon::now(),
                            'imported_by'              => $imported_by?->id ?? null,
                        ]);

                        // 2 ASSOCIATE PARTICIPANT TO THE SCHOOL
                        $participanteGWDATA->participanteEscuela()->create([
                            'fkCode'                           => $miescuela->code,
                            'fkIdLevel'                        => $participante->grado_id,
                            'fkIdSection'                      => $participante->grado_seccion_id,
                            'school_beneficiaries_turn_id'     => $participante->grado_jornada_id,
                            'school_beneficiaries_state_id'    => 1,
                            'date_state'                       => now(),
                            'school_beneficiaries_approved_id' => 1,
                            'observations'                     => NULL,
                            'documentacion_inscripcion'        => NULL,
                        ]);

                        // 3 ASSOCIATE PARTICIPANT WITH DISABILITIES
                        $participanteGWDATA->discapacidades()
                            ->attach($participante->discapacidades()->pluck('discapacidad_id')->toArray());

                        // 4 MARK THE RECORD AS IMPORTED
                        $participante->update([
                            'imported_at' => now(),
                            'imported_by' => auth()->user()->id,
                        ]);

                        $this->count_imported++;

                        $this->dispatch('progress-updated', progress: $this->progress);

                        // Commit the transaction
                        // No need to commit manually, DB::transaction handles it
                        // Rollback the transaction on error
                    } catch (\Exception $e) {
                        Log::error('Error processing participant: ' . $e->getMessage(), [
                            'participante_id' => $participante->id,
                            'exception' => $e,
                        ]);
                        throw $e;
                    }
                });


        });

        $this->resetPage();

        $this->dispatch('update-table-data');

        $this->selectedRecordIds = [];

        $this->showSuccessIndicator = true;
    }

    public function deleteSelected()
    {
        if(!auth()->user()->can('Eliminar inscripción formaciones SM')){
            abort(404);
        }

        Inscripcion::whereIn('id', $this->selectedRecordIds)->delete();

        $this->dispatch('update-table-data');

        $this->selectedRecordIds = [];

        $this->showSuccessIndicator = true;

        $this->resetPage();
    }


    public function delete(Inscripcion $inscripcion)
    {
        if(!auth()->user()->can('Eliminar inscripción formaciones SM')){
            abort(404);
        }

        $inscripcion->delete();

        $this->dispatch('update-table-data');

        $this->showSuccessIndicator = true;

        $this->resetPage();
    }
}
