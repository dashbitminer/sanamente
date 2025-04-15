<?php 

namespace App\Livewire\FRP\Traits;

use App\Models\EscuelaGWDATA;
use App\Models\MunicipioGWDATA;
use Carbon\Carbon;

trait WithFormUtility
{
    public function updated($name, $value)
    {
        switch ($name) {
            case 'form.departamento_id':
                /*$this->form->ciudades = MunicipioGWDATA::where('fkCodeState', $value)
                    ->pluck('name', 'codeMunicipality');*/
                $this->form->ciudades = EscuelaGWDATA::getUniqueMunicipalitiesWithActiveSchoolsAndComponents($this->pais->codigo, $value)
                    ->pluck('name', 'codeMunicipality');
                break;
            case 'form.nacionalidad':
                if ($value == $this->form::EXTRANJERO) {
                    $this->form->dniformat = "";
                    $this->form->duiplaceholder = "";
                }else{
                    $this->form->setDuiFormat();
                }

                break;
            case 'form.fecha_nacimiento':
                try {
    
                    $this->form->edad = Carbon::parse($value)->age;
        
                    
                    if ($this->edad === 'menor' && $this->form->edad >= 18) {
                        $this->addError($name, 'Solo puedes registrar participantes menores de edad.');
                    } elseif ($this->edad === 'mayor' && $this->form->edad < 18) {
                        $this->addError($name, 'Solo puedes registrar participantes mayores de edad.');
                    } else {
                        $this->resetErrorBag($name);
                    }
                } catch (\Exception $e) {
                    $this->addError($name, 'Por favor, ingresa una fecha válida.');
                }
            break;
            case 'form.fecha_registro': 
                if (Carbon::parse($value)->greaterThan(Carbon::today())) {
                    $this->addError($name, 'La Fecha de registro no puede ser posterior a hoy.');
                }
                break;
            case 'form.nombres';
                $this->nombreCompleto = $this->form->nombres . ' '. $this->form->apellidos;
            break;
            case 'form.apellidos';
                $this->nombreCompleto = $this->form->nombres . ' '. $this->form->apellidos;
            break;

            default:
                break;
        }
    }
}