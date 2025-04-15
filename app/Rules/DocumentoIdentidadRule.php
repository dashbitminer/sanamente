<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DocumentoIdentidadRule implements ValidationRule
{

    protected $pais;
    protected $nacionalidad;

    public function __construct($pais, $nacionalidad)
    {
        $this->pais = $pais;
        $this->nacionalidad = $nacionalidad;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->nacionalidad == 2) {
            return;
        }

        // GUATEMALA
        // if ($this->pais->id == 1 && strlen($value) != 13 ) {
        //     $fail('El :attribute debe de ser de 13 caracteres.');
        // }

        if ($this->pais->id == 1 && !$this->isDpiGuatemala($value)) {
            $fail('El :attribute debe de ser un DPI valido para Guatemala con exactamente 13 digitos.');
        }

        //EL SALVADOR

        // if ($this->pais->id == 2 && strlen($value) != 9) {
        //     $fail('El :attribute debe de tener 9 digitos.');
        // }

        if ($this->pais->id == 2 && !$this->isDui($value)) {
            $fail('El :attribute debe de ser un DUI valido para El Salvador en el formato 12345678-9.');
        }

        //HONDURAS
        // if ($this->pais->id == 3 && strlen($value) != 13) {
        //     $fail('El :attribute debe de tener 13 digitos.');
        // }
        if ($this->pais->id == 3 && !$this->isDniHonduras($value)) {
            $fail('El :attribute debe de ser un DUI valido para Honduras en el formato 1234-5678-12345.');
        }

        //return true;
    }

    // if (isDui("00016297-5"))
    private function isDui($dui)
    {
        $dui = str_replace('-', '', $dui);
        return preg_match('/^\d{9}$/', $dui);

        // if (preg_match('/^\d{9}-\d$/', $dui)) {
        //     $digitoVerificador = (int)substr($dui, 9, 1);
        //     $suma = 0;

        //     for ($i = 9; $i >= 2; $i--) {
        //         $digito = (int)substr($dui, 9 - $i, 1);
        //         $suma += ($i * $digito);
        //     }

        //     $residuoVerificador = 10 - ($suma % 10);

        //     if ($digitoVerificador == $residuoVerificador || $residuoVerificador == 0) {
        //         return true;
        //     } else {
        //         return false;
        //     }
        // } else {
        //     return false;
        // }
    }

    private function isDpiGuatemala($dpi)
    {
        $dpi = str_replace('-', '', $dpi);
        // Check if the DPI matches the required format (13 digits)
        return preg_match('/^\d{13}$/', $dpi);
    }

    private function isDniHonduras($dni)
    {
        $dni = str_replace('-', '', $dni);
        // Check if the DNI matches the required format (13 digits)
        return preg_match('/^\d{13}$/', $dni);
    }
}
