<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pais;

class PaisExtendedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mexico = Pais::where('slug', 'mexico')->first();

        if (!$mexico) {
            $mexico = Pais::create([
                'nombre' => 'México',
                'slug' => 'mexico',
                'codigo' => '+52',
                'timezone' => 'America/Mexico_City',
                'active_at' => now(),
            ]);
        }

        $panama = Pais::where('slug', 'panama')->first();

        if (!$panama) {
            $panama = Pais::create([
                'nombre' => 'Panamá',
                'slug' => 'panama',
                'codigo' => '+507',
                'timezone' => 'America/Panama',
                'active_at' => now(),
            ]);
        }

        $costa_rica = Pais::where('slug', 'costa-rica')->first();

        if (!$costa_rica) {
            $costa_rica = Pais::create([
                'nombre' => 'Costa Rica',
                'slug' => 'costa-rica',
                'codigo' => '+506',
                'timezone' => 'America/Costa_Rica',
                'active_at' => now(),
            ]);
        }

        $colombia = Pais::where('slug', 'colombia')->first();

        if (!$colombia) {
            $colombia = Pais::create([
                'nombre' => 'Colombia',
                'slug' => 'colombia',
                'codigo' => '+57',
                'timezone' => 'America/Bogota',
                'active_at' => now(),
            ]);
        }
    }
}
