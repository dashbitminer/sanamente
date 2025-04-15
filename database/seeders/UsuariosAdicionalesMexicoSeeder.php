<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosAdicionalesMexicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            // ['name' => 'Carolina Lagunas Celaya', 'email' => 'clagunas@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'México'],
            // ['name' => 'Sara Miranda Herrera', 'email' => 'sherrera@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'México'],
            // ['name' => 'Carolina Hernández Gutiérrez', 'email' => 'cgutierrez@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'México'],
            ['name' => 'Alejandro Hernández', 'email' => 'amendoza@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'México'],
        ];

        foreach ($users as $usuario) {
            $pais = 4;
            // if($usuario['pais'] == 'Honduras'){
            //     $pais = 3;
            // }elseif($usuario['pais'] == 'México'){
            //     $pais = 4;
            // }elseif($usuario['pais'] == 'Guatemala'){
            //     $pais = 1;
            // }

            if (\App\Models\User::where('email', $usuario['email'])->exists()) {
                continue;
            }

            \App\Models\Role::firstOrCreate(['name' => $usuario['rol']]);

            \App\Models\User::factory()->create([
                'name' => $usuario['name'],
                'email' => $usuario['email'],
                'pais_id' => $pais,
            ])->assignRole($usuario['rol']);
        }

    }
}
