<?php

namespace App\Exports;

use App\Livewire\Admin\User\Index\Searchable;
use App\Livewire\Admin\User\Index\Filters;
use App\Models\User;
use DateTime;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromQuery, WithMapping, WithHeadings
{

    use Exportable;

    public $selectedRecordIds = [];

    public $filters;

    public $pais;

    private $rowNumber = 1;

    public $search;

    public function __construct($selectedRecordIds, $filters, $search)
    {
        $this->selectedRecordIds = $selectedRecordIds;

        $this->filters = $filters;

        $this->search = $search;
    }


    public function query()
    {
        $query = User::with('roles', 'pais');

        $query = $this->applySearch($query);

        $query = $this->filters->apply($query);

        $query->when(!empty($this->selectedRecordIds), function ($query) {
            $query->whereIn('id', $this->selectedRecordIds);
        });

        return $query;
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Email',
            'Pais',
            'Role',
            'Fecha Registro',
        ];
    }

    /**
     * @param Invoice $invoice
     */
    public function map($formulario): array
    {
        return [
            $this->rowNumber++, // #
            $formulario->name, 
            $formulario->email,
            $formulario->pais->nombre, 
            $formulario->roles->pluck('name')->implode(', '), 
            $formulario->dateForHumans()
        ];
    }

    protected function applySearch($query)
    {
        if($this->search === ''){
            return $query;
        }

        $this->search = trim($this->search);
        
        return $query->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orWhereHas('roles', function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->orWhereHas('pais', function ($query) {
                $query->where('nombre', 'like', '%'.$this->search.'%');
            });

    }

}
