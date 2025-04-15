<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoOtraIntervencion;
use App\Models\Pais;

class UpdateOtrasIntervencionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $model = TipoOtraIntervencion::find(1);

        $model->slug = null;
        $model->update([
            'nombre' => 'Brinda psicoeducación especifica sobre la situación y motiva a la búsqueda de ayuda',
        ]);

        $model = TipoOtraIntervencion::find(2);

        $model->slug = null;
        $model->update([
            'nombre' => 'Ayuda a conectar con servicios de atención y/o apoyo familiar',
        ]);

        $model = TipoOtraIntervencion::find(3);

        $model->slug = null;
        $model->update([
            'nombre' => 'Ayuda a conectar con servicios de atención y/o apoyo familiar',
        ]);


        // Crea 2 nuevos registros
        $paises = Pais::pluck('id')->toArray();

        $model = TipoOtraIntervencion::create([
            'nombre' => 'Aplica escucha activa y/o identificación de necesidades',
            'active_at' => now(),
        ]);

        $model->paises()->attach($paises);


        $model = TipoOtraIntervencion::create([
            'nombre' => 'Ayuda a restaurar la calma / aplica técnicas',
            'active_at' => now(),
        ]);

        $model->paises()->attach($paises);
    }
}
