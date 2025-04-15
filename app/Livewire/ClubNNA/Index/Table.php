<?php

namespace App\Livewire\ClubNNA\Index;

use App\Exports\ClubNnaExport;
use Carbon\Carbon;
use App\Models\Pais;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Reactive;
use App\Models\DepartamentoGWDATA;
use App\Models\ParticipanteGWDATA;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Renderless;
use App\Livewire\ClubNNA\Forms\ClubNNAForm;
use App\Livewire\ClubNNA\Index\Searchable;
use App\Livewire\ClubNNA\Traits\ClubNNATrait;
use App\Models\ClubNNA;
use Illuminate\Support\Str;

class Table extends Component
{
    use Searchable, WithPagination, ClubNNATrait;

    public Pais $pais;

    #[Reactive]
    public Filters $filters;

    public ClubNNAForm $form;

    public $perPage = 10;

    public $selectedRecordIds = [];

    public $recordsIdsOnPage = [];

    public $ciudades = [];

    public $departamentos = [];

    public $escuelas = [];

    public $selectedDeptos = [];

    public ClubNNA $fichaInscripcion;

    public $openDrawer = false;

    public $showSuccessIndicator = false;

    public $showValidationErrorIndicator = false;

    public array $items = [];

    // public int $progress = 0;

    public $isOpen = false;
    public $progress = 0;
    public $processing = false;

    #[Renderless]
    public function export()
    {
        if (!auth()->user()->can('Descargar registros club NNA')){
            abort(404);
        }

        return (new ClubNnaExport($this->selectedRecordIds, $this->filters, $this->pais, $this->search))
                ->download('club-nnas.xlsx');

    }

    public function mount(Pais $pais)
    {
        $this->pais = $pais;

        $this->departamentos = DepartamentoGWDATA::where('fkCodeCountry', $this->pais->codigo)->pluck('name', 'codeState');
    }


    private function getViewData($formularios)
    {
        return array_merge($this->getData(), [
            'formularios' => $formularios,
            'departamentos' =>$this->departamentos,
            'ciudades' => $this->ciudades,
            'escuelas' => $this->escuelas,
            'labels' => $this->getLabels(),
        ]);
    }

    public function render()
    {
        if(!$this->filters->selectedEstadosIds){

            $formularios = ClubNNA::where('created_by', -1)->paginate($this->perPage);

        }else{
            
            $query = ClubNNA::with([
                "parentescoGWDATA:id,name",
                "escuelaGWDATA:id,code,name,alias,fkCodeState,fkCodeMunicipality",
                "escuelaGWDATA.municipio:id,codeMunicipality,name",
                "escuelaGWDATA.departamento:id,codeState,name",
                ])
                ->select('id', 'created_by', 'pais_id', 'created_at', 'deleted_at', 'imported_at', 'parentesco_gwdata_id', 'escuela_gwdata_id', 'nombres', 'apellidos', 'nombres_responsable', 'documento_identidad', 'codigo_confirmacion')
                ->where('pais_id', $this->pais->id);

            $query = $this->applySearch($query);

            //$query = $this->applySorting($query);

            $query = $this->filters->apply($query);

            $formularios = $query->paginate($this->perPage);

            $this->recordsIdsOnPage = $formularios
                ->reject(fn($form) => $form->deleted_at || $form->imported_at)
                ->pluck('id')
                ->toArray();

        }

        return view('livewire.club-n-n-a.index.table', $this->getViewData($formularios));
    }

    #[On('manual-reset-page')]
    public function manualResetPage()
    {
        $this->resetPage();
    }

    public function procesarSelected()
    {
        if (!auth()->user()->can('Importar registros club NNA a GWDATA')){
            abort(404);
        }

        /**
         * GWDATA
         * Tabla:type_beneficiarios
         * Condición typePerson 1 and active_at not null
         */
        $tipoParticipante = 1;

        ClubNNA::whereIn('id', $this->selectedRecordIds)->each(function ($participante, $index) use ($tipoParticipante) {

                $this->progress = ($index + 1) * (100 / count($this->selectedRecordIds));

                DB::transaction(function () use ($participante, $tipoParticipante) {

                    try {

                        $miescuela = \App\Models\EscuelaGWDATA::find($participante->escuela_gwdata_id);
                        $mipais = \App\Models\Pais::find($participante->pais_id);

                         //quitamos el codigo del pais al codigo  de la school
                        // build the participant code using names, surnames, birth date, school code, and year of entry
                        if ($mipais && $miescuela) {
                            $fkCode = str_replace($mipais->codigo . ',', '', $miescuela->code);
                            $fechaNacimiento = trim(str_replace('-', '', $participante->fecha_nacimiento));
                            $codigoBenef = str_replace(' ', '', (strtolower($participante->nombres))) . str_replace(' ', '', (strtolower($participante->apellidos))) . $fechaNacimiento . '-' . $fkCode;
                        } else {
                            throw new \Exception('Country or school not found.');
                        }

                        // 1 CREATE PARTICIPANT
                        $participanteGWDATA = ParticipanteGWDATA::create([
                            'code'                     => $codigoBenef,
                            'codGenerate'              => date("Y") . '-' . ParticipanteGWDATA::max('id'),
                            'DNI'                      => NULL,
                            'year'                     => date("Y"), // PREGUNTAR SI ESTO ESTA BIEN
                            'name'                     => Str::upper($participante->nombres),
                            'surname'                  => Str::upper($participante->apellidos),
                            'fechaNac'                 => \Carbon\Carbon::parse($participante->fecha_nacimiento)->format('Y-m-d'),
                            'genre_id'                 => $participante->sexo == 1 ? 2 : 1,
                            'responsable'              => $participante->nombres_responsable,
                            'phone'                    => $participante->telefono,
                            'fkIdRelation'             => $participante->parentesco_gwdata_id,
                            'fkCodeCountry'            => $mipais->codigo,
                            'fkCodeState'              => $participante->departamento_reside_gwdata_code_state,
                            'fkCodeMunicipality'       => $participante->municipio_reside_gwdata_code_municipality,
                            'fkIdTypeBeneficiarity'    => $tipoParticipante,
                            'last_grade_id'            => $participante->ultimo_grado_alcanzado_gwdata_id,
                            'voice_image'              => $participante->voice_image_nna == 1 ? 1 : 2,
                            'voice_image_responsable'  => $participante->autorizacion_voz_imagen == 1 ? 1 : 0,
                            'dni_responsable'          => $participante->documento_identidad,
                            // 'created_at'               => Carbon::now(),
                            // 'updated_at'               => Carbon::now(),
                            'current_year'             => date("Y"),
                            'date_imported'            => Carbon::now(),
                            'autorizacion_responsable' => 1, // ES LA PRIMERA PREGUNTA SI FUERA NO, ENTONCES NO SE LLENARIA EL FORMULARIO
                            'address'                  => NULL,
                            'beneficiaries_subtype_id' => NULL,
                            'migration_status_id'      => NULL,
                            'razon_migration'          => NULL,
                            'migration_family_id'      => NULL,
                            'migration_person_id'      => NULL,
                            'migration_country_id'     => NULL,
                            'otroPais'                 => NULL,
                            'familiar_retornado'       => NULL,
                            'casa_glasswing'           => null, // Ask what this is
                            'phone_participante'       => NULL,
                            'email_participante'       => NULL,
                            'CE_procedencia'           => NULL,
                            'grado_CEProcedencia'      => NULL,
                        ]);

                        // 2 ASSOCIATE PARTICIPANT TO THE SCHOOL
                        $participanteGWDATA->participanteEscuela()->create([
                            'fkCode'                           => $miescuela->code,
                            'fkIdSection'                      => $participante->seccion_gwdata_id,
                            'fkIdLevel'                        => $participante->grado_gwdata_id,
                            'school_beneficiaries_turn_id'     => $participante->turno_gwdata_id,
                            'school_beneficiaries_state_id'    => 1,
                            'date_state'                       => now(),
                            'school_beneficiaries_approved_id' => 1,
                            'observations'                     => NULL,
                            'documentacion_inscripcion'        => NULL,
                        ]);

                        // 3 ASSOCIATE PARTICIPANT WITH DISABILITIES
                        $participanteGWDATA->discapacidades()->attach(json_decode($participante->discapacidades, true));

                        // 4 MARK THE RECORD AS IMPORTED
                        $participante->update([
                            'imported_at' => now(),
                            'imported_by' => auth()->user()->id,
                        ]);

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
        if (!auth()->user()->can('Eliminar registro club NNA')){
            abort(404);
        }

        ClubNNA::whereIn('id', $this->selectedRecordIds)->delete();

        $this->dispatch('update-table-data');

        $this->selectedRecordIds = [];

        $this->showSuccessIndicator = true;

        $this->resetPage();
    }


    public function delete(ClubNNA $ficha)
    {
        if (!auth()->user()->can('Eliminar registro club NNA')){
            abort(404);
        }

        $ficha->delete();

        $this->dispatch('update-table-data');

        $this->showSuccessIndicator = true;

        $this->resetPage();
    }
}
