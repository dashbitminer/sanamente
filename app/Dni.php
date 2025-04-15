<?php

namespace App;

use App\Models\Pais;

trait Dni
{


    public $mask = '';

    public $placeholder = '';

    public function setCountry(Pais $pais) {
        switch ($this->pais->nombre) {
            case 'Mexico':
                $this->mask = '';
                $this->placeholder = '';
                break;

            case 'Guatemala':
                $this->mask = '9999 99999 9999';
                $this->placeholder = '0000 00000 0000';
                break;

            case 'El Salvador':
                $this->mask = '99999999-9';
                $this->placeholder = '00000000-0';
                break;

            case 'Honduras':
                $this->mask = '9999-9999-99999';
                $this->placeholder = '0000-0000-00000';
                break;

            case 'Costa Rica':
                $this->mask = '9-9999-9999';
                $this->placeholder = '0-0000-0000';
                break;

            case 'Panamá':
                $this->mask = '9 999 9999';
                $this->placeholder = '9-999-9999';
                break;

            case 'Colombia':
                $this->mask = '9999999999';
                $this->placeholder = '0000000000';
                break;
        }

        return $this;
    }

    public function getMask(): string
    {
        return $this->mask;
    }

    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }
}
