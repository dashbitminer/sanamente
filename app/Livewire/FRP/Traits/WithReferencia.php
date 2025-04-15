<?php

namespace App\Livewire\FRP\Traits;

use App\Facades\TicketCode;
use App\Models\Referencia;
use App\Models\ReferenciaParticipante;
use Exception;
use Illuminate\Support\Facades\Storage;
use Str;

trait WithReferencia
{
    public $fecha_registro;

    public $accion_inmediata_id = [];

    public $accion_inmediata_otro;

    public $motivo_referencia_id = [];

    public $tipo_violencia_id = [];

    public $motivo_referencia_otro;

    public $comentarios;

    public $activacion_protocolos; // ---

    public $documento_protocolos; // ---

    public $documento_protocolos_upload; // ---

    public $tipo_servicio_id = [];

    public $tipo_servicio_salud_mental_id;

    public $tipo_servicio_otra;

    public $institucion_refiere_id;

    public $nombre_otra_institucion;

    public $parametro_urgencia_id;

    public $modalid_consentimiento_id;

    public $documento_consentimientos;

    public $documento_consentimientos_upload;

    public $autorizacion_persona_adulta;  // ---

    public $documento_autorizacion_persona_adulta;  // ---

    public $documento_autorizacion_persona_adulta_upload;

    public $acepta_referencia;  // ---

    public $autoriza_adulto;  // ---

    public $origen_consentimiento_id;

    public $sexo_persona_contacta;

    public $fecha_recibe_referencia;

    public $razon_no_acepta_referencia_id;

    public $signature_persona;

    public $signature_autoriza_adulto;

    public $documento_consentimiento_url;

    public $codigo_confirmacion;

    public $fields = [
        'fecha_registro' => 'fecha_registro',
        'accion_inmediata_otro' => 'accion_inmediata_otro',
        'motivo_referencia_otro' => 'motivo_referencia_otro',
        'comentarios' => 'comentario',
        'activacion_protocolos' => 'activacion_protocolos',
        'documento_protocolos' => 'documento_protocolos',
        'tipo_servicio_salud_mental_id' => 'pais_salud_mental_servicio_id',
        'tipo_servicio_otra' => 'tipo_servicio_otro',
        'institucion_refiere_id' => 'pais_institucion_referencia_id',
        'nombre_otra_institucion' => 'nombre_otra_institucion',
        'parametro_urgencia_id' => 'pais_urgencia_referencia_parametro_id',
        'modalid_consentimiento_id' => 'pais_modalidad_consentimiento_id',
        'documento_consentimientos' => 'documento_consentimientos',
        'autorizacion_persona_adulta' => 'autorizacion_persona_adulta',
        'documento_autorizacion_persona_adulta' => 'documento_autorizacion_persona_adulta',
        'acepta_referencia' => 'acepta_referencia',
        'autoriza_adulto' => 'autoriza_adulto',
    ];

    public function crearReferencia(ReferenciaParticipante $referenciaParticipante){
        $referencia = new Referencia();

        $referencia->referencia_participante_id = $referenciaParticipante->id;

        foreach ($this->fields as $key => $value) {
            if (property_exists($this, $key)) {
                $referencia->{$value} = $this->{$key};
            }
        }
        
        if($this->documento_consentimientos){
            $this->documento_consentimientos
                ->store('referencia_participantes/document_consentimientos-sanamente', 's3');
        }

        if($this->documento_protocolos){
            $this->documento_protocolos
                ->store('referencia_participantes/document_protocolos', 's3');
        }

        $referencia->save();

        $this->accionInmediata($referencia);
        $this->motivoReferencia($referencia);
        $this->tipoServicio($referencia);

        $this->codigo_confirmacion = TicketCode::generateFor($referenciaParticipante);

        $referencia->codigo_confirmacion = $this->codigo_confirmacion;
        $referencia->save();

        if($this->signature_persona){
            $this->storeSignature($this->signature_persona, 'referencia_firmas',  $referencia->id);
        }

        if($this->signature_autoriza_adulto){
            $this->storeSignature($this->signature_autoriza_adulto, 'autorizacion_adultos_firmas',  $referencia->id);
        }
    
        return $referencia;
    }

    /**
     * Summary of accionInmediata
     * @param mixed $referencia
     * @return void
     */
    public function accionInmediata(&$referencia){
        $referencia->accionInmediata()->detach();
        $referencia->accionInmediata()->sync($this->accion_inmediata_id);
    }

    /**
     * Summary of motivoReferencia
     * @param mixed $referencia
     * @return void
     */
    public function motivoReferencia(&$referencia)
    {
        $referencia->motivo()->detach();
        $referencia->motivo()->sync($this->motivo_referencia_id);

        $violencia = $this->pais->motivoReferencia()
            ->whereIn('pais_motivo_referencias.id', $this->motivo_referencia_id)
            ->where('motivo_referencias.slug', 'sobreviviente-de-violencia')
            ->count();

        if($violencia){
            $referencia->tipoViolencia()->detach();
            $referencia->tipoViolencia()->sync($this->tipo_violencia_id);
        }
    }

    public function tipoServicio(&$referencia)
    {
        $referencia->tipoServicio()->detach();
        $referencia->tipoServicio()->sync($this->tipo_servicio_id);
    }

    /**
     * Summary of setReferenciaProperties
     * @return void
     */
    public function setReferenciaProperties(){
        foreach ($this->fields as $key => $value) {
            $this->{$key} = $this->referencia->{$value};
        }
        $this->documento_consentimiento_url = asset('storage/referencia-participantes/document_protocolos/' . $this->documento_protocolos);

        $this->accion_inmediata_id = $this->referencia->accionInmediata()
            ->pluck('pais_accion_inmediata_id')
            ->toArray();
        
        $this->motivo_referencia_id = $this->referencia->motivo()
            ->pluck('pais_motivo_referencia_id')
            ->toArray();
        
        $this->tipo_violencia_id = $this->referencia->tipoViolencia()
            ->pluck('pais_tipo_violencia_id')
            ->toArray();
        
        $this->tipo_servicio_id = $this->referencia->tipoServicio()
            ->pluck('pais_tipo_servicio_id')
            ->toArray();
    }

    /**
     * Summary of storeSignature
     * @param mixed $signature
     * @param mixed $path
     * @param mixed $referencia_id
     * @throws \Exception
     * @return void
     */
    protected function storeSignature($signature, $path, $referencia_id)
    {
        try {
            $filename = 'firma_' . $referencia_id . '.png';
        
           
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
                'referencia_participantes/'.$path.'/' . $filename,
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