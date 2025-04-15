<?php
namespace App\Livewire\Admin\Permisos\Forms;

use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;
use Illuminate\Validation\Rule;

class PermisoForms extends Form
{
    public Permission $permission;

    public $readonly = false;

    public $showValidationErrorIndicator;

    public $nombre;

    public $categoria;

    public $descripcion;

    public $isEdit = false;

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $this->showValidationErrorIndicator = true;
            }
        });
    }

    protected function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'required'
        ];
    }

    public function setPermission($id){
        $this->permission = Permission::find($id);
        $this->nombre = $this->permission->name;
        $this->categoria = $this->permission->categoria;
        $this->descripcion = $this->permission->descripcion;
    }

    public function unsetPermission(){
        unset($this->permission);
    }

    public function clearFields(){
        $this->nombre = '';
        $this->categoria = '';
        $this->descripcion = '';
    }

    public function save()
    {
        $this->validate();

        if($this->isEdit){
            $this->permission->name = $this->nombre;
            $this->permission->categoria = $this->categoria;
            $this->permission->descripcion = $this->descripcion;
            $this->permission->save();
        }else{
            Permission::create([
                'name' => $this->nombre,
                'categoria' => $this->categoria,
                'descripcion' => $this->descripcion,
            ]);
        }

        
    }
}