<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArreglarRolesSeeder extends Seeder
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
            'Staff técnico formaciones',
            'Implementadores líderes formaciones',
            'Coordinaciones de componente formaciones',
            'Staff técnico Intervenciones',
            'Implementadoras líderes intervenciones',
            'Coordinaciones de componente intervenciones',
            'Staff técnico club de niñas',
            'Coordinaciones de componente club de niñas',
        ];



        $users = [
            ['nombre' => 'Kenia Quijada', 'email' => 'kquijada@glasswing.org', 'rol' => 'M&E', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Eliseo Flores', 'email' => 'gflores@glasswing.org', 'rol' => 'M&E', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Sofía Mangandi', 'email' => 'smangandi@glasswing.org', 'rol' => 'M&E', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Marcela Alvarenga', 'email' => 'malvarenga@glasswing.org', 'rol' => 'Super_Admin', 'pais' => 'Regional', 'estado' => 'Activo'],
            ['nombre' => 'Alexandra Rodriguez', 'email' => 'yarodriguez@glasswing.org', 'rol' => 'M&E', 'pais' => 'Regional', 'estado' => 'Activo'],
            ['nombre' => 'Elena Rivera', 'email' => 'elrivera@glasswing.org', 'rol' => 'M&E', 'pais' => 'Mexico', 'estado' => 'Activo'],
            ['nombre' => 'Kelvin Vallecillo Leiva', 'email' => 'kleiva@glasswing.org', 'rol' => 'M&E', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Marlon Andino', 'email' => 'mandino@glasswing.org', 'rol' => 'M&E', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Franklin Oxlaj', 'email' => 'foxlaj@glasswing.org', 'rol' => 'M&E', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Sofía Cortez', 'email' => 'scortez@glasswing.org', 'rol' => 'M&E', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Mario Chávez', 'email' => 'mrchavez@glasswing.org', 'rol' => 'M&E', 'pais' => 'Regional', 'estado' => 'Activo'],
            ['nombre' => 'Fabiola Rubio', 'email' => 'frubio@glasswing.org', 'rol' => 'M&E', 'pais' => 'Regional', 'estado' => 'Activo'],
            ['nombre' => 'Abner Turcios', 'email' => 'aturcios@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Alba Flores', 'email' => 'alflores@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Diana Orellana', 'email' => 'dorellana@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Gabriela Pino', 'email' => 'gpino@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Karla Jordán', 'email' => 'kjordan@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Lorena Álvarez', 'email' => 'lalvarez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Ricardo Amaya', 'email' => 'ramaya@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Tania Cárcamo', 'email' => 'tcarcamo@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Verónica Hernández', 'email' => 'vlhernandez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Beatriz Villalobos', 'email' => 'bvillalobos@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Elizabeth Henríquez', 'email' => 'mhenriquez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Stephanie Campos', 'email' => 'scampos@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Inactivo'],
            ['nombre' => 'Armando Guevara', 'email' => 'aguevara@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Inactivo'],
            ['nombre' => 'Claribel Dimas', 'email' => 'cdimas@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Gisela Méndez', 'email' => 'gmmendez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Estela Ayala', 'email' => 'relopez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Abigail Rivera', 'email' => 'darivera@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Gabriela Flores', 'email' => 'agflores@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Paola Torres', 'email' => 'ptorres@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Fátima Montoya', 'email' => 'fmontoya@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Katerine Valle', 'email' => 'kvalle@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Doris Ramírez', 'email' => 'daramirez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Fátima Zelada', 'email' => 'fzelada@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Esther Zavala', 'email' => 'eszavala@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Yeli Martínez', 'email' => 'ymartinez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Elisa Contreras', 'email' => 'econtreras@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Mónica Duarte', 'email' => 'maduarte@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Karina Rojas', 'email' => 'krojas@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Edgardo Alvarez', 'email' => 'ealvarez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Veronica Martinez', 'email' => 'vemartinez@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Gricelda Rodriguez', 'email' => 'mgrodriguez@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Elizabeth Sánchez', 'email' => 'eescobar@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Robin Cartagena', 'email' => 'racartagena@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Glenda Zúniga', 'email' => 'gzuniga@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Marta Alvarenga', 'email' => 'mtalvarenga@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Gustavo Rojas', 'email' => 'grojas@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Camila Recinos', 'email' => 'cmrecinos@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Elka Sarahi Nuñez Martinez', 'email' => 'esnunez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Jessica Nohemy Mencia', 'email' => 'jmencia@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Kevin Emely Umanzor Izaguirre', 'email' => 'kumanzor@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Kirian Esther Tejada', 'email' => 'ktejada@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Vilma Julissa Caballero', 'email' => 'jcaballero@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Edwin Josue Flores', 'email' => 'eflores@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Fabricio Arturo Martínez Cruz', 'email' => 'famartinez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Juan Felipe Yanes', 'email' => 'jyanes@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Luis Miguel Trochez Castros', 'email' => 'ltrochez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Norma Emilia Moncada', 'email' => 'nmoncada@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Neyba Dallana Santos Martinez', 'email' => 'nsantos@glasswing.org', 'rol' => 'Coordinaciones de componente formaciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Shirley Quintero Benitez', 'email' => 'squintero@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Colombia', 'estado' => 'Activo'],
            ['nombre' => 'Stefania Sáez Navarro', 'email' => 'ssaez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Colombia', 'estado' => 'Activo'],
            ['nombre' => 'Patricia Arciniégas Rosales', 'email' => 'parciniegas@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Colombia', 'estado' => 'Activo'],
            ['nombre' => 'Katherine Zelaya Zepeda', 'email' => 'kzalaya@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Colombia', 'estado' => 'Activo'],
            ['nombre' => 'Jorge Durán Chávez', 'email' => 'jduran@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Alejandro David Díaz Navarro', 'email' => 'addiaz@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Alejandro Hernández', 'email' => 'amendoza@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Merlina Miquiztli Díaz Galván', 'email' => 'mdiaz@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Mariela Orta Rivera', 'email' => 'morta@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Francisco Pablo Rosas Lucas', 'email' => 'frosas@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Carolina Hernández', 'email' => 'cgutierrez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Aketzali Samara Márquez Romero', 'email' => 'asmarquez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'México', 'estado' => 'Inactivo'],
            ['nombre' => 'Carolina Lagunas Celaya', 'email' => 'clagunas@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Sara Miranda Herrera', 'email' => 'sherrera@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Carolina Hernández Gutiérrez', 'email' => 'cgutierrez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Camila Silva', 'email' => 'camilasilva@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Panamá', 'estado' => 'Activo'],
            ['nombre' => 'Karina Castillo', 'email' => 'kvaldes@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Panamá', 'estado' => 'Activo'],
            ['nombre' => 'Karla Sucely Veliz', 'email' => 'kveliz@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Erasmo León', 'email' => 'rleon@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Cristian Valladares', 'email' => 'cjvalladares@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Iris Girón', 'email' => 'igiron@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Jeaneth Marroquín', 'email' => 'jobarrera@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Paulina Díaz-Durán', 'email' => 'pdiaz@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Edgar Oliva', 'email' => 'eoliva@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Susana Cotzajay', 'email' => 'scotzajay@glasswing.gt', 'rol' => 'Staff técnico formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Jireh Cruz', 'email' => 'ecruz@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Silvia Zapeta', 'email' => 'szapeta@Glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Andrea Vasquez', 'email' => 'apvasquez@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Veronica Caxaj', 'email' => 'vcaxaj@glasswing.org', 'rol' => 'Staff técnico formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Lesli Pérez', 'email' => 'lperez@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Mercedes de los Ángeles Peña', 'email' => 'mrodriguez@glasswing.org', 'rol' => 'Implementadores líderes formaciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Esmeralda Ferrer', 'email' => 'rferrer@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Maria Romero', 'email' => 'mromero@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Claudia Rivas', 'email' => 'cyrivas@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Peggi Monchez', 'email' => 'pmonchez@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Carla Retana', 'email' => 'cretana@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'El Salvador', 'estado' => 'Inactivo'],
            ['nombre' => 'Kenia Mazariego', 'email' => 'kjmazariego@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Zahida Chévez', 'email' => 'zchevez@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Marcela Muñoz', 'email' => 'amunoz@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'El Salvador', 'estado' => 'Inactivo'],
            ['nombre' => 'Verónica Mendoza', 'email' => 'vmendoza@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Gabriela Jeréz', 'email' => 'gjerez@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'El Salvador', 'estado' => 'Inactivo'],
            ['nombre' => 'Metzi Trejo', 'email' => 'mbernal@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Diana Mojica', 'email' => 'dmojica@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Verónica Alvarenga', 'email' => 'vealvarenga@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Mario Chinco', 'email' => 'mchinco@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Ana Gladys Guevara', 'email' => 'agguevara@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'El Salvador', 'estado' => 'Inactivo'],
            ['nombre' => 'Laura Cerritos', 'email' => 'lcerritos@glasswing.org', 'rol' => 'Coordinaciones de componente intervenciones', 'pais' => 'El Salvador', 'estado' => 'Inactivo'],
            ['nombre' => 'Elis Mauri Lagos Solorzano', 'email' => 'elagos@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Richard Josué Manzanares', 'email' => 'rmanzanares@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Gissell Carolina Paz', 'email' => 'gcpaz@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Ilssy Mabel Bardales', 'email' => 'ibardales@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'Honduras', 'estado' => 'Inactivo'],
            ['nombre' => 'Olga Liseth Mejia', 'email' => 'omejia@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'Honduras', 'estado' => 'Inactivo'],
            ['nombre' => 'Kency Julissa Madrid', 'email' => 'kjmadrid@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'Honduras', 'estado' => 'Inactivo'],
            ['nombre' => 'Emilson Javier Vega', 'email' => 'evega@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Mirian Iveth Ortiz', 'email' => 'mortiz@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Aida Karolina Escobar', 'email' => 'akescobar@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Cinthia Lucila Pineda', 'email' => 'clpineda@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Soraya Fabiola Valladares', 'email' => 'sfvalladares@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'Honduras', 'estado' => 'Inactivo'],
            ['nombre' => 'Katia Sarai Peralta', 'email' => 'kperalta@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'Honduras', 'estado' => 'Inactivo'],
            ['nombre' => 'Silia Yaneth Barahona Hernandez', 'email' => 'sbarahona@glasswing.org', 'rol' => 'Coordinaciones de componente intervenciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Karol Elizabeth Carias Morales', 'email' => 'kcarias@glasswing.org', 'rol' => 'Coordinaciones de componente intervenciones', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Merlina Miquiztli Díaz Galván', 'email' => 'mdiaz@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Carolina Hernández', 'email' => 'cgutierrez@glasswing.org', 'rol' => 'Staff técnico Intervenciones', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'María Emperatriz Altán Chacón', 'email' => 'maltan@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Doris Stefani Vidal Colmenar', 'email' => 'dvidal@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Maria Fernanda Ramirez', 'email' => 'mramirez@glasswing.org', 'rol' => 'Coordinaciones de componente intervenciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Karen Lucia Esteban', 'email' => 'kesteban@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Fabrizi Abisai Juarez', 'email' => 'fjuarez@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Sheny Gonzales', 'email' => 'sgonzalez@glasswing.org', 'rol' => 'Implementadoras líderes intervenciones', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Liz Valeria Suarez Periñan', 'email' => 'lsuarez@glasswing.org', 'rol' => 'Staff técnico club de niñas', 'pais' => 'Colombia', 'estado' => 'Activo'],
            ['nombre' => 'Laura Sofía Cardona Ríos', 'email' => 'lcardona@glasswing.org', 'rol' => 'Staff técnico club de niñas', 'pais' => 'Colombia', 'estado' => 'Activo'],
            ['nombre' => 'Verónica Navarro Blanco', 'email' => 'vnavarro@glasswing.org', 'rol' => 'Staff técnico club de niñas', 'pais' => 'Costa Rica', 'estado' => 'Activo'],
            ['nombre' => 'Katherine Gutierrez Valverde', 'email' => 'kgutierrez@glasswing.org', 'rol' => 'Staff técnico club de niñas', 'pais' => 'Costa Rica', 'estado' => 'Activo'],
            ['nombre' => 'Camila Silva', 'email' => 'camilasilva@glasswing.org', 'rol' => 'Staff técnico club de niñas', 'pais' => 'Panamá', 'estado' => 'Activo'],
            ['nombre' => 'Karina Castillo', 'email' => 'kvaldes@glasswing.org', 'rol' => 'Staff técnico club de niñas', 'pais' => 'Panamá', 'estado' => 'Activo'],
            ['nombre' => 'Elba Chacón', 'email' => 'echacon@glasswing.org', 'rol' => 'Coordinaciones de componente club de niñas', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Mayra Orellana', 'email' => 'msolorzano@glasswing.org', 'rol' => 'Coordinaciones de componente club de niñas', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Alejandro David Díaz Navarro', 'email' => 'addiaz@glasswing.org', 'rol' => 'Implementadoras líderes club de niñas', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Alejandro Hernández', 'email' => 'amendoza@glasswing.org', 'rol' => 'Implementadoras líderes club de niñas', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Francisco Pablo Rosas Lucas', 'email' => 'frosas@glasswing.org', 'rol' => 'Implementadoras líderes club de niñas', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Carolina Lagunas Celaya', 'email' => 'clagunas@glasswing.org', 'rol' => 'Staff técnico club de niñas', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Carolina Hernández', 'email' => 'cgutierrez@glasswing.org', 'rol' => 'Staff técnico club de niñas', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Zuly Alvarez', 'email' => 'zalvarez@glasswing.org', 'rol' => 'Coordinaciones de componente club de niñas', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Cesia Cortez', 'email' => 'ccortez@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Ivonne Flores', 'email' => 'iflores@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'El Salvador', 'estado' => 'Activo'],
            ['nombre' => 'Marcela Alvarenga', 'email' => 'malvarenga@glasswing.org', 'rol' => 'Super_Admin', 'pais' => 'Regional', 'estado' => 'Activo'],
            ['nombre' => 'Susana Verónica Araujo Andrade', 'email' => 'saraujo@glasswing.org', 'rol' => 'Equipo Regional de Programas', 'pais' => 'Regional', 'estado' => 'Activo'],
            ['nombre' => 'Adriana Julissa Zuniga', 'email' => 'azuniga@glasswing.org', 'rol' => 'Equipo Regional de Programas', 'pais' => 'Regional', 'estado' => 'Activo'],
            ['nombre' => 'Ana Lucia Saenz', 'email' => 'alsaenz@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Colombia', 'estado' => 'Activo'],
            ['nombre' => 'Andrea Moreno Posada', 'email' => 'amoreno@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Colombia', 'estado' => 'Activo'],
            ['nombre' => 'Isabel Reyes Arguello', 'email' => 'iarguello@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Citlali Martínez', 'email' => 'cymartinez@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Sharon Kababie Coronas', 'email' => 'skababie@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Karla Sosa', 'email' => 'ksosa@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Pamela Girón', 'email' => 'pgiron@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Guatemala', 'estado' => 'Activo'],
            ['nombre' => 'Marvin García', 'email' => 'mjgarcia@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Eva Nuñez', 'email' => 'enunez@glasswing.org', 'rol' => 'Coordinaciones de proyecto', 'pais' => 'Honduras', 'estado' => 'Activo'],
            ['nombre' => 'Stephanie Martínez', 'email' => 'smartinez@glasswing.org', 'rol' => 'Super_Admin', 'pais' => 'Regional', 'estado' => 'Activo'],
            ['nombre' => 'Camila Acevedo', 'email' => 'cacevedo@glasswing.org', 'rol' => 'Equipo Regional de Programas', 'pais' => 'Regional', 'estado' => 'Activo'],
            ['nombre' => 'Usuario de prueba Guatemala', 'email' => 'guatemala@glasswing.org', 'rol' => 'Super_Admin', 'pais' => 'Regional', 'estado' => 'Activo'],
            ['nombre' => 'Usuario de prueba El Salvador', 'email' => 'elsalvador@glasswing.org', 'rol' => 'Super_Admin', 'pais' => 'Regional', 'estado' => 'Activo'],
            ['nombre' => 'Usuario de prueba Honduras', 'email' => 'honduras@glasswing.org', 'rol' => 'Super_Admin', 'pais' => 'Regional', 'estado' => 'Activo'],
            ['nombre' => 'Usuario de prueba México', 'email' => 'mexico@glasswing.org', 'rol' => 'Super_Admin', 'pais' => 'México', 'estado' => 'Activo'],
            ['nombre' => 'Usuario de prueba Panamá', 'email' => 'panama@glasswing.org', 'rol' => 'Super_Admin', 'pais' => 'Panamá', 'estado' => 'Activo'],
            ['nombre' => 'Usuario de prueba Costa Rica', 'email' => 'costarica@glasswing.org', 'rol' => 'Super_Admin', 'pais' => 'Costa Rica', 'estado' => 'Activo'],
            ['nombre' => 'Usuario de prueba Colombia', 'email' => 'colombia@glasswing.org', 'rol' => 'Super_Admin', 'pais' => 'Colombia', 'estado' => 'Activo'],
        ];


        foreach ($users as $usuario) {

            $pais = 2;
            switch ($usuario['pais']) {
                case 'Guatemala':
                    $pais = 1;
                    break;
                case 'El Salvador':
                    $pais = 2;
                    break;
                case 'Honduras':
                    $pais = 3;
                    break;
                case 'México':
                    $pais = 4;
                    break;
                case 'Panamá':
                    $pais = 6;
                    break;
                case 'Costa Rica':
                    $pais = 7;
                    break;
                case 'Colombia':
                    $pais = 8;
                    break;
                default:
                    $pais = 2;
                    break;
            }

            $user = \App\Models\User::where('email', $usuario['email'])->first();
            if($user){
                $user->assignRole($usuario['rol']);
            }else{
                \App\Models\User::factory()->create([
                    'name' => $usuario['nombre'],
                    'email' => $usuario['email'],
                    'pais_id' => $pais,
                ])->assignRole($usuario['rol']);
            }



        }




    }
}
