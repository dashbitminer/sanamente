<?php

namespace Database\Seeders;

use App\Models\Estrategia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EstrategiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Retando pensamientos negativos',
            'Dejando ir los pensamientos',
            'Manejo de emociones',
            'Respiración profunda',
            'Ejercicio de relajación',
            'Atención al presente',
            'Cuerpos sanos, mentes sanas',
            'Manteniendo Redes de Apoyo Saludables',
            'Activación del comportamiento',
        ];

        foreach ($values as $value) {
            $model = Estrategia::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
