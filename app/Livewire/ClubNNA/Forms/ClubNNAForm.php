<?php

namespace App\Livewire\ClubNNA\Forms;

use App\Dni;
use App\Facades\TicketCode;
use App\Livewire\ClubNNA\Traits\LabelsTrait;
use App\Models\ClubNNA;
use App\Models\EscuelaGWDATA;
use App\Models\MunicipioGWDATA;
use App\Models\Pais;
use App\PhoneLength;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ClubNNAForm extends Form
{
    use Dni, LabelsTrait;
    public Pais $pais;

    public ClubNNA $clubNna;

    public $readonly = false;

    public $showValidationErrorIndicator;

    public $autorizacion_participacion;

    public $autorizacion_datos_personales;

    public $autorizacion_voz_image;

    public $autorizacion_consentimiento;

    public $nombres_responsable;

    public $parentesco;

    public $telefono;

    public $documento_identidad;

    public $confirmo_copia_documento;

    public $informado_sobre_nna;

    public $nna_ha_escuchado;

    public $leido_comprendido;

    public $deseo_participar;

    public $uso_recoleccion_datos;

    public $uso_imagen;

    public $autorizacion_nna;

    public $autorizo_participacion;

    public $nacionalidad;

    public $ha_participado_anteriormente;

    public $nombres;

    public $apellidos;

    public $fecha_nacimiento;

    public $sexo;

    public $encuentras_estudiando;

    public $ultimo_grado_alcanzado;

    public $posee_discapacidad;

    public $sede_id;

    public $grado_id;

    public $seccion_id;

    public $turno_id;


    public $departamento_id;

    public $ciudad_id;

    public $sede_departamento_id;

    public $sede_ciudad_id;

    public $ciudades;

    public $laboraCiudades;

    public $dniformat;

    public $duiplaceholder;

    public $dui_maxlength;
    public $dui_minlength;

    public $telephone_length;

    public $perteneceSede;

    public $discapacidadesSelect = [];

    public $codigo_confirmacion;

    public $signature_responsable;

    public $signature_nna;

    public $municipiosReside;

    public $escuelas;

    public $firmaDigitalRepresentante = true;

    public $firmaDigitalNna = true;

    public $isFastEdit = false;


    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                //dd($validator->errors()->messages());
                $this->showValidationErrorIndicator = true;
            }
        });
    }

    public function init(Pais $pais){
        $this->ciudades = [];
        $this->pais = $pais;
        $this->perteneceSede = [];

        $this->setDuiFormat();

        $this->telephone_length = match($this->pais->slug) {
            'mexico' => PhoneLength::MEXICO,
            'guatemala' => PhoneLength::GUATEMALA,
            'el-salvador' => PhoneLength::EL_SALVADOR,
            'pnc' => PhoneLength::PNC,
            'honduras' => PhoneLength::HONDURAS,
            'costa-rica' => PhoneLength::COSTA_RICA,
            'panama' => PhoneLength::PANAMA,
            'colombia' => PhoneLength::COLOMBIA,
            default => PhoneLength::GUATEMALA,
        };

    }

    public function setClubNNa(ClubNNa $clubNna){
        $this->clubNna = $clubNna;


        $this->autorizacion_participacion = $this->clubNna->autorizacion_participacion;
        $this->autorizacion_datos_personales = $this->clubNna->autorizacion_datos_personales;
        $this->autorizacion_voz_image = $this->clubNna->autorizacion_voz_image;
        $this->autorizacion_consentimiento = $this->clubNna->autorizacion_consentimiento;

        $this->nombres_responsable = $this->clubNna->nombres_responsable;
        $this->parentesco = $this->clubNna->parentesco_gwdata_id;
        $this->telefono = $this->clubNna->telefono;
        $this->documento_identidad = $this->clubNna->documento_identidad;

        $this->confirmo_copia_documento = $this->clubNna->confirmo_copia_documento;
        $this->informado_sobre_nna = $this->clubNna->informado_sobre_nna;
        $this->nna_ha_escuchado = $this->clubNna->nna_ha_escuchado;
        $this->leido_comprendido = $this->clubNna->leido_comprendido;
        $this->deseo_participar = $this->clubNna->deseo_participar;
        $this->uso_recoleccion_datos = $this->clubNna->uso_recoleccion_datos;
        $this->uso_imagen = $this->clubNna->uso_imagen;
        $this->autorizacion_nna = $this->clubNna->autorizacion_nna;

        $this->nacionalidad = $this->clubNna->nacionalidad;
        $this->ha_participado_anteriormente = $this->clubNna->ha_participado_anteriormente;
        $this->nombres = $this->clubNna->nombres;
        $this->apellidos = $this->clubNna->apellidos;
        $this->fecha_nacimiento = $this->clubNna->fecha_nacimiento;
        $this->sexo = $this->clubNna->sexo;

        $this->firmaDigitalRepresentante = $this->clubNna->firma_digital_representante;
        $this->firmaDigitalNna = $this->clubNna->firma_digital_nna;

        $this->encuentras_estudiando = $this->clubNna->encuentras_estudiando;
        $this->ultimo_grado_alcanzado = $this->clubNna->ultimo_grado_alcanzado_gwdata_id;
        $this->posee_discapacidad = $this->clubNna->posee_discapacidad;

        $this->grado_id = $this->clubNna->grado_gwdata_id;
        $this->seccion_id = $this->clubNna->seccion_gwdata_id;
        $this->turno_id = $this->clubNna->turno_gwdata_id;

        $this->sede_departamento_id = $this->clubNna->departamento_escuela_gwdata_code_state;

        $this->laboraCiudades = MunicipioGWDATA::where('fkCodeState', $this->sede_departamento_id)
                ->orderBy('name')
                ->pluck("name", "codeMunicipality");

        if ($this->laboraCiudades->isNotEmpty()) {
            $this->sede_ciudad_id = $this->clubNna->municipio_escuela_gwdata_code_municipality;
        }

        $this->perteneceSede = EscuelaGWDATA::active()
            ->where('fkCodeMunicipality', $this->sede_ciudad_id)
            ->where('fkCodeCountry', $this->pais->codigo)
            ->orderBy('name')
            ->pluck('name', 'id');

        $this->sede_id = $this->clubNna->escuela_gwdata_id;

        $this->departamento_id = $this->clubNna->departamento_reside_gwdata_code_state;

        /// ciudad reside
        $this->ciudades = MunicipioGWDATA::where('fkCodeState', $this->departamento_id)
            ->orderBy('name')
            ->pluck("name", "codeMunicipality");

        $this->ciudad_id = $this->clubNna->municipio_reside_gwdata_code_municipality;

        $this->discapacidadesSelect = !empty($this->clubNna->discapacidades) ? json_decode($this->clubNna->discapacidades) : [];

    }

    public function save(){

       
        $this->validate();

        DB::transaction(function() {

            $now = Carbon::now($this->pais->timezone);

            $this->clubNna->autorizacion_participacion = $this->autorizacion_participacion;
            $this->clubNna->autorizacion_datos_personales = $this->autorizacion_datos_personales;
            $this->clubNna->autorizacion_voz_image = $this->autorizacion_voz_image;
            $this->clubNna->autorizacion_consentimiento = $this->autorizacion_consentimiento;

            $this->clubNna->nombres_responsable = $this->nombres_responsable;
            $this->clubNna->parentesco_gwdata_id = $this->parentesco;
            $this->clubNna->telefono = $this->telefono;
            $this->clubNna->documento_identidad = $this->documento_identidad;

            $this->clubNna->confirmo_copia_documento = $this->confirmo_copia_documento;
            $this->clubNna->informado_sobre_nna = $this->informado_sobre_nna;
            $this->clubNna->nna_ha_escuchado = $this->nna_ha_escuchado;
            $this->clubNna->leido_comprendido = $this->leido_comprendido;
            $this->clubNna->deseo_participar = $this->deseo_participar;
            $this->clubNna->uso_recoleccion_datos = $this->uso_recoleccion_datos;
            $this->clubNna->uso_imagen = $this->uso_imagen;
            $this->clubNna->autorizacion_nna = $this->autorizacion_nna;

            $this->clubNna->firma_digital_representante = $this->firmaDigitalRepresentante;
            $this->clubNna->firma_digital_nna = $this->firmaDigitalNna;


            $this->clubNna->nacionalidad = $this->nacionalidad;
            $this->clubNna->ha_participado_anteriormente = $this->ha_participado_anteriormente;
            $this->clubNna->nombres = $this->nombres;
            $this->clubNna->apellidos = $this->apellidos;
            $this->clubNna->fecha_nacimiento = $this->fecha_nacimiento;
            $this->clubNna->sexo = $this->sexo;


            $this->clubNna->encuentras_estudiando = $this->encuentras_estudiando;
            $this->clubNna->ultimo_grado_alcanzado_gwdata_id = $this->ultimo_grado_alcanzado;
            $this->clubNna->posee_discapacidad = $this->posee_discapacidad;

            if ($this->clubNna->posee_discapacidad == 1) {
                $this->clubNna->discapacidades = json_encode($this->discapacidadesSelect);
            }

            $this->clubNna->escuela_gwdata_id = $this->sede_id;
            $this->clubNna->grado_gwdata_id = $this->grado_id;
            $this->clubNna->seccion_gwdata_id = $this->seccion_id;
            $this->clubNna->turno_gwdata_id = $this->turno_id;

            $this->clubNna->departamento_escuela_gwdata_code_state = $this->sede_departamento_id;
            $this->clubNna->municipio_escuela_gwdata_code_municipality = $this->sede_ciudad_id;

            $this->clubNna->pais_id = $this->pais->id;

            $this->clubNna->municipio_reside_gwdata_code_municipality = $this->ciudad_id;
            $this->clubNna->departamento_reside_gwdata_code_state = $this->departamento_id;

            $this->clubNna->pais_id = $this->pais->id;

            $this->clubNna->active_at = $now;

            $this->clubNna->save();



            if (empty($this->inscripcion->codigo_confirmacion)) {
                $this->codigo_confirmacion = TicketCode::generateFor($this->clubNna);
                $this->clubNna->codigo_confirmacion = $this->codigo_confirmacion;
                $this->clubNna->save();
            }

            /// Signature
            if($this->signature_responsable && $this->firmaDigitalRepresentante){
                $this->storeSignature($this->signature_responsable, 'responsable', $this->clubNna->id);
            }

            if($this->signature_nna && $this->firmaDigitalNna){
                $this->storeSignature($this->signature_nna, 'nna', $this->clubNna->id);
            }

        });

    }

    protected function rules(): array
    {
      
        return  [
            'autorizacion_participacion' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!in_array($value, ['1', 1])) {
                        $fail('La autorización de participación debe ser aceptada.');
                    }
                },
            ],
            'autorizacion_datos_personales' => 'required|boolean',
            'autorizacion_voz_image' => 'required|boolean',
            'autorizacion_consentimiento' => 'required|boolean',

            'nombres_responsable' => 'required|string|max:255',
            'parentesco' => 'required',
            'telefono' => 'required|regex:/^[0-9]+$/',
            'documento_identidad' => 'required'.$this->ruleDui(),
            'confirmo_copia_documento' => 'required|boolean',
            'informado_sobre_nna' => 'required|boolean',
            'nna_ha_escuchado' => 'required|boolean',
            'leido_comprendido' => 'required|boolean',
            'deseo_participar' => 'required|boolean',
            'uso_recoleccion_datos' => 'required|boolean',
            'uso_imagen' => 'required|boolean',
            'autorizacion_nna' => 'nullable|boolean',
            'nacionalidad' => 'required',
            'ha_participado_anteriormente' => 'required|boolean',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required',
            'encuentras_estudiando' => 'required|boolean',
            'ultimo_grado_alcanzado' => 'nullable',
            'posee_discapacidad' => 'required',
            'sede_id' => 'nullable',
            'grado_id' => 'nullable',
            'seccion_id' => 'nullable',
            'turno_id' => 'nullable',
            'departamento_id' => 'required',
            'ciudad_id' => 'required',
            'sede_departamento_id' => 'nullable',
            'sede_ciudad_id' => 'nullable',
            'signature_responsable' => [
                Rule::requiredIf(function () {
                    return in_array($this->firmaDigitalRepresentante, [1, '1'], true) && !$this->isFastEdit;
                })
            ],
            'signature_nna' => [
                Rule::requiredIf(function () {
                    return in_array($this->firmaDigitalNna, [1, '1']) && !$this->isFastEdit;
                })
            ],
        ];;
    }

    protected function messages(): array
    {
        $labels = $this->getLabels();

        return [
            'documento_identidad.required' => 'El campo '. $labels['dni'] . ' es obligatorio',
            'documento_identidad.min' => 'El campo '. $labels['dni'] . ' debe tener al menos '.$this->dui_minlength.' caracteres.',
            'documento_identidad.max' => 'El campo '. $labels['dni'] . ' no debe exceder '.$this->dui_maxlength.' caracteres.',
            'signature_responsable.required' => 'La firma del responsable es obligatoria.',
            'signature_nna.required' => 'La firma del NNA es obligatoria.',
        ];
    }

   

    public function setDuiFormat()
    {
        $this->dui_maxlength = null;
        $this->dui_minlength = null;

        if ( in_array( $this->pais->id, [1,3]) ) { //Guatemala, Honduras
            $this->dniformat = "9999-9999-99999";
            $this->duiplaceholder = "0000-0000-00000";
        }elseif ($this->pais->id == 2) { // El Salvador
            $this->dniformat = "99999999-9";
            $this->duiplaceholder = "000000000-0";
        }elseif($this->pais->id == 4){
            $this->dui_maxlength = 18;
            $this->dui_minlength = 10;
        }
    }
    public function ruleDui(){
        if($this->pais->id == 4){
            return '|min:'.$this->dui_minlength.'|max:'. $this->dui_maxlength;
        }
        return '';
    }

    protected function storeSignature($signature, $persona, $club_nna_id)
    {
        try {
            $filename = 'firma_' . $persona. '_'. $club_nna_id . '.png';


            $base64Image = str_replace(['data:image/png;base64,', ' '], ['', '+'], $signature);
            $imageData = base64_decode($base64Image);

            if ($imageData === false) {
                throw new Exception('La imagen base64 no pudo ser decodificada.');
            }

            // Crear un archivo temporal
            $tempFilePath = tempnam(sys_get_temp_dir(), 'signature_');

            if ($tempFilePath === false) {
                throw new Exception('No se pudo crear un archivo temporal.');
            }

            // Escribir datos en el archivo temporal
            if (file_put_contents($tempFilePath, $imageData) === false) {
                throw new Exception('No se pudo escribir la imagen en el archivo temporal.');
            }

            // Subir el archivo al disco S3
            Storage::disk('s3')->put(
                'club_nna/' . $filename,
                file_get_contents($tempFilePath),
                'public'
            );
        } catch (Exception $e) {
            // Manejar excepciones o errores
            logger()->error('Error al procesar y subir la firma: ' . $e->getMessage());
            throw $e; // O manejar la excepción como prefieras
        } finally {

            if (isset($tempFilePath) && file_exists($tempFilePath)) {
                unlink($tempFilePath);
            }
        }

    }
}
