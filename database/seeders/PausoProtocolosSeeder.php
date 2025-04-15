<?php

namespace Database\Seeders;

use App\Models\PausoProtocolo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PausoProtocolosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Interrupción por proceso de la sede',
            'La persona manifiesta no querer continuar',
            'La persona manifiesta no tener tiempo para completar el protocolo',
            'Otro',
        ];

        foreach ($values as $value) {
            $model = PausoProtocolo::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
