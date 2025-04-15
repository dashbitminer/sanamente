<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosAdicionalesVariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users2 = [
            ['name' => 'Sharon Kababie Coronas', 'email' => 'skababie@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'México'],
            ['name' => 'Shirley Quintero Benitez ', 'email' => 'squintero@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Colombia'],
            ['name' => 'Stefania Sáez Navarro', 'email' => 'ssaez@glasswing.org ', 'rol' => 'Staff técnico', 'pais' => 'Colombia'],
            ['name' => 'Patricia Arciniégas Rosales', 'email' => 'parciniegas@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Colombia'],
            ['name' => 'Katherine Zelaya Zepeda', 'email' => 'kzalaya@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Colombia'],
            ['name' => 'Camila Silva', 'email' => 'camilasilva@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Panamá'],
            ['name' => 'Karina Castillo', 'email' => 'kvaldes@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Panamá'],
        ];

        $users = [
            ['name' => 'Karla Sucely Veliz', 'email' => 'kveliz@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Erasmo León', 'email' => 'rleon@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Cristian Valladares', 'email' => 'cjvalladares@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Iris Girón', 'email' => 'igiron@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Jeaneth Marroquín', 'email' => 'jobarrera@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Paulina Díaz-Durán', 'email' => 'pdiaz@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Edgar Oliva', 'email' => 'eoliva@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Susana Cotzajay', 'email' => 'scotzajay@glasswing.gt', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Jireh Cruz', 'email' => 'ecruz@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Silvia Zapeta', 'email' => 'szapeta@Glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Andrea Vasquez', 'email' => 'apvasquez@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Veronica Caxaj', 'email' => 'vcaxaj@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Lesli Pérez', 'email' => 'lperez@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'Guatemala'],
            ['name' => 'Mercedes de los Ángeles Peña', 'email' => 'mrodriguez@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'Guatemala'],
            ['name' => 'Sheny Gonzalez', 'email' => 'szapeta@Glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'Guatemala'],
            ['name' => 'Neyba Dallana Santos Martinez', 'email' => 'nsantos@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Honduras'],
            ['name' => 'Silia Yaneth Barahona Hernandez', 'email' => 'sbarahona@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Honduras'],
            ['name' => 'Karol Elizabeth Carias Morales', 'email' => 'kcarias@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Honduras'],
            ['name' => 'Eva Yesenia Nuñez Romero', 'email' => 'enunez@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Honduras'],
            ['name' => 'Marvin Jose Garcia', 'email' => 'mjgarcia@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Honduras'],
            ['name' => 'Kelvin Vallecillo Leiva', 'email' => 'kleiva@glasswing.org', 'rol' => 'M&E', 'pais' => 'Honduras'],
        ];


        foreach ($users as $usuario) {
            $pais = 4;
            if ($usuario['pais'] == 'Honduras') {
                $pais = 3;
            } elseif ($usuario['pais'] == 'México') {
                $pais = 4;
            } elseif ($usuario['pais'] == 'Guatemala') {
                $pais = 1;
            } elseif ($usuario['pais'] == 'Colombia') {
                $pais = 8;
            } elseif ($usuario['pais'] == 'Panamá') {
                $pais = 6;
            } elseif ($usuario['pais'] == 'El Salvador') {
                $pais = 2;
            } elseif ($usuario['pais'] == 'Costa Rica') {
                $pais = 7;
            }

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
