<?php

namespace Database\Seeders;

use App\Models\OtraCondicion;
use App\Models\SeguimientoDetalle;
use App\Models\SeguimientoPaso;
use App\Models\TipoViolencia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeguimientoPasoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Redirigir a una nueva institución para que atienda la referencia',
            'Reagendar cita en la misma intitución',
            'En espera de asignación de cita por parte de la institución',
            'Cerrar caso'
        ];

        foreach ($values as $value) {
            $model = SeguimientoPaso::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
