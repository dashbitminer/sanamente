<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosGenericosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Usuario de prueba México',
            'email' => 'mexico@glasswing.org',
            'pais_id' => 4,
        ])->assignRole('Staff técnico');

        \App\Models\User::factory()->create([
            'name' => 'Usuario de prueba Panamá',
            'email' => 'panama@glasswing.org',
            'pais_id' => 6,
        ])->assignRole('Staff técnico');

        \App\Models\User::factory()->create([
            'name' => 'Usuario de prueba Costa Rica',
            'email' => 'costarica@glasswing.org',
            'pais_id' => 7,
        ])->assignRole('Staff técnico');

        \App\Models\User::factory()->create([
            'name' => 'Usuario de prueba Colombia',
            'email' => 'colombia@glasswing.org',
            'pais_id' => 8,
        ])->assignRole('Staff técnico');
    }
}
