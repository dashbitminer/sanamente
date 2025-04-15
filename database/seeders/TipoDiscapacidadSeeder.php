<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RazonIntervencion;
use App\Models\TipoDiscapacidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoDiscapacidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Auditiva',
            'Cognitiva o Intelectual',
            'Fisica',
            'Visual',
        ];

        foreach ($values as $value) {
            $model = TipoDiscapacidad::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
