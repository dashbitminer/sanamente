<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisosParaRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

//Roles

        $superAdminRole = \Spatie\Permission\Models\Role::where('name', 'Super_Admin')->first();
        $myeRole = \Spatie\Permission\Models\Role::where('name', 'M&E')->first();
        $coordinadoresProyectoRole = \Spatie\Permission\Models\Role::where('name', 'Coordinaciones de proyecto')->first();
        $equipoRegionalProgramasRole = \Spatie\Permission\Models\Role::where('name', 'Equipo Regional de programas')->first();

        //formaciones
        $staffTecnicoFormacionesRole = \App\Models\Role::where('name', 'Staff técnico formaciones')->first();
        $implementadoresLideresFormacionesRole = \App\Models\Role::where('name', 'Implementadores líderes formaciones')->first();
        $coordinacionesFormacionesRole = \App\Models\Role::where('name', 'Coordinaciones de componente formaciones')->first();

        //Intervenciones
        $staffTecnicoIntervencionesRole = \App\Models\Role::where('name', 'Staff técnico Intervenciones')->first();
        $implementadoresLideresIntervencionesRole = \App\Models\Role::where('name', 'Implementadoras líderes intervenciones')->first();
        $coordinacionesIntervencionesRole = \App\Models\Role::where('name', 'Coordinaciones de componente intervenciones')->first();

        //clubnna
        $staffTecnicoClubNNARole = \App\Models\Role::where('name', 'Staff técnico club de niñas')->first();
        $implementadoresLideresClubNNARole = \App\Models\Role::where('name', 'Implementadoras líderes club de niñas')->first();
        $coordinacionesClubNNARole = \App\Models\Role::where('name', 'Coordinaciones de componente club de niñas')->first();



// Crear Usuarios
        $permisosUsuarios = [
            'Crear usuarios',
            'Editar usuarios',
            'Eliminar usuarios',
            'Ver usuarios',
        ];

        foreach ($permisosUsuarios as $permiso) {
            \App\Models\Permission::firstOrCreate([
                'name' => $permiso,
                'categoria' => 'Usuario',
            ]);
        }

        $superAdminRole->givePermissionTo($permisosUsuarios);
        $myeRole->givePermissionTo($permisosUsuarios);

// Crear Roles
        $permisosRoles = [
            'Crear roles',
            'Editar roles',
            'Eliminar roles',
            'Ver roles',
        ];

        foreach ($permisosRoles as $permiso) {
            \App\Models\Permission::firstOrCreate([
                'name' => $permiso,
                'categoria' => 'Roles',
            ]);
        }

        $superAdminRole->givePermissionTo($permisosRoles);
        $myeRole->givePermissionTo($permisosRoles);

// Crear Permisos
        $permisosPermisos = [
            'Crear permisos',
            'Editar permisos',
            'Eliminar permisos',
            'Ver permisos',
        ];

        foreach ($permisosPermisos as $permiso) {
            \App\Models\Permission::firstOrCreate([
                'name' => $permiso,
                'categoria' => 'Permisos',
            ]);
        }

        $superAdminRole->givePermissionTo($permisosPermisos);
        $myeRole->givePermissionTo($permisosPermisos);


//FORMULARIO FORMACIONES SM
        $permisosFormacionesSM = [
            'Crear inscripción formaciones SM',
            'Editar inscripción formaciones SM',
            'Eliminar inscripción formaciones SM',
            'Descargar inscripción formaciones SM',
            'Ver inscripción formaciones SM',
            'Importar inscripción formaciones SM a GWDATA',
        ];

        foreach ($permisosFormacionesSM as $permiso) {
            \App\Models\Permission::firstOrCreate([
                'name' => $permiso,
                'categoria' => 'Inscripción formaciones SM',
            ]);

        }

        $superAdminRole->givePermissionTo($permisosFormacionesSM);
        $myeRole->givePermissionTo($permisosFormacionesSM);
        $coordinadoresProyectoRole->givePermissionTo($permisosFormacionesSM);
        $equipoRegionalProgramasRole->givePermissionTo(['Ver inscripción formaciones SM', 'Descargar inscripción formaciones SM']);
        $staffTecnicoFormacionesRole->givePermissionTo($permisosFormacionesSM);
        $implementadoresLideresFormacionesRole->givePermissionTo($permisosFormacionesSM);
        $coordinacionesFormacionesRole->givePermissionTo($permisosFormacionesSM);




//FORMULARIO SEGUIMIENTO FGSM
        $seguimientosFGSM = [
            'Crear seguimiento FGSM',
            'Editar seguimiento FGSM',
            'Eliminar seguimiento FGSM',
            'Descargar seguimientos FGSM',
            'Ver seguimientos FGSM',
            'Resumen de ejecución por actividad',
            'Resumen de ejecución por persona única',
        ];

        foreach ($seguimientosFGSM as $permiso) {
            \App\Models\Permission::firstOrCreate([
                'name' => $permiso,
                'categoria' => 'Seguimiento FGSM',
            ]);
        }

        $superAdminRole->givePermissionTo($seguimientosFGSM);
        $myeRole->givePermissionTo($seguimientosFGSM);
        $coordinadoresProyectoRole->givePermissionTo($seguimientosFGSM);
        $equipoRegionalProgramasRole->givePermissionTo(['Ver seguimientos FGSM', 'Resumen de ejecución por actividad', 'Resumen de ejecución por persona única', 'Descargar seguimientos FGSM']);
        $staffTecnicoFormacionesRole->givePermissionTo($seguimientosFGSM);
        $implementadoresLideresFormacionesRole->givePermissionTo($seguimientosFGSM);
        $coordinacionesFormacionesRole->givePermissionTo($seguimientosFGSM);


//FORM INTERVENCIONES DIRECTAS SM

        $intervencionesDirectasSM = [
            'Crear intervención directa SM',
            'Editar intervención directa SM',
            'Eliminar intervención directa SM',
            'Descargar intervenciones directas SM',
            'Ver intervenciones directas SM',
        ];

        foreach ($intervencionesDirectasSM as $permiso) {
            \App\Models\Permission::firstOrCreate([
                'name' => $permiso,
                'categoria' => 'Intervenciones directas SM',
            ]);

        }

        $superAdminRole->givePermissionTo($intervencionesDirectasSM);
        $myeRole->givePermissionTo($intervencionesDirectasSM);
        $coordinadoresProyectoRole->givePermissionTo($intervencionesDirectasSM);
        $equipoRegionalProgramasRole->givePermissionTo(['Ver intervenciones directas SM', 'Descargar intervenciones directas SM']);
        // intervenciones
        $staffTecnicoIntervencionesRole->givePermissionTo($intervencionesDirectasSM);
        $implementadoresLideresIntervencionesRole->givePermissionTo($intervencionesDirectasSM);
        $coordinacionesIntervencionesRole->givePermissionTo($intervencionesDirectasSM);


// FORM REFERENCIA RSAC

        $referenciaRSAC = [
            'Crear referencia RSAC',
            'Editar referencia RSAC',
            'Eliminar referencia RSAC',
            'Descargar referencias RSAC',
            'Ver referencias RSAC',
        ];

        foreach ($referenciaRSAC as $permiso) {
            \App\Models\Permission::firstOrCreate([
                'name' => $permiso,
                'categoria' => 'Referencias RSAC',
            ]);

        }

        $superAdminRole->givePermissionTo($referenciaRSAC);
        $myeRole->givePermissionTo($referenciaRSAC);
        $coordinadoresProyectoRole->givePermissionTo($referenciaRSAC);
        $equipoRegionalProgramasRole->givePermissionTo(['Ver referencias RSAC', 'Descargar referencias RSAC']);

// FORM CLUB NNA

        $clubNNA = [
            'Crear registro club NNA',
            'Editar registro club NNA',
            'Eliminar registro club NNA',
            'Descargar registros club NNA',
            'Ver registros club NNA',
            'Importar registros club NNA a GWDATA',
        ];

        foreach ($clubNNA as $permiso) {
            \App\Models\Permission::firstOrCreate([
                'name' => $permiso,
                'categoria' => 'Club NNA',
            ]);

        }

        $superAdminRole->givePermissionTo($clubNNA);
        $myeRole->givePermissionTo($clubNNA);
        $coordinadoresProyectoRole->givePermissionTo($clubNNA);
        $equipoRegionalProgramasRole->givePermissionTo(['Descargar registros club NNA', 'Ver registros club NNA']);

        //Club de niñas

        $staffTecnicoClubNNARole->givePermissionTo($clubNNA);
        $implementadoresLideresClubNNARole->givePermissionTo($clubNNA);
        $coordinacionesClubNNARole->givePermissionTo($clubNNA);

// PERMISOS GENERALES
        $permisosGenerales = [
            'Acceso total',
            'Acceso total de su pais',
            'Acceso total de su región',
            'Acceso a sus formularios',
        ];

        foreach ($permisosGenerales as $permiso) {
            \App\Models\Permission::firstOrCreate([
                'name' => $permiso,
                'categoria' => 'Accesos Generales',
            ]);
        }

        $superAdminRole->givePermissionTo('Acceso total');
        $myeRole->givePermissionTo('Acceso total de su pais');

        $coordinadoresProyectoRole->givePermissionTo('Acceso total de su pais');
        $equipoRegionalProgramasRole->givePermissionTo('Acceso total de su región');

        $staffTecnicoFormacionesRole->givePermissionTo('Acceso a sus formularios');
        $implementadoresLideresFormacionesRole->givePermissionTo('Acceso total de su pais');
        $coordinacionesFormacionesRole->givePermissionTo('Acceso total de su pais');

        $staffTecnicoIntervencionesRole->givePermissionTo('Acceso a sus formularios');
        $implementadoresLideresIntervencionesRole->givePermissionTo('Acceso total de su pais');
        $coordinacionesIntervencionesRole->givePermissionTo('Acceso total de su pais');

        $staffTecnicoClubNNARole->givePermissionTo('Acceso a sus formularios');
        $implementadoresLideresClubNNARole->givePermissionTo('Acceso total de su pais');
        $coordinacionesClubNNARole->givePermissionTo('Acceso total de su pais');

    }
}
