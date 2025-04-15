<?php

namespace Database\Seeders;

use App\Models\Pais;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pais::create([
            'nombre' => 'Guatemala',
            'slug' => 'guatemala',
            'codigo' => '+502',
            'timezone' => 'America/Guatemala',
            'active_at' => now(),
        ]);

        Pais::create([
            'nombre' => 'El Salvador',
            'slug' => 'el-salvador',
            'codigo' => '+503',
            'timezone' => 'America/El_Salvador',
            'active_at' => NULL,
        ]);

        Pais::create([
            'nombre' => 'Honduras',
            'slug' => 'honduras',
            'codigo' => '+504',
            'timezone' => 'America/Tegucigalpa',
            'active_at' => NULL,
        ]);
    }
}
