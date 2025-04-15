<?php

namespace App\Exports;

use DateTime;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClubNnaExport implements FromQuery, WithMapping, WithHeadings
{

    use Exportable;

    public $selectedRecordIds = [];

    public $filters;

    public $pais;

    private $rowNumber = 1;

    public $search;

    public function __construct($selectedRecordIds, $filters, $pais, $search)
    {
        $this->selectedRecordIds = $selectedRecordIds;

        $this->filters = $filters;

        $this->pais = $pais;

        $this->search = $search;
    }


    public function query()
    {
        $query = \App\Models\ClubNNA::with([
            "parentescoGWDATA:id,name",
            "escuelaGWDATA:id,code,name,alias,fkCodeState,fkCodeMunicipality",
            "escuelaGWDATA.municipio:id,codeMunicipality,name",
            "escuelaGWDATA.departamento:id,codeState,name",
            "seccionGWDATA:id,name",
            "ultimoGradoGWDATA:id,name",
            "nivelAcademicoGWDATA:id,name",
            "departamentoReside",
            "municipioReside",
            ])
            ->where('pais_id', $this->pais->id);

        $query = $this->applySearch($query);

        $query = $this->filters->apply($query);

        return $query;
    }

    public function headings(): array
    {
        return [
            '#',
            'Pais',
            'Código recepción',
            'Autorización participación responsable',
            'Autorización datos personales responsable',
            'Autorización uso voz e imagen responsable',
            'Consentimiento participar en encuesta',
            'Nombre del adulto responsable',
            'Parentesco',
            'Documento de identidad',
            'Teléfono',
            'Confirmo recibir copia documento',
            'Informado del propósito',
            'NNA ha sido escuchada',
            'Leido y comprendido el documento',
            'Autorización de participación NNA',
            'Autorización de uso de información NNA',
            'Autorización de uso de voz e imagen NNA',
            'Autorizo mi participación encuesta',
            'Nacionalidad',
            'Participo en años anteriores actividades GW',
            'Nombres completos',
            'Apellidos completos',
            'Nombres completos mayúscula',
            'Apellidos completos mayúscula',
            'Fecha de nacimiento',
            'Sexo',
            '¿Se encuentra estudiando actualmente?',
            'Ultimo grado alcanzado',
            '¿Discapacidad?',
            'Departamento de la escuela',
            'Municipio de la escuela',
            'Escuela',
            'Grado',
            'Sección',
            'Turno',
            'Club',
            'Departamento reside',
            'Municipio reside',
            'Fecha de registro',
        ];
    }

    /**
     * @param Invoice $invoice
     */
    public function map($formulario): array
    {
        return [
            $this->rowNumber++, // #
            $this->pais->nombre, // Pais
            $formulario->codigo_confirmacion, // Código recepción
            $formulario->autorizacion_participacion == 1 ? "Si" : "No", // Autorización participación responsable
            $formulario->autorizacion_datos_personales == 1 ? "Si" : "No", // Autorización datos personales responsable
            $formulario->autorizacion_voz_image == 1 ? "Si" : "No", // Autorización uso voz e imagen responsable
            $formulario->autorizacion_consentimiento == 1 ? "Si" : "No", // Consentimiento participar en encuesta
            $formulario->nombres_responsable, // Nombre del adulto responsable
            $formulario->parentescoGWDATA->name ?? "",
            $formulario->documento_identidad, // Documento de identidad
            $formulario->telefono, // Teléfono
            $formulario->confirmo_copia_documento == 1 ? "Si" : "No",
            $formulario->informado_sobre_nna == 1 ? "Si" : "No",
            $formulario->nna_ha_escuchado == 1 ? "Si" : "No",
            $formulario->leido_comprendido == 1 ? "Si" : "No",
            $formulario->deseo_participar == 1 ? "Si" : "No",
            $formulario->uso_recoleccion_datos == 1 ? "Si" : "No",
            $formulario->uso_imagen == 1 ? "Si" : "No",
            $formulario->autorizacion_nna == 1 ? "Si" : "No",
            $formulario->nacionalidad == 1 ? "Nacional" : "Extranjero",
            $formulario->ha_participado_anteriormente == 1 ? "Si" : "No",
            $formulario->nombres, // Nombres completos
            $formulario->apellidos, // Apellidos completos
            $formulario->formatted_nombres_to_upper_case,
            $formulario->formatted_apellidos_to_upper_case, 
            (new DateTime($formulario->fecha_nacimiento))->format("d/m/Y"), // Fecha de nacimiento
            $formulario->sexo == 1 ? 'Mujer' : 'Hombre', // Sexo
            $formulario->encuentras_estudiando == 1 ? "Si" : "No",
            $formulario->ultimoGradoGWDATA->name ?? '',
            $this->getDisablities($formulario->discapacidades),
            $formulario->escuelaGWDATA->departamento->name ?? '',
            $formulario->escuelaGWDATA->municipio->name ?? '',
            $formulario->escuelaGWDATA->name ?? '',
            $formulario->nivelAcademicoGWDATA->name ?? '',
            $formulario->seccionGWDATA->name ?? '',
            $formulario->turnoGWDATA->name ?? '',
            '', //club
            $formulario->departamentoReside->name ?? '',
            $formulario->municipioReside->name ?? '',
            $formulario->created_at->format("d/m/Y H:i:s"), // Fecha de registro
        ];
    }

    protected function applySearch($query)
    {
        if($this->search === ''){
            return $query;
        }

        $this->search = trim($this->search);

        $getSchoolsIds = \App\Models\EscuelaGWDATA::where('fkCodeCountry', $this->pais->codigo)->where('name', 'like', '%'.$this->search.'%')
                                                                                ->orWhere('alias', 'like', '%'.$this->search.'%')
                                                                                ->pluck('id')->toArray();


        return $query->where(function($query) use ($getSchoolsIds){
            $query->where('nombres', 'like', '%'.$this->search.'%')
            ->orWhere('apellidos', 'like', '%'.$this->search.'%')
            ->orWhere('codigo_confirmacion', 'like', '%'.$this->search.'%')
            ->orWhere('documento_identidad', 'like', '%'.$this->search.'%')
            ->orWhereIn('escuela_gwdata_id', $getSchoolsIds);
            // ->orWhereHas('paisPerfilSeguimiento', function ($query) {
            //     $query->whereHas('perfilSeguimiento', function ($query) {
            //         $query->where('nombre', 'like', '%'.$this->search.'%');
            //     });
            // });
        });

       // return

    }

    protected function getDisablities($disabilities)
    {
        if(!$disabilities){
            return '';
        }

        $discapacidades = json_decode($disabilities, true);

        return \App\Models\DiscapacidadGWDATA::whereIn('id', $discapacidades)->get()->pluck('name')->implode(', ');
    }

}
