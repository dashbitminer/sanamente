<?php

namespace Database\Seeders;

use App\Models\OtraCondicion;
use App\Models\SeguimientoDetalle;
use App\Models\TipoViolencia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeguimientoDetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'En esta sesión se le comunica a la persona el horario y fecha de su cita',
            'La institución aún no ha confirmado la cita de la persona referida',
            'La institución no acepto la referencia y por tanto no atendió a la persona',
            'La persona no asistió al servicio en la fecha y hora estipulada',
            'La institución cambió la cita de atención sin previo aviso',
            'La institución acepta la referencia pero hay lista de espera',
            'Los horarios que brinda la institución no se acoplan a la disponibilidad del participante',
            'La persona desiste del proceso de referencia',
            'Otro',
        ];

        foreach ($values as $value) {
            $model = SeguimientoDetalle::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
