<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pais;
use App\Models\TipoDiscapacidad;
use App\Models\OtraCondicion;
use App\Models\AccionInmediata;
use App\Models\TipoViolencia;
use App\Models\MotivoReferencia;
use App\Models\TipoServicio;
use App\Models\SaludMentalServicio;
use App\Models\InstitucionReferencia;
use App\Models\UrgenciaReferenciaParametro;
use App\Models\ModalidadConsentimiento;
use App\Models\OrigenReferencia;
use App\Models\NoAceptaReferenciaRazon;
use App\Models\SeguimientoDetalle;
use App\Models\SeguimientoPaso;


class ReferenciaParticipanteUpdateSeeder extends Seeder{

    public function run(): void
    {
        //$paises = [4,6,7,8];

        $paises = Pais::whereNotIn('id', [1, 2, 3])
            ->pluck('id')
            ->toArray();

        ////// TipoDiscapacidadSeeder
        $values = [
            'Auditiva',
            'Cognitiva o Intelectual',
            'Fisica',
            'Visual',
        ];

        foreach ($values as $value) {
            $model = TipoDiscapacidad::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }


        //// OtraCondicionSeeder

        $values = [
            'No sabe leer o escribir',
            'Habla otro idoma distinto al predominante en el país',
            'Necesidades básicas insatisfechas',
            'Condiciones médicas particulares',
            'Embarazo',
            'Otros',
        ];

        foreach ($values as $value) {
            $model = OtraCondicion::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }

        //// AccionInmediataSeeder

        $values = [
            'Ninguna',
            'Gestión de albergue o resguardo de emergencia',
            'Gestión de transporte',
            'Gestión de alimentos',
            'Gestión de medicamentos',
            'Asistencia económica',
            'Primeros Auxilios Psicológicos',
            'Protocolo SanaMente',
            'Atención médica de emergencia',
            'Otras'
        ];


        foreach ($values as $value) {
            $model = AccionInmediata::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }

        //// TipoViolenciaSeeder

        $values = [
            'Violencia física',
            'Violencia económica de pareja',
            'Violencia emocional/Psicológica de pareja o tutelar',
            'Violencia basada en género',
            'Extorsión',
            'Secuestro',
            'Reclutamiento forzado',
            'Abuso sexual',
            'Explotación laboral infantil',
            'No sabe/No desea responder',
        ];

        foreach ($values as $value) {
            $model = TipoViolencia::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }
        
        //// MotivoReferenciaSeeder

        $values = [
            'Sobreviviente de violencia',
            'Discriminación',
            'Amenazas a sí misma o personas cercanas',
            'Condición médica',
            'Riesgo suicida',
            'Dificultades educativas',
            'Desplazamiento forzado',
            'Reinserción laboral',
            'Condiciones de Salud Mental',
            'Asesoramiento especializado',
            'Otros',
        ];

        foreach ($values as $value) {
            $model = MotivoReferencia::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }

        //// TipoServicioSeeder

        $values = [
            'Servicios de educación',
            'Servicios de formación superior/complementaria',
            'Servicios de salud mental',
            'Servicios médicos',
            'Servicios de recreación',
            'Servicios de acompañamiento a sobrevivencia de violencia',
            'Servicios de rehabilitación para adicciones a drogas, alcohol u otras sustancias',
            'Servicios migratorios',
            'Servicios legales y jurídicos',
            'Servicios de empleabilidad o intermediación laboral',
            'Servicios de asistencia técnica para emprendimientos y medios de vida',
            'Escuelas Comunitarias (Glasswing)',
            'Programas de juventud (Glasswing)',
            'Programas de género (Glasswing)',
            'Programas de Salud Mental (SanaMente - Glasswing)',
            'Fondo de crisis/emergencia',
            'Otros (especifica):',
        ];

        foreach ($values as $value) {
            $model = TipoServicio::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }

        //// SaludMentalServicioSeeder

        $values = [
            'Atención psicológica',
            'Atención psiquiátrica',
            'Atención psicosocial',
        ];

        foreach ($values as $value) {
            $model = SaludMentalServicio::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }

        //// InstitucionReferenciaSeeder
        $values = [
            'Institucion 1',
            'Institucion 2',
            'Institucion 3',
            'Institucion 4',
            'Institucion 5',
            'Otra',
        ];

        foreach ($values as $value) {
            $model = InstitucionReferencia::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }

        //// UrgenciaReferenciaParametroSeeder

        $values = [
            'Máxima urgencia (máx 24 horas)',
            'Muy urgente (máx 3 días)',
            'Urgencia moderada (1-2 semanas)',
            'Urgencia leve (2-4 semanas)',
        ];

        foreach ($values as $value) {
            $model = UrgenciaReferenciaParametro::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }

        //// ModalidadConsentimientoSeeder

        $values = [
            'Registro de consentimiento físico',
            'Registro de consentimiento en Línea',
            'Registro de consentimiento verbal',
        ];

        foreach ($values as $value) {
            $model = ModalidadConsentimiento::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }

        //// OrigenReferenciaSeeder
        $values = [
            'Referencia por alguien del staff Glasswing',
            'Referencia por parte de una sede socia de Glasswing',
            'Contacto directo de un participante o miembro de la comunidad al equipo de Redes',
        ];

        foreach ($values as $value) {
            $model = OrigenReferencia::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }

        //// NoAceptaReferenciaRazonSeeder

        $values = [
            'La persona no posee interés por recibir el servicio',
            'La persona ya se encuentra recibiendo apoyo por otro medio',
            'La persona posee dificultad para transportarse y recibir el servicio',
            'La persona no responde llamadas o mensajes',
            'La persona no posee disponibilidad de tiempo para asistir al servicio',
            'La persona posee dificultades de salud o responsabilidades adicionales que imposibilitan acceder al servicio',
        ];

        foreach ($values as $value) {
            $model = NoAceptaReferenciaRazon::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }

        //// SeguimientoDetalleSeeder

        $values = [
            'En esta sesión se le comunica a la persona el horario y fecha de su cita',
            'La institución aún no ha confirmado la cita de la persona referida',
            'La institución no acepto la referencia y por tanto no atendió a la persona',
            'La persona no asistió al servicio en la fecha y hora estipulada',
            'La institución cambió la cita de atención sin previo aviso',
            'La institución acepta la referencia pero hay lista de espera',
            'Los horarios que brinda la institución no se acoplan a la disponibilidad del participante',
            'La persona desiste del proceso de referencia',
            'Otro',
        ];

        foreach ($values as $value) {
            $model = SeguimientoDetalle::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }

        //// SeguimientoPasoSeeder
        $values = [
            'Redirigir a una nueva institución para que atienda la referencia',
            'Reagendar cita en la misma intitución',
            'En espera de asignación de cita por parte de la institución',
            'Cerrar caso'
        ];

        foreach ($values as $value) {
            $model = SeguimientoPaso::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach($paises);
        }
    }
}
