<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array with municipalities of Alta Verapaz, Guatemala
        $altaVerapazMunicipalities = [
            ['name' => 'Cobán', 'departamento_id' => 1],
            ['name' => 'Santa Cruz Verapaz', 'departamento_id' => 1],
            ['name' => 'San Cristóbal Verapaz', 'departamento_id' => 1],
            ['name' => 'Tactic', 'departamento_id' => 1],
            ['name' => 'Tucurú', 'departamento_id' => 1],
            ['name' => 'Tamahú', 'departamento_id' => 1],
            ['name' => 'San Miguel Tucurú', 'departamento_id' => 1],
            ['name' => 'Panzós', 'departamento_id' => 1],
            ['name' => 'Senahú', 'departamento_id' => 1],
            ['name' => 'San Pedro Carchá', 'departamento_id' => 1],
            ['name' => 'Santa Catalina La Tinta', 'departamento_id' => 1],
            ['name' => 'Raxruhá', 'departamento_id' => 1],
            ['name' => 'Chisec', 'departamento_id' => 1],
            ['name' => 'Fray Bartolomé de las Casas', 'departamento_id' => 1],
            ['name' => 'Santa María Cahabón', 'departamento_id' => 1],
            ['name' => 'Lanquín', 'departamento_id' => 1],
            ['name' => 'Chahal', 'departamento_id' => 1],
            ['name' => 'Santa Cruz Verapaz', 'departamento_id' => 1],
        ];

        foreach ($altaVerapazMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Baja Verapaz, Guatemala
        $bajaVerapazMunicipalities = [
            ['name' => 'Salamá', 'departamento_id' => 2],
            ['name' => 'Cubulco', 'departamento_id' => 2],
            ['name' => 'Granados', 'departamento_id' => 2],
            ['name' => 'Purulhá', 'departamento_id' => 2],
            ['name' => 'Rabinal', 'departamento_id' => 2],
            ['name' => 'San Jerónimo', 'departamento_id' => 2],
            ['name' => 'San Miguel Chicaj', 'departamento_id' => 2],
            ['name' => 'Santa Cruz El Chol', 'departamento_id' => 2],
        ];

        foreach ($bajaVerapazMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Chimaltenango, Guatemala
        $chimaltenangoMunicipalities = [
            ['name' => 'Chimaltenango', 'departamento_id' => 3],
            ['name' => 'San José Poaquil', 'departamento_id' => 3],
            ['name' => 'San Martín Jilotepeque', 'departamento_id' => 3],
            ['name' => 'San Juan Comalapa', 'departamento_id' => 3],
            ['name' => 'Santa Apolonia', 'departamento_id' => 3],
            ['name' => 'Tecpán Guatemala', 'departamento_id' => 3],
            ['name' => 'Patzún', 'departamento_id' => 3],
            ['name' => 'Pochuta', 'departamento_id' => 3],
            ['name' => 'Patzicía', 'departamento_id' => 3],
            ['name' => 'Santa Cruz Balanyá', 'departamento_id' => 3],
            ['name' => 'Acatenango', 'departamento_id' => 3],
            ['name' => 'San Pedro Yepocapa', 'departamento_id' => 3],
            ['name' => 'San Andrés Itzapa', 'departamento_id' => 3],
            ['name' => 'Parramos', 'departamento_id' => 3],
            ['name' => 'Zaragoza', 'departamento_id' => 3],
            ['name' => 'El Tejar', 'departamento_id' => 3],
        ];

        foreach ($chimaltenangoMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Chiquimula, Guatemala
        $chiquimulaMunicipalities = [
            ['name' => 'Chiquimula', 'departamento_id' => 4],
            ['name' => 'Camotán', 'departamento_id' => 4],
            ['name' => 'Concepción Las Minas', 'departamento_id' => 4],
            ['name' => 'Esquipulas', 'departamento_id' => 4],
            ['name' => 'Ipala', 'departamento_id' => 4],
            ['name' => 'Jocotán', 'departamento_id' => 4],
            ['name' => 'Olopa', 'departamento_id' => 4],
            ['name' => 'Quezaltepeque', 'departamento_id' => 4],
            ['name' => 'San Jacinto', 'departamento_id' => 4],
            ['name' => 'San José La Arada', 'departamento_id' => 4],
        ];

        foreach ($chiquimulaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of El Progreso, Guatemala
        $elProgresoMunicipalities = [
            ['name' => 'Guastatoya', 'departamento_id' => 5],
            ['name' => 'Morazán', 'departamento_id' => 5],
            ['name' => 'San Agustín Acasaguastlán', 'departamento_id' => 5],
            ['name' => 'San Antonio La Paz', 'departamento_id' => 5],
            ['name' => 'San Cristóbal Acasaguastlán', 'departamento_id' => 5],
            ['name' => 'El Jícaro', 'departamento_id' => 5],
            ['name' => 'Sansare', 'departamento_id' => 5],
            ['name' => 'Sanarate', 'departamento_id' => 5],
        ];

        foreach ($elProgresoMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Escuintla, Guatemala
        $escuintlaMunicipalities = [
            ['name' => 'Escuintla', 'departamento_id' => 6],
            ['name' => 'Guanagazapa', 'departamento_id' => 6],
            ['name' => 'Iztapa', 'departamento_id' => 6],
            ['name' => 'La Democracia', 'departamento_id' => 6],
            ['name' => 'La Gomera', 'departamento_id' => 6],
            ['name' => 'Masagua', 'departamento_id' => 6],
            ['name' => 'Nueva Concepción', 'departamento_id' => 6],
            ['name' => 'Palín', 'departamento_id' => 6],
            ['name' => 'San José', 'departamento_id' => 6],
            ['name' => 'San Vicente Pacaya', 'departamento_id' => 6],
            ['name' => 'Santa Lucía Cotzumalguapa', 'departamento_id' => 6],
            ['name' => 'Siquinalá', 'departamento_id' => 6],
            ['name' => 'Tiquisate', 'departamento_id' => 6],
        ];

        foreach ($escuintlaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Guatemala, Guatemala
        $guatemalaMunicipalities = [
            ['name' => 'Guatemala City', 'departamento_id' => 7],
            ['name' => 'Santa Catarina Pinula', 'departamento_id' => 7],
            ['name' => 'San José Pinula', 'departamento_id' => 7],
            ['name' => 'San José del Golfo', 'departamento_id' => 7],
            ['name' => 'Palencia', 'departamento_id' => 7],
            ['name' => 'Chinautla', 'departamento_id' => 7],
            ['name' => 'San Pedro Ayampuc', 'departamento_id' => 7],
            ['name' => 'Mixco', 'departamento_id' => 7],
            ['name' => 'San Pedro Sacatepéquez', 'departamento_id' => 7],
            ['name' => 'San Juan Sacatepéquez', 'departamento_id' => 7],
            ['name' => 'San Raymundo', 'departamento_id' => 7],
            ['name' => 'Chuarrancho', 'departamento_id' => 7],
            ['name' => 'Fraijanes', 'departamento_id' => 7],
            ['name' => 'Amatitlán', 'departamento_id' => 7],
            ['name' => 'Villa Nueva', 'departamento_id' => 7],
            ['name' => 'Villa Canales', 'departamento_id' => 7],
            ['name' => 'Petapa', 'departamento_id' => 7],
        ];

        foreach ($guatemalaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Huehuetenango, Guatemala
        $huehuetenangoMunicipalities = [
            ['name' => 'Huehuetenango', 'departamento_id' => 8],
            ['name' => 'Chiantla', 'departamento_id' => 8],
            ['name' => 'Malacatancito', 'departamento_id' => 8],
            ['name' => 'Cuilco', 'departamento_id' => 8],
            ['name' => 'Nentón', 'departamento_id' => 8],
            ['name' => 'San Pedro Necta', 'departamento_id' => 8],
            ['name' => 'Jacaltenango', 'departamento_id' => 8],
            ['name' => 'Soloma', 'departamento_id' => 8],
            ['name' => 'San Ildefonso Ixtahuacán', 'departamento_id' => 8],
            ['name' => 'Santa Bárbara', 'departamento_id' => 8],
            ['name' => 'La Libertad', 'departamento_id' => 8],
            ['name' => 'La Democracia', 'departamento_id' => 8],
            ['name' => 'San Miguel Acatán', 'departamento_id' => 8],
            ['name' => 'San Rafael La Independencia', 'departamento_id' => 8],
            ['name' => 'Todos Santos Cuchumatán', 'departamento_id' => 8],
            ['name' => 'San Juan Atitán', 'departamento_id' => 8],
            ['name' => 'Santa Eulalia', 'departamento_id' => 8],
            ['name' => 'San Mateo Ixtatán', 'departamento_id' => 8],
            ['name' => 'Colotenango', 'departamento_id' => 8],
            ['name' => 'San Sebastián Huehuetenango', 'departamento_id' => 8],
            ['name' => 'Tectitán', 'departamento_id' => 8],
            ['name' => 'Concepción Huista', 'departamento_id' => 8],
            ['name' => 'San Juan Ixcoy', 'departamento_id' => 8],
            ['name' => 'San Antonio Huista', 'departamento_id' => 8],
            ['name' => 'San Sebastián Coatán', 'departamento_id' => 8],
            ['name' => 'Santa Cruz Barillas', 'departamento_id' => 8],
            ['name' => 'Aguacatán', 'departamento_id' => 8],
            ['name' => 'San Rafael Petzal', 'departamento_id' => 8],
            ['name' => 'San Gaspar Ixchil', 'departamento_id' => 8],
            ['name' => 'Santiago Chimaltenango', 'departamento_id' => 8],
            ['name' => 'Santa Ana Huista', 'departamento_id' => 8],
        ];

        foreach ($huehuetenangoMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Izabal, Guatemala
        $izabalMunicipalities = [
            ['name' => 'Puerto Barrios', 'departamento_id' => 9],
            ['name' => 'Livingston', 'departamento_id' => 9],
            ['name' => 'El Estor', 'departamento_id' => 9],
            ['name' => 'Morales', 'departamento_id' => 9],
            ['name' => 'Los Amates', 'departamento_id' => 9],
        ];

        foreach ($izabalMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Jalapa, Guatemala
        $jalapaMunicipalities = [
            ['name' => 'Jalapa', 'departamento_id' => 10],
            ['name' => 'San Pedro Pinula', 'departamento_id' => 10],
            ['name' => 'San Luis Jilotepeque', 'departamento_id' => 10],
            ['name' => 'San Manuel Chaparrón', 'departamento_id' => 10],
            ['name' => 'San Carlos Alzatate', 'departamento_id' => 10],
            ['name' => 'Monjas', 'departamento_id' => 10],
            ['name' => 'Mataquescuintla', 'departamento_id' => 10],
        ];

        foreach ($jalapaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Jutiapa, Guatemala
        $jutiapaMunicipalities = [
            ['name' => 'Jutiapa', 'departamento_id' => 11],
            ['name' => 'Agua Blanca', 'departamento_id' => 11],
            ['name' => 'Asunción Mita', 'departamento_id' => 11],
            ['name' => 'Atescatempa', 'departamento_id' => 11],
            ['name' => 'Comapa', 'departamento_id' => 11],
            ['name' => 'Conguaco', 'departamento_id' => 11],
            ['name' => 'El Adelanto', 'departamento_id' => 11],
            ['name' => 'El Progreso', 'departamento_id' => 11],
            ['name' => 'Jalpatagua', 'departamento_id' => 11],
            ['name' => 'Jeréz', 'departamento_id' => 11],
            ['name' => 'Moyuta', 'departamento_id' => 11],
            ['name' => 'Pasaco', 'departamento_id' => 11],
            ['name' => 'Quesada', 'departamento_id' => 11],
            ['name' => 'San José Acatempa', 'departamento_id' => 11],
            ['name' => 'Santa Catarina Mita', 'departamento_id' => 11],
            ['name' => 'Yupiltepeque', 'departamento_id' => 11],
            ['name' => 'Zapotitlán', 'departamento_id' => 11],
        ];

        foreach ($jutiapaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Petén, Guatemala
        $petenMunicipalities = [
            ['name' => 'Flores', 'departamento_id' => 12],
            ['name' => 'San Benito', 'departamento_id' => 12],
            ['name' => 'San Andrés', 'departamento_id' => 12],
            ['name' => 'La Libertad', 'departamento_id' => 12],
            ['name' => 'San Francisco', 'departamento_id' => 12],
            ['name' => 'Santa Ana', 'departamento_id' => 12],
            ['name' => 'Dolores', 'departamento_id' => 12],
            ['name' => 'San Luis', 'departamento_id' => 12],
            ['name' => 'Sayaxché', 'departamento_id' => 12],
            ['name' => 'Melchor de Mencos', 'departamento_id' => 12],
            ['name' => 'Poptún', 'departamento_id' => 12],
            ['name' => 'Las Cruces', 'departamento_id' => 12],
            ['name' => 'El Chal', 'departamento_id' => 12],
        ];

        foreach ($petenMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Quetzaltenango, Guatemala
        $quetzaltenangoMunicipalities = [
            ['name' => 'Quetzaltenango', 'departamento_id' => 13],
            ['name' => 'Salcajá', 'departamento_id' => 13],
            ['name' => 'Olintepeque', 'departamento_id' => 13],
            ['name' => 'San Carlos Sija', 'departamento_id' => 13],
            ['name' => 'Sibilia', 'departamento_id' => 13],
            ['name' => 'Cabricán', 'departamento_id' => 13],
            ['name' => 'Cajolá', 'departamento_id' => 13],
            ['name' => 'San Miguel Sigüilá', 'departamento_id' => 13],
            ['name' => 'Ostuncalco', 'departamento_id' => 13],
            ['name' => 'San Mateo', 'departamento_id' => 13],
            ['name' => 'Concepción Chiquirichapa', 'departamento_id' => 13],
            ['name' => 'San Martín Sacatepéquez', 'departamento_id' => 13],
            ['name' => 'Almolonga', 'departamento_id' => 13],
            ['name' => 'Cantel', 'departamento_id' => 13],
            ['name' => 'Huitán', 'departamento_id' => 13],
            ['name' => 'Zunil', 'departamento_id' => 13],
            ['name' => 'Colomba', 'departamento_id' => 13],
            ['name' => 'San Francisco La Unión', 'departamento_id' => 13],
            ['name' => 'El Palmar', 'departamento_id' => 13],
            ['name' => 'Coatepeque', 'departamento_id' => 13],
            ['name' => 'Génova', 'departamento_id' => 13],
            ['name' => 'Flores Costa Cuca', 'departamento_id' => 13],
            ['name' => 'La Esperanza', 'departamento_id' => 13],
            ['name' => 'Palestina de Los Altos', 'departamento_id' => 13],
        ];

        foreach ($quetzaltenangoMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Quiché, Guatemala
        $quicheMunicipalities = [
            ['name' => 'Santa Cruz del Quiché', 'departamento_id' => 14],
            ['name' => 'Chiché', 'departamento_id' => 14],
            ['name' => 'Chinique', 'departamento_id' => 14],
            ['name' => 'Zacualpa', 'departamento_id' => 14],
            ['name' => 'Chajul', 'departamento_id' => 14],
            ['name' => 'Chichicastenango', 'departamento_id' => 14],
            ['name' => 'Patzité', 'departamento_id' => 14],
            ['name' => 'San Antonio Ilotenango', 'departamento_id' => 14],
            ['name' => 'San Pedro Jocopilas', 'departamento_id' => 14],
            ['name' => 'Cunén', 'departamento_id' => 14],
            ['name' => 'San Juan Cotzal', 'departamento_id' => 14],
            ['name' => 'Joyabaj', 'departamento_id' => 14],
            ['name' => 'Nebaj', 'departamento_id' => 14],
            ['name' => 'San Andrés Sajcabajá', 'departamento_id' => 14],
            ['name' => 'Uspantán', 'departamento_id' => 14],
            ['name' => 'Sacapulas', 'departamento_id' => 14],
            ['name' => 'San Bartolomé Jocotenango', 'departamento_id' => 14],
            ['name' => 'Canillá', 'departamento_id' => 14],
            ['name' => 'Chicamán', 'departamento_id' => 14],
            ['name' => 'Ixcán', 'departamento_id' => 14],
            ['name' => 'Pachalum', 'departamento_id' => 14],
        ];

        foreach ($quicheMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Retalhuleu, Guatemala
        $retalhuleuMunicipalities = [
            ['name' => 'Retalhuleu', 'departamento_id' => 15],
            ['name' => 'Champerico', 'departamento_id' => 15],
            ['name' => 'El Asintal', 'departamento_id' => 15],
            ['name' => 'Nuevo San Carlos', 'departamento_id' => 15],
            ['name' => 'San Andrés Villa Seca', 'departamento_id' => 15],
            ['name' => 'San Felipe', 'departamento_id' => 15],
            ['name' => 'San Martín Zapotitlán', 'departamento_id' => 15],
            ['name' => 'San Sebastián', 'departamento_id' => 15],
            ['name' => 'Santa Cruz Muluá', 'departamento_id' => 15],
        ];

        foreach ($retalhuleuMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Sacatepéquez, Guatemala
        $sacatepequezMunicipalities = [
            ['name' => 'Antigua Guatemala', 'departamento_id' => 16],
            ['name' => 'Jocotenango', 'departamento_id' => 16],
            ['name' => 'Pastores', 'departamento_id' => 16],
            ['name' => 'Sumpango', 'departamento_id' => 16],
            ['name' => 'Santo Domingo Xenacoj', 'departamento_id' => 16],
            ['name' => 'Santiago Sacatepéquez', 'departamento_id' => 16],
            ['name' => 'San Bartolomé Milpas Altas', 'departamento_id' => 16],
            ['name' => 'San Lucas Sacatepéquez', 'departamento_id' => 16],
            ['name' => 'Santa Lucía Milpas Altas', 'departamento_id' => 16],
            ['name' => 'Magdalena Milpas Altas', 'departamento_id' => 16],
            ['name' => 'Santa María de Jesús', 'departamento_id' => 16],
            ['name' => 'Ciudad Vieja', 'departamento_id' => 16],
            ['name' => 'San Miguel Dueñas', 'departamento_id' => 16],
            ['name' => 'Alotenango', 'departamento_id' => 16],
            ['name' => 'San Antonio Aguas Calientes', 'departamento_id' => 16],
            ['name' => 'Santa Catarina Barahona', 'departamento_id' => 16],
        ];

        foreach ($sacatepequezMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of San Marcos, Guatemala
        $sanMarcosMunicipalities = [
            ['name' => 'San Marcos', 'departamento_id' => 17],
            ['name' => 'San Pedro Sacatepéquez', 'departamento_id' => 17],
            ['name' => 'San Antonio Sacatepéquez', 'departamento_id' => 17],
            ['name' => 'Comitancillo', 'departamento_id' => 17],
            ['name' => 'San Miguel Ixtahuacán', 'departamento_id' => 17],
            ['name' => 'Concepción Tutuapa', 'departamento_id' => 17],
            ['name' => 'Tacaná', 'departamento_id' => 17],
            ['name' => 'Sibinal', 'departamento_id' => 17],
            ['name' => 'Tajumulco', 'departamento_id' => 17],
            ['name' => 'Tejutla', 'departamento_id' => 17],
            ['name' => 'San Rafael Pie de la Cuesta', 'departamento_id' => 17],
            ['name' => 'Nuevo Progreso', 'departamento_id' => 17],
            ['name' => 'El Tumbador', 'departamento_id' => 17],
            ['name' => 'El Rodeo', 'departamento_id' => 17],
            ['name' => 'Malacatán', 'departamento_id' => 17],
            ['name' => 'Catarina', 'departamento_id' => 17],
            ['name' => 'Ayutla', 'departamento_id' => 17],
            ['name' => 'Ocos', 'departamento_id' => 17],
            ['name' => 'San Pablo', 'departamento_id' => 17],
            ['name' => 'El Quetzal', 'departamento_id' => 17],
            ['name' => 'La Reforma', 'departamento_id' => 17],
            ['name' => 'Pajapita', 'departamento_id' => 17],
            ['name' => 'Ixchiguán', 'departamento_id' => 17],
            ['name' => 'San José Ojetenam', 'departamento_id' => 17],
            ['name' => 'San Cristóbal Cucho', 'departamento_id' => 17],
            ['name' => 'Sipacapa', 'departamento_id' => 17],
            ['name' => 'Esquipulas Palo Gordo', 'departamento_id' => 17],
            ['name' => 'Río Blanco', 'departamento_id' => 17],
            ['name' => 'San Lorenzo', 'departamento_id' => 17],
        ];

        foreach ($sanMarcosMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Santa Rosa, Guatemala
        $santaRosaMunicipalities = [
            ['name' => 'Cuilapa', 'departamento_id' => 18],
            ['name' => 'Barberena', 'departamento_id' => 18],
            ['name' => 'Santa Rosa de Lima', 'departamento_id' => 18],
            ['name' => 'Casillas', 'departamento_id' => 18],
            ['name' => 'San Rafael Las Flores', 'departamento_id' => 18],
            ['name' => 'Oratorio', 'departamento_id' => 18],
            ['name' => 'San Juan Tecuaco', 'departamento_id' => 18],
            ['name' => 'Chiquimulilla', 'departamento_id' => 18],
            ['name' => 'Taxisco', 'departamento_id' => 18],
            ['name' => 'Santa María Ixhuatán', 'departamento_id' => 18],
            ['name' => 'Guazacapán', 'departamento_id' => 18],
            ['name' => 'Santa Cruz Naranjo', 'departamento_id' => 18],
            ['name' => 'Pueblo Nuevo Viñas', 'departamento_id' => 18],
            ['name' => 'Nueva Santa Rosa', 'departamento_id' => 18],
        ];

        foreach ($santaRosaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Sololá, Guatemala
        $sololaMunicipalities = [
            ['name' => 'Sololá', 'departamento_id' => 19],
            ['name' => 'San José Chacayá', 'departamento_id' => 19],
            ['name' => 'Santa María Visitación', 'departamento_id' => 19],
            ['name' => 'Santa Lucía Utatlán', 'departamento_id' => 19],
            ['name' => 'Nahualá', 'departamento_id' => 19],
            ['name' => 'Santa Catarina Ixtahuacán', 'departamento_id' => 19],
            ['name' => 'Santa Clara La Laguna', 'departamento_id' => 19],
            ['name' => 'Concepción', 'departamento_id' => 19],
            ['name' => 'San Andrés Semetabaj', 'departamento_id' => 19],
            ['name' => 'Panajachel', 'departamento_id' => 19],
            ['name' => 'Santa Catarina Palopó', 'departamento_id' => 19],
            ['name' => 'San Antonio Palopó', 'departamento_id' => 19],
            ['name' => 'San Lucas Tolimán', 'departamento_id' => 19],
            ['name' => 'Santa Cruz La Laguna', 'departamento_id' => 19],
            ['name' => 'San Pablo La Laguna', 'departamento_id' => 19],
            ['name' => 'San Marcos La Laguna', 'departamento_id' => 19],
            ['name' => 'San Juan La Laguna', 'departamento_id' => 19],
            ['name' => 'San Pedro La Laguna', 'departamento_id' => 19],
            ['name' => 'Santiago Atitlán', 'departamento_id' => 19],
        ];

        foreach ($sololaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Suchitepéquez, Guatemala
        $suchitepequezMunicipalities = [
            ['name' => 'Mazatenango', 'departamento_id' => 20],
            ['name' => 'Cuyotenango', 'departamento_id' => 20],
            ['name' => 'San Francisco Zapotitlán', 'departamento_id' => 20],
            ['name' => 'San Bernardino', 'departamento_id' => 20],
            ['name' => 'San José El Idolo', 'departamento_id' => 20],
            ['name' => 'Santo Domingo Suchitepéquez', 'departamento_id' => 20],
            ['name' => 'San Lorenzo', 'departamento_id' => 20],
            ['name' => 'Samayac', 'departamento_id' => 20],
            ['name' => 'San Pablo Jocopilas', 'departamento_id' => 20],
            ['name' => 'San Antonio Suchitepéquez', 'departamento_id' => 20],
            ['name' => 'San Miguel Panán', 'departamento_id' => 20],
            ['name' => 'San Gabriel', 'departamento_id' => 20],
            ['name' => 'Chicacao', 'departamento_id' => 20],
            ['name' => 'Patulul', 'departamento_id' => 20],
            ['name' => 'Santa Bárbara', 'departamento_id' => 20],
            ['name' => 'San Juan Bautista', 'departamento_id' => 20],
            ['name' => 'Santo Tomás La Unión', 'departamento_id' => 20],
            ['name' => 'Zunilito', 'departamento_id' => 20],
            ['name' => 'Pueblo Nuevo', 'departamento_id' => 20],
            ['name' => 'Río Bravo', 'departamento_id' => 20],
        ];

        foreach ($suchitepequezMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Totonicapán, Guatemala
        $totonicapanMunicipalities = [
            ['name' => 'Totonicapán', 'departamento_id' => 21],
            ['name' => 'San Cristóbal Totonicapán', 'departamento_id' => 21],
            ['name' => 'San Francisco El Alto', 'departamento_id' => 21],
            ['name' => 'San Andrés Xecul', 'departamento_id' => 21],
            ['name' => 'Momostenango', 'departamento_id' => 21],
            ['name' => 'Santa María Chiquimula', 'departamento_id' => 21],
            ['name' => 'Santa Lucía La Reforma', 'departamento_id' => 21],
            ['name' => 'San Bartolo', 'departamento_id' => 21],
        ];

        foreach ($totonicapanMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Array with municipalities of Zacapa, Guatemala
        $zacapaMunicipalities = [
            ['name' => 'Zacapa', 'departamento_id' => 22],
            ['name' => 'Estanzuela', 'departamento_id' => 22],
            ['name' => 'Río Hondo', 'departamento_id' => 22],
            ['name' => 'Gualán', 'departamento_id' => 22],
            ['name' => 'Teculután', 'departamento_id' => 22],
            ['name' => 'Usumatlán', 'departamento_id' => 22],
            ['name' => 'Cabañas', 'departamento_id' => 22],
            ['name' => 'San Diego', 'departamento_id' => 22],
            ['name' => 'La Unión', 'departamento_id' => 22],
            ['name' => 'Huité', 'departamento_id' => 22],
            ['name' => 'San Jorge', 'departamento_id' => 22],
        ];

        foreach ($zacapaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // El Salvador

        //Municipios de Ahuachapán
        $ahuachapanMunicipalities = [
            ['name' => 'Ahuachapán', 'departamento_id' => 23],
            ['name' => 'Apaneca', 'departamento_id' => 23],
            ['name' => 'Atiquizaya', 'departamento_id' => 23],
            ['name' => 'Concepción de Ataco', 'departamento_id' => 23],
            ['name' => 'El Refugio', 'departamento_id' => 23],
            ['name' => 'Guaymango', 'departamento_id' => 23],
            ['name' => 'Jujutla', 'departamento_id' => 23],
            ['name' => 'San Francisco Menéndez', 'departamento_id' => 23],
            ['name' => 'San Lorenzo', 'departamento_id' => 23],
            ['name' => 'San Pedro Puxtla', 'departamento_id' => 23],
            ['name' => 'Tacuba', 'departamento_id' => 23],
            ['name' => 'Turín', 'departamento_id' => 23],
        ];

        foreach ($ahuachapanMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Cabañas
        $cabanasMunicipalities = [
            ['name' => 'Cinquera', 'departamento_id' => 24],
            ['name' => 'Dolores', 'departamento_id' => 24],
            ['name' => 'Guacotecti', 'departamento_id' => 24],
            ['name' => 'Ilobasco', 'departamento_id' => 24],
            ['name' => 'Jutiapa', 'departamento_id' => 24],
            ['name' => 'San Isidro', 'departamento_id' => 24],
            ['name' => 'Sensuntepeque', 'departamento_id' => 24],
            ['name' => 'Tejutepeque', 'departamento_id' => 24],
            ['name' => 'Victoria', 'departamento_id' => 24],
        ];

        foreach ($cabanasMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Chalatenango
        $chalatenangoMunicipalities = [
            ['name' => 'Agua Caliente', 'departamento_id' => 25],
            ['name' => 'Arcatao', 'departamento_id' => 25],
            ['name' => 'Azacualpa', 'departamento_id' => 25],
            ['name' => 'Cancasque', 'departamento_id' => 25],
            ['name' => 'Chalatenango', 'departamento_id' => 25],
            ['name' => 'Citalá', 'departamento_id' => 25],
            ['name' => 'Comalapa', 'departamento_id' => 25],
            ['name' => 'Concepción Quezaltepeque', 'departamento_id' => 25],
            ['name' => 'Dulce Nombre de María', 'departamento_id' => 25],
            ['name' => 'El Carrizal', 'departamento_id' => 25],
            ['name' => 'El Paraíso', 'departamento_id' => 25],
            ['name' => 'La Laguna', 'departamento_id' => 25],
            ['name' => 'La Palma', 'departamento_id' => 25],
            ['name' => 'La Reina', 'departamento_id' => 25],
            ['name' => 'Las Vueltas', 'departamento_id' => 25],
            ['name' => 'Nombre de Jesús', 'departamento_id' => 25],
            ['name' => 'Nueva Concepción', 'departamento_id' => 25],
            ['name' => 'Nueva Trinidad', 'departamento_id' => 25],
            ['name' => 'Ojos de Agua', 'departamento_id' => 25],
            ['name' => 'Potonico', 'departamento_id' => 25],
            ['name' => 'San Antonio de la Cruz', 'departamento_id' => 25],
            ['name' => 'San Antonio Los Ranchos', 'departamento_id' => 25],
            ['name' => 'San Fernando', 'departamento_id' => 25],
            ['name' => 'San Francisco Lempa', 'departamento_id' => 25],
            ['name' => 'San Francisco Morazán', 'departamento_id' => 25],
            ['name' => 'San Ignacio', 'departamento_id' => 25],
            ['name' => 'San Isidro Labrador', 'departamento_id' => 25],
            ['name' => 'San Luis del Carmen', 'departamento_id' => 25],
            ['name' => 'San Miguel de Mercedes', 'departamento_id' => 25],
            ['name' => 'San Rafael', 'departamento_id' => 25],
            ['name' => 'Santa Rita', 'departamento_id' => 25],
            ['name' => 'Tejutla', 'departamento_id' => 25],
        ];

        foreach ($chalatenangoMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Cuscatlán
        $cuscatlanMunicipalities = [
            ['name' => 'Candelaria', 'departamento_id' => 26],
            ['name' => 'Cojutepeque', 'departamento_id' => 26],
            ['name' => 'El Carmen', 'departamento_id' => 26],
            ['name' => 'El Rosario', 'departamento_id' => 26],
            ['name' => 'Monte San Juan', 'departamento_id' => 26],
            ['name' => 'Oratorio de Concepción', 'departamento_id' => 26],
            ['name' => 'San Bartolomé Perulapía', 'departamento_id' => 26],
            ['name' => 'San Cristóbal', 'departamento_id' => 26],
            ['name' => 'San José Guayabal', 'departamento_id' => 26],
            ['name' => 'San Pedro Perulapán', 'departamento_id' => 26],
            ['name' => 'San Rafael Cedros', 'departamento_id' => 26],
            ['name' => 'Santa Cruz Analquito', 'departamento_id' => 26],
            ['name' => 'Santa Cruz Michapa', 'departamento_id' => 26],
            ['name' => 'Suchitoto', 'departamento_id' => 26],
            ['name' => 'Tenancingo', 'departamento_id' => 26],
        ];

        foreach ($cuscatlanMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de La Libertad
        $laLibertadMunicipalities = [
            ['name' => 'Antiguo Cuscatlán', 'departamento_id' => 27],
            ['name' => 'Chiltiupán', 'departamento_id' => 27],
            ['name' => 'Ciudad Arce', 'departamento_id' => 27],
            ['name' => 'Colón', 'departamento_id' => 27],
            ['name' => 'Comasagua', 'departamento_id' => 27],
            ['name' => 'Huizúcar', 'departamento_id' => 27],
            ['name' => 'Jayaque', 'departamento_id' => 27],
            ['name' => 'Jicalapa', 'departamento_id' => 27],
            ['name' => 'La Libertad', 'departamento_id' => 27],
            ['name' => 'Nuevo Cuscatlán', 'departamento_id' => 27],
            ['name' => 'San Juan Opico', 'departamento_id' => 27],
            ['name' => 'Quezaltepeque', 'departamento_id' => 27],
            ['name' => 'Sacacoyo', 'departamento_id' => 27],
            ['name' => 'San José Villanueva', 'departamento_id' => 27],
            ['name' => 'San Matías', 'departamento_id' => 27],
            ['name' => 'San Pablo Tacachico', 'departamento_id' => 27],
            ['name' => 'Talnique', 'departamento_id' => 27],
            ['name' => 'Tamanique', 'departamento_id' => 27],
            ['name' => 'Teotepeque', 'departamento_id' => 27],
            ['name' => 'Tepecoyo', 'departamento_id' => 27],
            ['name' => 'Zaragoza', 'departamento_id' => 27],
        ];

        foreach ($laLibertadMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de La Paz
        $laPazMunicipalities = [
            ['name' => 'Cuyultitán', 'departamento_id' => 28],
            ['name' => 'El Rosario', 'departamento_id' => 28],
            ['name' => 'Jerusalén', 'departamento_id' => 28],
            ['name' => 'Mercedes La Ceiba', 'departamento_id' => 28],
            ['name' => 'Olocuilta', 'departamento_id' => 28],
            ['name' => 'Paraíso de Osorio', 'departamento_id' => 28],
            ['name' => 'San Antonio Masahuat', 'departamento_id' => 28],
            ['name' => 'San Emigdio', 'departamento_id' => 28],
            ['name' => 'San Francisco Chinameca', 'departamento_id' => 28],
            ['name' => 'San Juan Nonualco', 'departamento_id' => 28],
            ['name' => 'San Juan Talpa', 'departamento_id' => 28],
            ['name' => 'San Juan Tepezontes', 'departamento_id' => 28],
            ['name' => 'San Luis La Herradura', 'departamento_id' => 28],
            ['name' => 'San Luis Talpa', 'departamento_id' => 28],
            ['name' => 'San Miguel Tepezontes', 'departamento_id' => 28],
            ['name' => 'San Pedro Masahuat', 'departamento_id' => 28],
            ['name' => 'San Pedro Nonualco', 'departamento_id' => 28],
            ['name' => 'San Rafael Obrajuelo', 'departamento_id' => 28],
            ['name' => 'Santa María Ostuma', 'departamento_id' => 28],
            ['name' => 'Santiago Nonualco', 'departamento_id' => 28],
            ['name' => 'Tapalhuaca', 'departamento_id' => 28],
            ['name' => 'Zacatecoluca', 'departamento_id' => 28],
        ];

        foreach ($laPazMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de La Unión
        $laUnionMunicipalities = [
            ['name' => 'Anamorós', 'departamento_id' => 29],
            ['name' => 'Bolívar', 'departamento_id' => 29],
            ['name' => 'Concepción de Oriente', 'departamento_id' => 29],
            ['name' => 'Conchagua', 'departamento_id' => 29],
            ['name' => 'El Carmen', 'departamento_id' => 29],
            ['name' => 'El Sauce', 'departamento_id' => 29],
            ['name' => 'Intipucá', 'departamento_id' => 29],
            ['name' => 'La Unión', 'departamento_id' => 29],
            ['name' => 'Lislique', 'departamento_id' => 29],
            ['name' => 'Meanguera del Golfo', 'departamento_id' => 29],
            ['name' => 'Nueva Esparta', 'departamento_id' => 29],
            ['name' => 'Pasaquina', 'departamento_id' => 29],
            ['name' => 'Polorós', 'departamento_id' => 29],
            ['name' => 'San Alejo', 'departamento_id' => 29],
            ['name' => 'San José', 'departamento_id' => 29],
            ['name' => 'Santa Rosa de Lima', 'departamento_id' => 29],
            ['name' => 'Yayantique', 'departamento_id' => 29],
            ['name' => 'Yucuaiquín', 'departamento_id' => 29],
        ];

        foreach ($laUnionMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Morazán
        $morazanMunicipalities = [
            ['name' => 'Arambala', 'departamento_id' => 30],
            ['name' => 'Cacaopera', 'departamento_id' => 30],
            ['name' => 'Chilanga', 'departamento_id' => 30],
            ['name' => 'Corinto', 'departamento_id' => 30],
            ['name' => 'Delicias de Concepción', 'departamento_id' => 30],
            ['name' => 'El Divisadero', 'departamento_id' => 30],
            ['name' => 'El Rosario', 'departamento_id' => 30],
            ['name' => 'Gualococti', 'departamento_id' => 30],
            ['name' => 'Guatajiagua', 'departamento_id' => 30],
            ['name' => 'Joateca', 'departamento_id' => 30],
            ['name' => 'Jocoaitique', 'departamento_id' => 30],
            ['name' => 'Jocoro', 'departamento_id' => 30],
            ['name' => 'Lolotiquillo', 'departamento_id' => 30],
            ['name' => 'Meanguera', 'departamento_id' => 30],
            ['name' => 'Osicala', 'departamento_id' => 30],
            ['name' => 'Perquín', 'departamento_id' => 30],
            ['name' => 'San Carlos', 'departamento_id' => 30],
            ['name' => 'San Fernando', 'departamento_id' => 30],
            ['name' => 'San Francisco Gotera', 'departamento_id' => 30],
            ['name' => 'San Isidro', 'departamento_id' => 30],
            ['name' => 'San Simón', 'departamento_id' => 30],
            ['name' => 'Sensembra', 'departamento_id' => 30],
            ['name' => 'Sociedad', 'departamento_id' => 30],
            ['name' => 'Torola', 'departamento_id' => 30],
            ['name' => 'Yamabal', 'departamento_id' => 30],
            ['name' => 'Yoloaiquín', 'departamento_id' => 30],
        ];

        foreach ($morazanMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de San Miguel

        $sanMiguelMunicipalities = [
            ['name' => 'Carolina', 'departamento_id' => 31],
            ['name' => 'Chapeltique', 'departamento_id' => 31],
            ['name' => 'Chinameca', 'departamento_id' => 31],
            ['name' => 'Chirilagua', 'departamento_id' => 31],
            ['name' => 'Ciudad Barrios', 'departamento_id' => 31],
            ['name' => 'Comacarán', 'departamento_id' => 31],
            ['name' => 'El Tránsito', 'departamento_id' => 31],
            ['name' => 'Lolotique', 'departamento_id' => 31],
            ['name' => 'Moncagua', 'departamento_id' => 31],
            ['name' => 'Nueva Guadalupe', 'departamento_id' => 31],
            ['name' => 'Nuevo Edén de San Juan', 'departamento_id' => 31],
            ['name' => 'Quelepa', 'departamento_id' => 31],
            ['name' => 'San Antonio', 'departamento_id' => 31],
            ['name' => 'San Gerardo', 'departamento_id' => 31],
            ['name' => 'San Jorge', 'departamento_id' => 31],
            ['name' => 'San Luis de la Reina', 'departamento_id' => 31],
            ['name' => 'San Miguel', 'departamento_id' => 31],
            ['name' => 'San Rafael Oriente', 'departamento_id' => 31],
            ['name' => 'Sesori', 'departamento_id' => 31],
            ['name' => 'Uluazapa', 'departamento_id' => 31],
        ];

        foreach ($sanMiguelMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de San Salvador

        $sanSalvadorMunicipalities = [
            ['name' => 'Aguilares', 'departamento_id' => 32],
            ['name' => 'Apopa', 'departamento_id' => 32],
            ['name' => 'Ayutuxtepeque', 'departamento_id' => 32],
            ['name' => 'Cuscatancingo', 'departamento_id' => 32],
            ['name' => 'Delgado', 'departamento_id' => 32],
            ['name' => 'El Paisnal', 'departamento_id' => 32],
            ['name' => 'Guazapa', 'departamento_id' => 32],
            ['name' => 'Ilopango', 'departamento_id' => 32],
            ['name' => 'Mejicanos', 'departamento_id' => 32],
            ['name' => 'Nejapa', 'departamento_id' => 32],
            ['name' => 'Panchimalco', 'departamento_id' => 32],
            ['name' => 'Rosario de Mora', 'departamento_id' => 32],
            ['name' => 'San Marcos', 'departamento_id' => 32],
            ['name' => 'San Martín', 'departamento_id' => 32],
            ['name' => 'San Salvador', 'departamento_id' => 32],
            ['name' => 'Santiago Texacuangos', 'departamento_id' => 32],
            ['name' => 'Santo Tomás', 'departamento_id' => 32],
            ['name' => 'Soyapango', 'departamento_id' => 32],
            ['name' => 'Tonacatepeque', 'departamento_id' => 32],
        ];

        foreach ($sanSalvadorMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Santa Ana

        $santaAnaMunicipalities = [
            ['name' => 'Candelaria de la Frontera', 'departamento_id' => 33],
            ['name' => 'Chalchuapa', 'departamento_id' => 33],
            ['name' => 'Coatepeque', 'departamento_id' => 33],
            ['name' => 'El Congo', 'departamento_id' => 33],
            ['name' => 'El Porvenir', 'departamento_id' => 33],
            ['name' => 'Masahuat', 'departamento_id' => 33],
            ['name' => 'Metapán', 'departamento_id' => 33],
            ['name' => 'San Antonio Pajonal', 'departamento_id' => 33],
            ['name' => 'San Sebastián Salitrillo', 'departamento_id' => 33],
            ['name' => 'Santa Ana', 'departamento_id' => 33],
            ['name' => 'Santa Rosa Guachipilín', 'departamento_id' => 33],
            ['name' => 'Santiago de la Frontera', 'departamento_id' => 33],
            ['name' => 'Texistepeque', 'departamento_id' => 33],
        ];

        foreach ($santaAnaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de San Vicente

        $sanVicenteMunicipalities = [
            ['name' => 'Apastepeque', 'departamento_id' => 34],
            ['name' => 'Guadalupe', 'departamento_id' => 34],
            ['name' => 'San Cayetano Istepeque', 'departamento_id' => 34],
            ['name' => 'San Esteban Catarina', 'departamento_id' => 34],
            ['name' => 'San Ildefonso', 'departamento_id' => 34],
            ['name' => 'San Lorenzo', 'departamento_id' => 34],
            ['name' => 'San Sebastián', 'departamento_id' => 34],
            ['name' => 'San Vicente', 'departamento_id' => 34],
            ['name' => 'Santa Clara', 'departamento_id' => 34],
            ['name' => 'Santo Domingo', 'departamento_id' => 34],
            ['name' => 'Tecoluca', 'departamento_id' => 34],
            ['name' => 'Tepetitán', 'departamento_id' => 34],
            ['name' => 'Verapaz', 'departamento_id' => 34],
        ];

        foreach ($sanVicenteMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Sonsonate

        $sonsonateMunicipalities = [
            ['name' => 'Acajutla', 'departamento_id' => 35],
            ['name' => 'Armenia', 'departamento_id' => 35],
            ['name' => 'Caluco', 'departamento_id' => 35],
            ['name' => 'Cuisnahuat', 'departamento_id' => 35],
            ['name' => 'Izalco', 'departamento_id' => 35],
            ['name' => 'Juayúa', 'departamento_id' => 35],
            ['name' => 'Nahuizalco', 'departamento_id' => 35],
            ['name' => 'Nahulingo', 'departamento_id' => 35],
            ['name' => 'Salcoatitán', 'departamento_id' => 35],
            ['name' => 'San Antonio del Monte', 'departamento_id' => 35],
            ['name' => 'San Julián', 'departamento_id' => 35],
            ['name' => 'Santa Catarina Masahuat', 'departamento_id' => 35],
            ['name' => 'Santa Isabel Ishuatán', 'departamento_id' => 35],
            ['name' => 'Santo Domingo de Guzmán', 'departamento_id' => 35],
            ['name' => 'Sonsonate', 'departamento_id' => 35],
            ['name' => 'Sonzacate', 'departamento_id' => 35],
        ];

        foreach ($sonsonateMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Usulután

        $usulutanMunicipalities = [
            ['name' => 'Alegría', 'departamento_id' => 36],
            ['name' => 'Berlín', 'departamento_id' => 36],
            ['name' => 'California', 'departamento_id' => 36],
            ['name' => 'Concepción Batres', 'departamento_id' => 36],
            ['name' => 'El Triunfo', 'departamento_id' => 36],
            ['name' => 'Ereguayquín', 'departamento_id' => 36],
            ['name' => 'Estanzuelas', 'departamento_id' => 36],
            ['name' => 'Jiquilisco', 'departamento_id' => 36],
            ['name' => 'Jucuapa', 'departamento_id' => 36],
            ['name' => 'Jucuarán', 'departamento_id' => 36],
            ['name' => 'Mercedes Umaña', 'departamento_id' => 36],
            ['name' => 'Nueva Granada', 'departamento_id' => 36],
            ['name' => 'Ozatlán', 'departamento_id' => 36],
            ['name' => 'Puerto El Triunfo', 'departamento_id' => 36],
            ['name' => 'San Agustín', 'departamento_id' => 36],
            ['name' => 'San Buenaventura', 'departamento_id' => 36],
            ['name' => 'San Dionisio', 'departamento_id' => 36],
            ['name' => 'San Francisco Javier', 'departamento_id' => 36],
            ['name' => 'Santa Elena', 'departamento_id' => 36],
            ['name' => 'Santa María', 'departamento_id' => 36],
            ['name' => 'Santiago de María', 'departamento_id' => 36],
            ['name' => 'Tecapán', 'departamento_id' => 36],
            ['name' => 'Usulután', 'departamento_id' => 36],
        ];

        foreach ($usulutanMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        // Honduras

        //Municipios de Atlántida
        $atlantidaMunicipalities = [
            ['name' => 'La Ceiba', 'departamento_id' => 37],
            ['name' => 'El Porvenir', 'departamento_id' => 37],
            ['name' => 'Esparta', 'departamento_id' => 37],
            ['name' => 'Jutiapa', 'departamento_id' => 37],
            ['name' => 'La Masica', 'departamento_id' => 37],
            ['name' => 'San Francisco', 'departamento_id' => 37],
            ['name' => 'Tela', 'departamento_id' => 37],
            ['name' => 'Arizona', 'departamento_id' => 37],
            ['name' => 'La Ceibita', 'departamento_id' => 37],
        ];

        foreach ($atlantidaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Choluteca
        $cholutecaMunicipalities = [
            ['name' => 'Apacilagua', 'departamento_id' => 38],
            ['name' => 'Choluteca', 'departamento_id' => 38],
            ['name' => 'Concepción de María', 'departamento_id' => 38],
            ['name' => 'Duyure', 'departamento_id' => 38],
            ['name' => 'El Corpus', 'departamento_id' => 38],
            ['name' => 'El Triunfo', 'departamento_id' => 38],
            ['name' => 'Marcovia', 'departamento_id' => 38],
            ['name' => 'Morolica', 'departamento_id' => 38],
            ['name' => 'Namasigüe', 'departamento_id' => 38],
            ['name' => 'Orocuina', 'departamento_id' => 38],
            ['name' => 'Pespire', 'departamento_id' => 38],
            ['name' => 'San Antonio de Flores', 'departamento_id' => 38],
            ['name' => 'San Isidro', 'departamento_id' => 38],
            ['name' => 'San José', 'departamento_id' => 38],
            ['name' => 'San Marcos de Colón', 'departamento_id' => 38],
            ['name' => 'Santa Ana de Yusguare', 'departamento_id' => 38],
        ];

        foreach ($cholutecaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Colón

        $colonMunicipalities = [
            ['name' => 'Balfate', 'departamento_id' => 39],
            ['name' => 'Bonito Oriental', 'departamento_id' => 39],
            ['name' => 'Iriona', 'departamento_id' => 39],
            ['name' => 'Limón', 'departamento_id' => 39],
            ['name' => 'Sabá', 'departamento_id' => 39],
            ['name' => 'Santa Fe', 'departamento_id' => 39],
            ['name' => 'Santa Rosa de Aguán', 'departamento_id' => 39],
            ['name' => 'Sonaguera', 'departamento_id' => 39],
            ['name' => 'Tocoa', 'departamento_id' => 39],
            ['name' => 'Trujillo', 'departamento_id' => 39],
        ];

        foreach ($colonMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Comayagua

        $comayaguaMunicipalities = [
            ['name' => 'Ajuterique', 'departamento_id' => 40],
            ['name' => 'Comayagua', 'departamento_id' => 40],
            ['name' => 'El Rosario', 'departamento_id' => 40],
            ['name' => 'Esquías', 'departamento_id' => 40],
            ['name' => 'Humuya', 'departamento_id' => 40],
            ['name' => 'La Libertad', 'departamento_id' => 40],
            ['name' => 'Lamaní', 'departamento_id' => 40],
            ['name' => 'La Trinidad', 'departamento_id' => 40],
            ['name' => 'Lejamaní', 'departamento_id' => 40],
            ['name' => 'Meámbar', 'departamento_id' => 40],
            ['name' => 'Minas de Oro', 'departamento_id' => 40],
            ['name' => 'Ojos de Agua', 'departamento_id' => 40],
            ['name' => 'San Jerónimo', 'departamento_id' => 40],
            ['name' => 'San José de Comayagua', 'departamento_id' => 40],
            ['name' => 'San José del Potrero', 'departamento_id' => 40],
            ['name' => 'San Luis', 'departamento_id' => 40],
            ['name' => 'San Sebastián', 'departamento_id' => 40],
            ['name' => 'Siguatepeque', 'departamento_id' => 40],
            ['name' => 'Taulabé', 'departamento_id' => 40],
            ['name' => 'Villa de San Antonio', 'departamento_id' => 40],
            ['name' => 'Las Lajas', 'departamento_id' => 40],
        ];

        foreach ($comayaguaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Copán

        $copanMunicipalities = [
            ['name' => 'Cabañas', 'departamento_id' => 41],
            ['name' => 'Concepción', 'departamento_id' => 41],
            ['name' => 'Copán Ruinas', 'departamento_id' => 41],
            ['name' => 'Corquín', 'departamento_id' => 41],
            ['name' => 'Cucuyagua', 'departamento_id' => 41],
            ['name' => 'Dolores', 'departamento_id' => 41],
            ['name' => 'Dulce Nombre', 'departamento_id' => 41],
            ['name' => 'El Paraíso', 'departamento_id' => 41],
            ['name' => 'Florida', 'departamento_id' => 41],
            ['name' => 'La Jigua', 'departamento_id' => 41],
            ['name' => 'La Unión', 'departamento_id' => 41],
            ['name' => 'Nueva Arcadia', 'departamento_id' => 41],
            ['name' => 'San Agustín', 'departamento_id' => 41],
            ['name' => 'San Antonio', 'departamento_id' => 41],
            ['name' => 'San Jerónimo', 'departamento_id' => 41],
            ['name' => 'San José', 'departamento_id' => 41],
            ['name' => 'San Juan de Opoa', 'departamento_id' => 41],
            ['name' => 'San Nicolás', 'departamento_id' => 41],
            ['name' => 'San Pedro', 'departamento_id' => 41],
            ['name' => 'Santa Rita', 'departamento_id' => 41],
            ['name' => 'Trinidad de Copán', 'departamento_id' => 41],
            ['name' => 'Veracruz', 'departamento_id' => 41],
        ];

        foreach ($copanMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Cortés

        $cortesMunicipalities = [
            ['name' => 'Choloma', 'departamento_id' => 42],
            ['name' => 'Omoa', 'departamento_id' => 42],
            ['name' => 'Pimienta', 'departamento_id' => 42],
            ['name' => 'Potrerillos', 'departamento_id' => 42],
            ['name' => 'Puerto Cortés', 'departamento_id' => 42],
            ['name' => 'San Antonio de Cortés', 'departamento_id' => 42],
            ['name' => 'San Francisco de Yojoa', 'departamento_id' => 42],
            ['name' => 'San Manuel', 'departamento_id' => 42],
            ['name' => 'San Pedro Sula', 'departamento_id' => 42],
            ['name' => 'Santa Cruz de Yojoa', 'departamento_id' => 42],
            ['name' => 'Villanueva', 'departamento_id' => 42],
            ['name' => 'La Lima', 'departamento_id' => 42],
        ];

        foreach ($cortesMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de El Paraíso

        $elParaisoMunicipalities = [
            ['name' => 'Alauca', 'departamento_id' => 43],
            ['name' => 'Danlí', 'departamento_id' => 43],
            ['name' => 'El Paraíso', 'departamento_id' => 43],
            ['name' => 'Güinope', 'departamento_id' => 43],
            ['name' => 'Jacaleapa', 'departamento_id' => 43],
            ['name' => 'Liure', 'departamento_id' => 43],
            ['name' => 'Morocelí', 'departamento_id' => 43],
            ['name' => 'Oropolí', 'departamento_id' => 43],
            ['name' => 'Potrerillos', 'departamento_id' => 43],
            ['name' => 'San Antonio de Flores', 'departamento_id' => 43],
            ['name' => 'San Lucas', 'departamento_id' => 43],
            ['name' => 'San Matías', 'departamento_id' => 43],
            ['name' => 'Soledad', 'departamento_id' => 43],
            ['name' => 'Teupasenti', 'departamento_id' => 43],
            ['name' => 'Texiguat', 'departamento_id' => 43],
            ['name' => 'Vado Ancho', 'departamento_id' => 43],
            ['name' => 'Yauyupe', 'departamento_id' => 43],
            ['name' => 'Yuscarán', 'departamento_id' => 43],
        ];

        foreach ($elParaisoMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Francisco Morazán

        $franciscoMorazanMunicipalities = [
            ['name' => 'Alubarén', 'departamento_id' => 44],
            ['name' => 'Cedros', 'departamento_id' => 44],
            ['name' => 'Curarén', 'departamento_id' => 44],
            ['name' => 'El Porvenir', 'departamento_id' => 44],
            ['name' => 'Guaimaca', 'departamento_id' => 44],
            ['name' => 'La Libertad', 'departamento_id' => 44],
            ['name' => 'La Venta', 'departamento_id' => 44],
            ['name' => 'Lepaterique', 'departamento_id' => 44],
            ['name' => 'Maraita', 'departamento_id' => 44],
            ['name' => 'Marale', 'departamento_id' => 44],
            ['name' => 'Nueva Armenia', 'departamento_id' => 44],
            ['name' => 'Ojojona', 'departamento_id' => 44],
            ['name' => 'Orica', 'departamento_id' => 44],
            ['name' => 'Reitoca', 'departamento_id' => 44],
            ['name' => 'Sabanagrande', 'departamento_id' => 44],
            ['name' => 'San Antonio de Oriente', 'departamento_id' => 44],
            ['name' => 'San Buenaventura', 'departamento_id' => 44],
            ['name' => 'San Ignacio', 'departamento_id' => 44],
            ['name' => 'San Juan de Flores', 'departamento_id' => 44],
            ['name' => 'San Miguelito', 'departamento_id' => 44],
            ['name' => 'Santa Ana', 'departamento_id' => 44],
            ['name' => 'Santa Lucía', 'departamento_id' => 44],
            ['name' => 'Talanga', 'departamento_id' => 44],
            ['name' => 'Tatumbla', 'departamento_id' => 44],
            ['name' => 'Tegucigalpa', 'departamento_id' => 44],
            ['name' => 'Valle de Ángeles', 'departamento_id' => 44],
            ['name' => 'Villa de San Francisco', 'departamento_id' => 44],
            ['name' => 'Vallecillo', 'departamento_id' => 44],
        ];

        foreach ($franciscoMorazanMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Gracias a Dios

        $graciasADiosMunicipalities = [
            ['name' => 'Ahuas', 'departamento_id' => 45],
            ['name' => 'Brus Laguna', 'departamento_id' => 45],
            ['name' => 'Juan Francisco Bulnes', 'departamento_id' => 45],
            ['name' => 'Puerto Lempira', 'departamento_id' => 45],
            ['name' => 'Río Esteban', 'departamento_id' => 45],
            ['name' => 'Villeda Morales', 'departamento_id' => 45],
        ];

        foreach ($graciasADiosMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Intibucá

        $intibucaMunicipalities = [
            ['name' => 'Camasca', 'departamento_id' => 46],
            ['name' => 'Colomoncagua', 'departamento_id' => 46],
            ['name' => 'Concepción', 'departamento_id' => 46],
            ['name' => 'Dolores', 'departamento_id' => 46],
            ['name' => 'Intibucá', 'departamento_id' => 46],
            ['name' => 'Jesús de Otoro', 'departamento_id' => 46],
            ['name' => 'La Esperanza', 'departamento_id' => 46],
            ['name' => 'Magdalena', 'departamento_id' => 46],
            ['name' => 'Masaguara', 'departamento_id' => 46],
            ['name' => 'San Antonio', 'departamento_id' => 46],
            ['name' => 'San Isidro', 'departamento_id' => 46],
            ['name' => 'San Juan', 'departamento_id' => 46],
            ['name' => 'San Marcos de la Sierra', 'departamento_id' => 46],
            ['name' => 'San Miguel Guancapla', 'departamento_id' => 46],
            ['name' => 'Santa Lucía', 'departamento_id' => 46],
            ['name' => 'Yamaranguila', 'departamento_id' => 46],
        ];

        foreach ($intibucaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Islas de la Bahía

        $islasDeLaBahiaMunicipalities = [
            ['name' => 'Guanaja', 'departamento_id' => 47],
            ['name' => 'José Santos Guardiola', 'departamento_id' => 47],
            ['name' => 'Roatán', 'departamento_id' => 47],
            ['name' => 'Utila', 'departamento_id' => 47],
        ];

        foreach ($islasDeLaBahiaMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de La Paz
        $laPazMunicipalities = [
            ['name' => 'Aguanqueterique', 'departamento_id' => 48],
            ['name' => 'Cabañas', 'departamento_id' => 48],
            ['name' => 'Cane', 'departamento_id' => 48],
            ['name' => 'Chinacla', 'departamento_id' => 48],
            ['name' => 'Guajiquiro', 'departamento_id' => 48],
            ['name' => 'La Paz', 'departamento_id' => 48],
            ['name' => 'Lauterique', 'departamento_id' => 48],
            ['name' => 'Marcala', 'departamento_id' => 48],
            ['name' => 'Mercedes de Oriente', 'departamento_id' => 48],
            ['name' => 'Opatoro', 'departamento_id' => 48],
            ['name' => 'San Antonio del Norte', 'departamento_id' => 48],
            ['name' => 'San José', 'departamento_id' => 48],
            ['name' => 'San Juan', 'departamento_id' => 48],
            ['name' => 'San Pedro de Tutule', 'departamento_id' => 48],
            ['name' => 'Santa Ana', 'departamento_id' => 48],
            ['name' => 'Santa Elena', 'departamento_id' => 48],
            ['name' => 'Santa María', 'departamento_id' => 48],
            ['name' => 'Santiago de Puringla', 'departamento_id' => 48],
            ['name' => 'Yarula', 'departamento_id' => 48],
        ];

        foreach ($laPazMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Lempira

        $lempiraMunicipalities = [
            ['name' => 'Belén', 'departamento_id' => 49],
            ['name' => 'Candelaria', 'departamento_id' => 49],
            ['name' => 'Cololaca', 'departamento_id' => 49],
            ['name' => 'Erandique', 'departamento_id' => 49],
            ['name' => 'Gualcince', 'departamento_id' => 49],
            ['name' => 'Gracias', 'departamento_id' => 49],
            ['name' => 'Guarita', 'departamento_id' => 49],
            ['name' => 'La Campa', 'departamento_id' => 49],
            ['name' => 'La Iguala', 'departamento_id' => 49],
            ['name' => 'Las Flores', 'departamento_id' => 49],
            ['name' => 'La Unión', 'departamento_id' => 49],
            ['name' => 'La Virtud', 'departamento_id' => 49],
            ['name' => 'Lepaera', 'departamento_id' => 49],
            ['name' => 'Mapulaca', 'departamento_id' => 49],
            ['name' => 'Piraera', 'departamento_id' => 49],
            ['name' => 'San Andrés', 'departamento_id' => 49],
            ['name' => 'San Francisco', 'departamento_id' => 49],
            ['name' => 'San Juan Guarita', 'departamento_id' => 49],
            ['name' => 'San Manuel Colohete', 'departamento_id' => 49],
            ['name' => 'San Rafael', 'departamento_id' => 49],
            ['name' => 'San Sebastián', 'departamento_id' => 49],
            ['name' => 'Santa Cruz', 'departamento_id' => 49],
            ['name' => 'Talgua', 'departamento_id' => 49],
            ['name' => 'Tambla', 'departamento_id' => 49],
            ['name' => 'Tomalá', 'departamento_id' => 49],
            ['name' => 'Valladolid', 'departamento_id' => 49],
            ['name' => 'Virginia', 'departamento_id' => 49],
            ['name' => 'San Marcos de Caiquín', 'departamento_id' => 49],
        ];

        foreach ($lempiraMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Ocotepeque
        $ocotepequeMunicipalities = [
            ['name' => 'Belén Gualcho', 'departamento_id' => 50],
            ['name' => 'Concepción', 'departamento_id' => 50],
            ['name' => 'Dolores Merendón', 'departamento_id' => 50],
            ['name' => 'Fraternidad', 'departamento_id' => 50],
            ['name' => 'La Encarnación', 'departamento_id' => 50],
            ['name' => 'La Labor', 'departamento_id' => 50],
            ['name' => 'Lucerna', 'departamento_id' => 50],
            ['name' => 'Mercedes', 'departamento_id' => 50],
            ['name' => 'Ocotepeque', 'departamento_id' => 50],
            ['name' => 'San Fernando', 'departamento_id' => 50],
            ['name' => 'San Francisco del Valle', 'departamento_id' => 50],
            ['name' => 'San Jorge', 'departamento_id' => 50],
            ['name' => 'San Marcos', 'departamento_id' => 50],
            ['name' => 'Santa Fe', 'departamento_id' => 50],
            ['name' => 'Sensenti', 'departamento_id' => 50],
            ['name' => 'Sinuapa', 'departamento_id' => 50],
        ];

        foreach ($ocotepequeMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Olancho
        $olanchoMunicipalities = [
            ['name' => 'Campamento', 'departamento_id' => 51],
            ['name' => 'Catacamas', 'departamento_id' => 51],
            ['name' => 'Concordia', 'departamento_id' => 51],
            ['name' => 'Dulce Nombre de Culmí', 'departamento_id' => 51],
            ['name' => 'El Rosario', 'departamento_id' => 51],
            ['name' => 'Esquipulas del Norte', 'departamento_id' => 51],
            ['name' => 'Gualaco', 'departamento_id' => 51],
            ['name' => 'Guarizama', 'departamento_id' => 51],
            ['name' => 'Guata', 'departamento_id' => 51],
            ['name' => 'Guayape', 'departamento_id' => 51],
            ['name' => 'Jano', 'departamento_id' => 51],
            ['name' => 'La Unión', 'departamento_id' => 51],
            ['name' => 'Mangulile', 'departamento_id' => 51],
            ['name' => 'Manto', 'departamento_id' => 51],
            ['name' => 'Salamá', 'departamento_id' => 51],
            ['name' => 'San Esteban', 'departamento_id' => 51],
            ['name' => 'San Francisco de Becerra', 'departamento_id' => 51],
            ['name' => 'San Francisco de La Paz', 'departamento_id' => 51],
            ['name' => 'Santa María del Real', 'departamento_id' => 51],
            ['name' => 'Silca', 'departamento_id' => 51],
            ['name' => 'Yocón', 'departamento_id' => 51],
            ['name' => 'Juticalpa', 'departamento_id' => 51],
            ['name' => 'Patuca', 'departamento_id' => 51],
            ['name' => 'Santa María del Real', 'departamento_id' => 51],
        ];

        foreach ($olanchoMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Santa Bárbara

        $santaBarbaraMunicipalities = [
            ['name' => 'Arada', 'departamento_id' => 52],
            ['name' => 'Atima', 'departamento_id' => 52],
            ['name' => 'Azacualpa', 'departamento_id' => 52],
            ['name' => 'Ceguaca', 'departamento_id' => 52],
            ['name' => 'Concepción del Norte', 'departamento_id' => 52],
            ['name' => 'Concepción del Sur', 'departamento_id' => 52],
            ['name' => 'Chinda', 'departamento_id' => 52],
            ['name' => 'El Níspero', 'departamento_id' => 52],
            ['name' => 'Gualala', 'departamento_id' => 52],
            ['name' => 'Ilama', 'departamento_id' => 52],
            ['name' => 'Macuelizo', 'departamento_id' => 52],
            ['name' => 'Naranjito', 'departamento_id' => 52],
            ['name' => 'Nueva Celilac', 'departamento_id' => 52],
            ['name' => 'Petoa', 'departamento_id' => 52],
            ['name' => 'Protección', 'departamento_id' => 52],
            ['name' => 'Quimistán', 'departamento_id' => 52],
            ['name' => 'San Francisco de Ojuera', 'departamento_id' => 52],
            ['name' => 'San José de Colinas', 'departamento_id' => 52],
            ['name' => 'San Luis', 'departamento_id' => 52],
            ['name' => 'San Marcos', 'departamento_id' => 52],
            ['name' => 'San Nicolás', 'departamento_id' => 52],
            ['name' => 'San Pedro Zacapa', 'departamento_id' => 52],
            ['name' => 'Santa Bárbara', 'departamento_id' => 52],
            ['name' => 'Santa Rita', 'departamento_id' => 52],
            ['name' => 'San Vicente Centenario', 'departamento_id' => 52],
            ['name' => 'Trinidad', 'departamento_id' => 52],
            ['name' => 'Las Vegas', 'departamento_id' => 52],
        ];

        foreach ($santaBarbaraMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Valle
        $valleMunicipalities = [
            ['name' => 'Alianza', 'departamento_id' => 53],
            ['name' => 'Amapala', 'departamento_id' => 53],
            ['name' => 'Aramecina', 'departamento_id' => 53],
            ['name' => 'Caridad', 'departamento_id' => 53],
            ['name' => 'Goascorán', 'departamento_id' => 53],
            ['name' => 'Langue', 'departamento_id' => 53],
            ['name' => 'Nacaome', 'departamento_id' => 53],
            ['name' => 'San Francisco de Coray', 'departamento_id' => 53],
            ['name' => 'San Lorenzo', 'departamento_id' => 53],
        ];

        foreach ($valleMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }

        //Municipios de Yoro

        $yoroMunicipalities = [
            ['name' => 'Arenal', 'departamento_id' => 54],
            ['name' => 'El Negrito', 'departamento_id' => 54],
            ['name' => 'El Progreso', 'departamento_id' => 54],
            ['name' => 'Jocón', 'departamento_id' => 54],
            ['name' => 'Morazán', 'departamento_id' => 54],
            ['name' => 'Olanchito', 'departamento_id' => 54],
            ['name' => 'Santa Rita', 'departamento_id' => 54],
            ['name' => 'Sulaco', 'departamento_id' => 54],
            ['name' => 'Victoria', 'departamento_id' => 54],
            ['name' => 'Yorito', 'departamento_id' => 54],
            ['name' => 'Yoro', 'departamento_id' => 54],
        ];

        foreach ($yoroMunicipalities as $municipio) {
            \App\Models\Ciudad::create([
                'nombre' => $municipio['name'],
                'departamento_id' => $municipio['departamento_id'],
                'slug' => \Illuminate\Support\Str::slug($municipio['name']),
                'active_at' => now(),
            ]);
        }
    }
}
