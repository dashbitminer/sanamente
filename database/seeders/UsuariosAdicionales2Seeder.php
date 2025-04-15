<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosAdicionales2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            ['name' => 'Liz Valeria Suarez Periñan', 'email' => 'lsuarez@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Colombia'],
            ['name' => 'Laura Sofía Cardona Ríos', 'email' => 'lcardona@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Colombia'],
            ['name' => 'Verónica Navarro Blanco', 'email' => 'vnavarro@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Costa Rica'],
            ['name' => 'Katherine Gutierrez Valverde', 'email' => 'kgutierrez@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Costa Rica'],
            ['name' => 'Camila Silva', 'email' => 'camilasilva@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Panamá'],
            ['name' => 'Karina Castillo', 'email' => 'kvaldes@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Panamá'],
            ['name' => 'Ana Lucia Saenz', 'email' => 'alsaenz@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Colombia'],
            ['name' => 'Andrea Moreno Posada', 'email' => 'amoreno@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Colombia'],
            ['name' => 'Karen Lucia Esteban', 'email' => 'kesteban@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'Guatemala'],
            ['name' => 'Fabrizi Abisai Juarez', 'email' => 'fjuarez@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'Guatemala'],
            ['name' => 'Sheny Gonzales', 'email' => 'sgonzalez@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'Guatemala'],
        ];

        foreach ($users as $usuario) {
            $pais = 2;
            switch ($usuario['pais']) {
                case 'Guatemala':
                    $pais = 1;
                    break;
                case 'El Salvador':
                    $pais = 2;
                    break;
                case 'Honduras':
                    $pais = 3;
                    break;
                case 'México':
                    $pais = 4;
                    break;
                case 'Panamá':
                    $pais = 6;
                    break;
                case 'Costa Rica':
                    $pais = 7;
                    break;
                case 'Colombia':
                    $pais = 8;
                    break;
                default:
                    $pais = 2;
                    break;
            }


            if (\App\Models\User::where('email', $usuario['email'])->exists()) {
                continue;
            }

            \App\Models\User::factory()->create([
                'name' => $usuario['name'],
                'email' => $usuario['email'],
                'pais_id' => $pais,
            ])->assignRole($usuario['rol']);
        }



        // \App\Models\User::factory()->create([
        //     'name' => 'Usuario de prueba El Salvador',
        //     'email' => 'elsalvador@glasswing.org',
        //     'pais_id' => 2,
        // ])->assignRole('Staff técnico');

        // \App\Models\User::factory()->create([
        //     'name' => 'Usuario de prueba Honduras',
        //     'email' => 'honduras@glasswing.org',
        //     'pais_id' => 3,
        // ])->assignRole('Staff técnico');
    }
}
