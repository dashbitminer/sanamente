<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstitucionOrganizacion;

class InstitucionOrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Salud',
            'Educación',
            'Seguridad pública',
            'Organizaciones e instituciones',
        ];

        foreach ($values as $value) {
            $model = InstitucionOrganizacion::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            // $model->paises()->attach([1, 2, 3, 4, 5, 6, 7]);
        }
    }
}
