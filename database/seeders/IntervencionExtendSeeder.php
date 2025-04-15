<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pais;
use App\Models\PerfilParticipante;
use App\Models\TipoIntervencion;
use App\Models\TipoOtraIntervencion;
use App\Models\CanceloProtocolo;
use App\Models\TipoPsicoeducacion;
use App\Models\Estrategia;
use App\Models\PausoProtocolo;
use App\Models\RazonIntervencion;
use App\Models\Proceso;

class IntervencionExtendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paises = Pais::whereNotIn('id', [1, 2, 3])
            ->pluck('id')
            ->toArray();

        PerfilParticipante::all()->each(function ($model) use ($paises) {
            $model->paises()->attach($paises);
        });

        TipoIntervencion::all()->each(function ($model) use ($paises) {
            $model->paises()->attach($paises);
        });

        TipoOtraIntervencion::all()->each(function ($model) use ($paises) {
            $model->paises()->attach($paises);
        });

        CanceloProtocolo::all()->each(function ($model) use ($paises) {
            $model->paises()->attach($paises);
        });

        TipoPsicoeducacion::all()->each(function ($model) use ($paises) {
            $model->paises()->attach($paises);
        });

        Estrategia::all()->each(function ($model) use ($paises) {
            $model->paises()->attach($paises);
        });

        PausoProtocolo::all()->each(function ($model) use ($paises) {
            $model->paises()->attach($paises);
        });

        RazonIntervencion::all()->each(function ($model) use ($paises) {
            $model->paises()->attach($paises);
        });

        Proceso::all()->each(function ($model) use ($paises) {
            $model->paises()->attach($paises);
        });

    }
}
