<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $formadores = [
            // El Salvador
            ['name' => 'Abner Turcios', 'email' => 'aturcios@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Alba Flores', 'email' => 'alflores@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Diana Orellana', 'email' => 'dorellana@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Gabriela Pino', 'email' => 'gpino@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Karla Jordán', 'email' => 'kjordan@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Lorena Álvarez', 'email' => 'lalvarez@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Ricardo Amaya', 'email' => 'ramaya@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Tania Cárcamo', 'email' => 'tcarcamo@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Verónica Hernández', 'email' => 'vlhernandez@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Beatriz Villalobos', 'email' => 'bvillalobos@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Elizabeth Henríquez', 'email' => 'mhenriquez@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Stephanie Campos', 'email' => 'scampos@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Armando Guevara', 'email' => 'aguevara@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Claribel Dimas', 'email' => 'cdimas@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Gisela Méndez', 'email' => 'gmmendez@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Estela Ayala', 'email' => 'relopez@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Abigail Rivera', 'email' => 'darivera@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Gabriela Flores', 'email' => 'agflores@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Paola Torres', 'email' => 'ptorres@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Fátima Montoya', 'email' => 'fmontoya@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Katerine Valle', 'email' => 'kvalle@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Doris Ramírez', 'email' => 'daramirez@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Fátima Zelada', 'email' => 'fzelada@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Esther Zavala', 'email' => 'eszavala@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Yeli Martínez', 'email' => 'ymartinez@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Elisa Contreras', 'email' => 'econtreras@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Mónica Duarte', 'email' => 'maduarte@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Karina Rojas', 'email' => 'krojas@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Edgardo Alvarez', 'email' => 'ealvarez@glasswing.org', 'rol' => 'Staff técnico', 'pais' => 'El Salvador'],
            ['name' => 'Veronica Martinez', 'email' => 'vemartinez@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Gricelda Rodriguez', 'email' => 'mgrodriguez@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Elizabeth Sánchez', 'email' => 'eescobar@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Robin Cartagena', 'email' => 'racartagena@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Glenda Zúniga', 'email' => 'gzuniga@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Marta Alvarenga', 'email' => 'mtalvarenga@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Gustavo Rojas', 'email' => 'grojas@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'El Salvador'],
            ['name' => 'Camila Recinos', 'email' => 'cmrecinos@glasswing.org', 'rol' => 'Implementadoras líderes', 'pais' => 'El Salvador'],

            // Guatemala
            ['name' => 'Karla Sucely Veliz', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Erasmo León', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Cristian Valladares', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Iris Girón', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Jeaneth Marroquín', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Paulina Díaz-Durán', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Edgar Oliva', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Susana Cotzajay', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Jireh Cruz', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Silvia Zapeta', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Andrea Vasquez', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Veronica Caxaj', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Guatemala'],
            ['name' => 'Lesli Pérez', 'email' => '', 'rol' => 'Implementadoras líderes', 'pais' => 'Guatemala'],
            ['name' => 'Mercedes de los Ángeles Peña', 'email' => '', 'rol' => 'Implementadoras líderes', 'pais' => 'Guatemala'],
            ['name' => 'Sheny Gonzalez', 'email' => '', 'rol' => 'Implementadoras líderes', 'pais' => 'Guatemala'],

            // Honduras
            ['name' => 'Carlos Humberto Alvarenga Avila', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Elka Sarahi Nuñez Martinez', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Jessica Nohemy Mencia', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Kevin Emely Umanzor Izaguirre', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Kirian Esther Tejada', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Nancy Marleny Duran', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Sein Mizael Sanchez', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Vilma Julissa Caballero', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Alyna Michelle Osavas Tejada', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Edwin Josue Flores', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Fabricio Arturo Martínez Cruz', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Juan Felipe Yanes', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Kristalyn Scarlett Rivera Trejo', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Luis Miguel Trochez Castros', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Mario Alejandro Ayala', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Norma Emilia Moncada', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
            ['name' => 'Yesika Waleska RodrIguez Amaya', 'email' => '', 'rol' => 'Staff técnico', 'pais' => 'Honduras'],
        ];

        foreach ($formadores as $formador) {
            \App\Models\Formador::create($formador);
        }
    }
}
