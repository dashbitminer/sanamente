<?php
namespace App\Livewire\Admin\User\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;
use Illuminate\Validation\Rule;

class UserForms extends Form
{
    public User $user;

    public $readonly = false;

    public $showValidationErrorIndicator;

    public $nombre;

    public $email;

    public $password;

    public $password_confirmation;

    public $role = [];

    public $pais;

    public $isEdit = false;

    public $active = false;

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
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id ?? null),
            ],
            'password' => $this->isEdit ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
            'password_confirmation' => $this->isEdit ? 'nullable|string|min:8' : 'required|string|min:8',
            'role'  => 'required',
            'pais' => 'required'
        ];
    }

    public function setUser($id){
        $this->user = User::find($id);
        $this->nombre = $this->user->name;
        $this->email = $this->user->email;
        $this->pais = $this->user->pais_id;
        $this->role = $this->user->roles->pluck('id')->toArray();
        $this->active = $this->user->active_at !== null;
    }

    public function unsetUser(){
        unset($this->user);
    }

    public function clearFields(){
        $this->nombre = '';
        $this->email = '';
        $this->pais = '';
        $this->role = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->active = false;
    }

    public function save()
    {
        $this->validate();

        if($this->isEdit){
            $this->user->name = $this->nombre;
            $this->user->email = $this->email;

            if (!empty($this->password)) {
                $this->user->password = Hash::make($this->password);
            }

            $this->user->pais_id = $this->pais;
            $this->user->save();

            if ($this->user->roles->pluck('id')->toArray() !== $this->role) {
                $this->user->roles()->sync($this->role);
            }

            if($this->active){
                $this->user->activate();
            }else {
                $this->user->deactivate();
            }

        }else{
            $user = User::create([
                'name' => $this->nombre,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'pais_id' => $this->pais
            ]);


            if (!auth()->user()->hasRole('Super_Admin') && in_array('Super_Admin', $this->role)) {
                unset($this->role[array_search('Super_Admin', $this->role)]);
            }
    
            $user->roles()->sync($this->role);

            if($this->active){
                $user->activate();
            }else {
                $user->deactivate();
            }
        }

        
    }
}