<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferenciaParticipanteSeeder extends Seeder{

    public function run(): void
    {
        $this->call([
            TipoDiscapacidadSeeder::class,
            OtraCondicionSeeder::class,
            AccionInmediataSeeder::class,
            TipoViolenciaSeeder::class,
            MotivoReferenciaSeeder::class,
            TipoServicioSeeder::class,
            SaludMentalServicioSeeder::class,
            InstitucionReferenciaSeeder::class,
            UrgenciaReferenciaParametroSeeder::class,
            ModalidadConsentimientoSeeder::class,
            OrigenReferenciaSeeder::class,
            NoAceptaReferenciaRazonSeeder::class,
            SeguimientoDetalleSeeder::class,
            SeguimientoPasoSeeder::class
        ]);
    }
}
