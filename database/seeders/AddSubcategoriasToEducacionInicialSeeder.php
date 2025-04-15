<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PersonalInstitucionalGWDATA;
use App\Models\BeneficiariesSubtypesGWDATA;

class AddSubcategoriasToEducacionInicialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educacion = PersonalInstitucionalGWDATA::find(16);

        if ($educacion) {

            $subtipos = BeneficiariesSubtypesGWDATA::where('institutional_person_id', 14)
                ->get();

            foreach ($subtipos as $subtipo) {
                BeneficiariesSubtypesGWDATA::firstOrCreate([
                    'name' => $subtipo->name,
                    'institutional_person_id' => $educacion->id,
                    'active_at' => now(),
                    'created_at' => now(),
                ]);
            }
        }
    }
}
