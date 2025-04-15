<?php

namespace Database\Seeders;

use App\Models\Pais;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrearCuentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Super_Admin',
            'M&E',
            'Equipo Regional de programas',
            'Coordinaciones de proyecto',
            'Coordinación de componente',
            'Implementadoras líderes',
            'Staff técnico',
        ];


        $usuarios = [
            ['name' => 'Abner Turcios', 'email' => 'aturcios@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Alba Flores', 'email' => 'alflores@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Diana Orellana', 'email' => 'dorellana@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Gabriela Pino', 'email' => 'gpino@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Karla Jordán', 'email' => 'kjordan@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Lorena Álvarez', 'email' => 'lalvarez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Ricardo Amaya', 'email' => 'ramaya@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Tania Cárcamo', 'email' => 'tcarcamo@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Verónica Hernández', 'email' => 'vlhernandez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Beatriz Villalobos', 'email' => 'bvillalobos@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Elizabeth Henríquez', 'email' => 'mhenriquez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Stephanie Campos', 'email' => 'scampos@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Armando Guevara', 'email' => 'aguevara@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Claribel Dimas', 'email' => 'cdimas@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Gisela Méndez', 'email' => 'gmmendez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Estela Ayala', 'email' => 'relopez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Abigail Rivera', 'email' => 'darivera@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Gabriela Flores', 'email' => 'agflores@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Paola Torres', 'email' => 'ptorres@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Fátima Montoya', 'email' => 'fmontoya@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Katerine Valle', 'email' => 'kvalle@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Doris Ramírez', 'email' => 'daramirez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Fátima Zelada', 'email' => 'fzelada@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Esther Zavala', 'email' => 'eszavala@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Yeli Martínez', 'email' => 'ymartinez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Elisa Contreras', 'email' => 'econtreras@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Mónica Duarte', 'email' => 'maduarte@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Karina Rojas', 'email' => 'krojas@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Edgardo Alvarez', 'email' => 'ealvarez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Veronica Martinez', 'email' => 'vemartinez@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Gricelda Rodriguez', 'email' => 'mgrodriguez@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Elizabeth Sánchez', 'email' => 'eescobar@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Robin Cartagena', 'email' => 'racartagena@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Glenda Zúniga', 'email' => 'gzuniga@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Marta Alvarenga', 'email' => 'mtalvarenga@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Gustavo Rojas', 'email' => 'grojas@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Camila Recinos', 'email' => 'cmrecinos@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Karla Sucely Veliz', 'email' => '', 'role' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Erasmo León', 'email' => '', 'role' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Cristian Valladares', 'email' => '', 'role' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Iris Girón', 'email' => '', 'role' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Jeaneth Marroquín', 'email' => '', 'role' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Paulina Díaz-Durán', 'email' => '', 'role' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Edgar Oliva', 'email' => '', 'role' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Susana Cotzajay', 'email' => '', 'role' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Jireh Cruz', 'email' => '', 'role' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Silvia Zapeta', 'email' => '', 'role' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Andrea Vasquez', 'email' => '', 'role' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Veronica Caxaj', 'email' => '', 'role' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Lesli Pérez', 'email' => '', 'role' => 'Implementadoras líderes', 'pais' => 'Guatemala'],
            ['name' => 'Mercedes de los Ángeles Peña', 'email' => '', 'role' => 'Implementadoras líderes', 'pais' => 'Guatemala'],
            ['name' => 'Sheny Gonzalez', 'email' => '', 'role' => 'Implementadoras líderes', 'pais' => 'Guatemala'],
            ['name' => 'Carlos Humberto Alvarenga Avila', 'email' => 'calvarenga@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Elka Sarahi Nuñez Martinez', 'email' => 'esnunez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Jessica Nohemy Mencia', 'email' => 'jmencia@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Kevin Emely Umanzor Izaguirre', 'email' => 'kumanzor@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Kirian Esther Tejada', 'email' => 'ktejada@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Nancy Marleny Duran', 'email' => 'nmduran@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Sein Mizael Sanchez', 'email' => 'ssanchez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Vilma Julissa Caballero', 'email' => 'jcaballero@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Alyna Michelle Osavas Tejada', 'email' => 'aosavas@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Edwin Josue Flores', 'email' => 'eflores@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Fabricio Arturo Martínez Cruz', 'email' => 'famartinez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Juan Felipe Yanes', 'email' => 'jyanes@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Kristalyn Scarlett Rivera Trejo', 'email' => 'krivera@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Luis Miguel Trochez Castros', 'email' => 'ltrochez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Mario Alejandro Ayala', 'email' => 'aayala@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Norma Emilia Moncada', 'email' => 'nmoncada@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Yesika Waleska RodrIguez Amaya', 'email' => 'yrodriguez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'Honduras'],
        ];

        $usuariosMexico = [
            ['name' => 'Citlali Martínez', 'email' => 'cymartinez@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'México'],
            ['name' => 'Isabel Reyes Arguello', 'email' => 'iarguello@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'México'],
            ['name' => 'Jorge Durán Chávez', 'email' => 'jduran@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'México'],
            ['name' => 'Alejandro David Días', 'email' => 'addiaz@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'México'],
            ['name' => 'Merlina Miquiztli Díaz', 'email' => 'mdiaz@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'México'],
            ['name' => 'Mariela Orta Rivera', 'email' => 'morta@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'México'],
            ['name' => 'Francisco Pablo Rosas', 'email' => 'frosas@glasswing.org', 'role' => 'Implementadoras líderes', 'pais' => 'México'],
            ['name' => 'Carolina Hernández', 'email' => 'cgutierrez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'México'],
            ['name' => 'Aketzali Samara Márquez', 'email' => 'asmarquez@glasswing.org', 'role' => 'Staff técnico', 'pais' => 'México'],
        ];

        foreach ($usuariosMexico as $usuario) {

            if($usuario['email'] == ''){
                continue;
            }

            if(\App\Models\User::where('email', $usuario['email'])->first()){
                continue;
            }


            //$pais = $usuario['pais'] == "Honduras" ? 3 : ($usuario['pais'] == "Guatemala" ? 1 : 2);
            $pais = 4;


            \App\Models\User::factory()->create([
                'name' => $usuario['name'],
                'email' => $usuario['email'],
                'pais_id' => $pais,
            ])->assignRole($usuario['role']);
        }


        // $pais = Pais::firstOrCreate(
        //     ['nombre' => 'México'],
        //     ['codigo' => '+52'],
        //     ['timezone' => 'America/Mexico_City']
        // );


        // $listadoUsuarios = [
        //         ['name' => 'Susana Verónica Araujo Andrade', 'email' => 'saraujo@glasswing.org', 'role' => 'Equipo Regional de programas'],
        //         ['name' => 'Adriana Julissa Zuniga', 'email' => 'azuniga@glasswing.org', 'role' => 'Equipo Regional de programas'],
        //     //    ['name' => 'Elena Rivera', 'email' => 'erivera@glasswing.org', 'role' => 'M&E'],
        // ];

        // foreach ($listadoUsuarios as $usuario) {
        //     \App\Models\User::factory()->create([
        //         'name' => $usuario['name'],
        //         'email' => $usuario['email'],
        //         'pais_id' => 2,
        //     ])->assignRole($usuario['role']);
        // }

        // \App\Models\User::factory()->create([
        //     'name' => 'Elena Rivera',
        //     'email' => 'erivera@glasswing.org',
        //     'pais_id' => $pais->id,
        // ])->assignRole('M&E');
    }
}
