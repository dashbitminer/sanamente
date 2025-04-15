<?php

namespace Database\Seeders;

use App\Models\OrigenReferencia;
use App\Models\OtraCondicion;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrigenReferenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Referencia por alguien del staff Glasswing',
            'Referencia por parte de una sede socia de Glasswing',
            'Contacto directo de un participante o miembro de la comunidad al equipo de Redes',
        ];

        foreach ($values as $value) {
            $model = OrigenReferencia::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
