<?php

namespace Database\Seeders;

use App\Models\NoAceptaReferenciaRazon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class NoAceptaReferenciaRazonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'La persona no posee interés por recibir el servicio',
            'La persona ya se encuentra recibiendo apoyo por otro medio',
            'La persona posee dificultad para transportarse y recibir el servicio',
            'La persona no responde llamadas o mensajes',
            'La persona no posee disponibilidad de tiempo para asistir al servicio',
            'La persona posee dificultades de salud o responsabilidades adicionales que imposibilitan acceder al servicio',
        ];

        foreach ($values as $value) {
            $model = NoAceptaReferenciaRazon::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
