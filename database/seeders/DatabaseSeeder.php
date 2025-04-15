<?php

namespace Database\Seeders;

use App\Models\PerfilSeguimientoOrganizacion;
use App\Models\PerfilSeguimientoSalud;
use App\Models\TipoFormulario;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Formula;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        $this->call([
            PaisSeeder::class,
            DepartamentoSeeder::class,
            CiudadSeeder::class,
            PerfilSeguimientoSeeder::class,
            PerfilSeguimientoDocenteSeeder::class,
            PerfilSeguimientoPoliciaSeeder::class,
            RangoSeguimientoPoliciaSeeder::class,
            PerfilSeguimientoOrganizacionSeeder::class,
            PerfilSeguimientoSaludSeeder::class,
            PerfilSeguimientoHospitalSeeder::class,
            ActividadSeguimientoSeeder::class,
            TipoFormularioSeeder::class,
            FormularioSeeder::class,
            PerfilParticipanteSeeder::class,
            TipoIntervencionSeeder::class,
            TipoOtraIntervencionSeeder::class,
            CanceloProtocoloSeeder::class,
            TipoPsicoeducacionSeeder::class,
            EstrategiasSeeder::class,
            PausoProtocolosSeeder::class,
            RazonIntervencionSeeder::class,
            ProcesosSeeder::class,
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
            IntervencionistaSeeder::class,
            SeguimientoDetalleSeeder::class,
            SeguimientoPasoSeeder::class

        ]);

        //User::factory(10)->create();


        $roles = [
            'Super_Admin',
            'M&E',
            'Equipo Regional de programas',
            'Coordinaciones de proyecto',
            'Coordinación de componente',
            'Implementadoras líderes',
            'Staff técnico',
        ];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create(['name' => $role]);
        }



        $listadoUsuarios = [
                ['name' => 'Laura Cerritos', 'email' => 'lcerritos@glasswing.org', 'role' => 'Coordinaciones de proyecto'],
                ['name' => 'Cesia Cortez', 'email' => 'ccortez@glasswing.org', 'role' => 'Coordinaciones de proyecto'],
                ['name' => 'Ivonne Flores', 'email' => 'iflores@glasswing.org', 'role' => 'Coordinaciones de proyecto'],
                ['name' => 'Esmeralda Ferrer', 'email' => 'rferrer@glasswing.org', 'role' => 'Staff técnico'],
                ['name' => 'Maria Romero', 'email' => 'mromero@glasswing.org', 'role' => 'Staff técnico'],
                ['name' => 'Claudia Rivas', 'email' => 'cyrivas@glasswing.org', 'role' => 'Staff técnico'],
                ['name' => 'Peggi Monchez', 'email' => 'pmonchez@glasswing.org', 'role' => 'Staff técnico'],
                ['name' => 'Carla Retana', 'email' => 'cretana@glasswing.org', 'role' => 'Staff técnico'],
                ['name' => 'Kenia Mazariego', 'email' => 'kjmazariego@glasswing.org', 'role' => 'Staff técnico'],
                ['name' => 'Zahida Chévez', 'email' => 'zchevez@glasswing.org', 'role' => 'Staff técnico'],
                ['name' => 'Marcela Muñoz', 'email' => 'amunoz@glasswing.org', 'role' => 'Staff técnico'],
                ['name' => 'Verónica Mendoza', 'email' => 'vmendoza@glasswing.org', 'role' => 'Implementadoras líderes'],
                ['name' => 'Gabriela Jeréz', 'email' => 'gjerez@glasswing.org', 'role' => 'Implementadoras líderes'],
                ['name' => 'Metzi Trejo', 'email' => 'mbernal@glasswing.org', 'role' => 'Implementadoras líderes'],
                ['name' => 'Diana Mojica', 'email' => 'dmojica@glasswing.org', 'role' => 'Implementadoras líderes'],
                ['name' => 'Verónica Alvarenga', 'email' => 'vealvarenga@glasswing.org', 'role' => 'Implementadoras líderes'],
                ['name' => 'Mario Chinco', 'email' => 'mchinco@glasswing.org', 'role' => 'Implementadoras líderes'],
                ['name' => 'Ana Gladys Guevara', 'email' => 'agguevara@glasswing.org', 'role' => 'Implementadoras líderes'],
                ['name' => 'Kenia Quijada', 'email' => 'kquijada@glasswing.org', 'role' => 'M&E'],
                ['name' => 'Eliseo Flores', 'email' => 'gflores@glasswing.org', 'role' => 'M&E'],
                ['name' => 'Sofía Mangandi', 'email' => 'smangandi@glasswing.org', 'role' => 'M&E'],
        ];

        foreach ($listadoUsuarios as $usuario) {
            User::factory()->create([
                'name' => $usuario['name'],
                'email' => $usuario['email'],
                'pais_id' => 2,
            ])->assignRole($usuario['role']);
        }


        User::factory()->create([
            'name' => 'Usuario de prueba Guatemala',
            'email' => 'guatemala@glasswing.org',
            'pais_id' => 1,
        ])->assignRole('Staff técnico');




        // foreach (User::all() as $user) {
        //     $user->assignRole($roles[rand(0, 5)]);
        //     // $user->sociosImplementadores()->attach(SocioImplementador::all()->random()->id);
        // }
    }
}
