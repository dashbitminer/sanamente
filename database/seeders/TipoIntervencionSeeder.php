<?php

namespace Database\Seeders;

use App\Models\TipoIntervencion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoIntervencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Protocolo SanaMente',
            'Primeros Auxilios Psicológicos',
            'Referencia',
        ];

        foreach ($values as $value) {
            $model = TipoIntervencion::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
