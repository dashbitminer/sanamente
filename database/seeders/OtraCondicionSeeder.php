<?php

namespace Database\Seeders;

use App\Models\OtraCondicion;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OtraCondicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'No sabe leer o escribir',
            'Habla otro idoma distinto al predominante en el país',
            'Necesidades básicas insatisfechas',
            'Condiciones médicas particulares',
            'Embarazo',
            'Otros',
        ];

        foreach ($values as $value) {
            $model = OtraCondicion::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
