<?php

namespace Database\Seeders;

use App\Models\Intervencionista;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class IntervencionistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      Intervencionista::factory(30)->create();
    }
}
