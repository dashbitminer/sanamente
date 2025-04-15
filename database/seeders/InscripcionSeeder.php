<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            PaisExtendedSeeder::class,
            InstitucionOrganizacionSeeder::class,
            CentroEducativoTipoSeeder::class,
            CentroEducativoCargoSeeder::class,
            CentroEducativoNivelSeeder::class,
            CentroEducativoCicloSeeder::class,
        ]);
    }
}
