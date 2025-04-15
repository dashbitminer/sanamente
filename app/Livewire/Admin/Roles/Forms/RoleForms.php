<?php
namespace App\Livewire\Admin\Roles\Forms;

use App\Models\Role;
use Livewire\Form;
use Illuminate\Validation\Rule;

class RoleForms extends Form
{
    public Role $role;

    public $readonly = false;

    public $showValidationErrorIndicator;

    public $nombre;

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
        ];
    }

    public function setRole($id){
        $this->role = Role::find($id);
        $this->nombre = $this->role->name;
    }

    public function unsetRole(){
        unset($this->role);
    }

    public function clearFields(){
        $this->nombre = '';
    }

    public function save()
    {
        $this->validate();

        if($this->isEdit){
            $this->role->name = $this->nombre;
            $this->role->save();
        }else{
            Role::create([
                'name' => $this->nombre,
            ]);
        }

        
    }
}