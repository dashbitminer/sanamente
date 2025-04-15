<?php

namespace App\Livewire\Inscripcion;

use App\Models\DepartamentoGWDATA;
use App\Models\MunicipioGWDATA;
use App\Models\EscuelaGWDATA;
use App\Models\GradoGWDATA;
use App\Models\SectionGWDATA;
use App\Models\JornadaGWDATA;
use App\Models\UltimoGradoGWDATA;
use App\Models\DiscapacidadGWDATA;
use App\Models\PersonalInstitucionalGWDATA;
use App\Models\TipoBeneficiarioGWDATA;
use App\Models\InstitucionOrganizacion;
use App\Models\SanamenteSubtiposGWDATA;
use App\Models\BeneficiariesSubtypesGWDATA;
use App\Models\CentroEducativoTipo;
use App\Models\CentroEducativoCargo;
use App\Models\CentroEducativoNivel;
use App\Models\CentroEducativoCiclo;
use Carbon\Carbon;

trait InscripcionDataTrait
{

    public function getDepartamentosPorSede(?array $sede_id)
    {
        if ($sede_id) {
            return EscuelaGWDATA::getUniqueStatesWithActiveSedesSchoolAndComponentsBySedeId(
                $this->pais->codigo,
                $sede_id
                )
                ->pluck('name', 'fkCodeState');
        }

        return EscuelaGWDATA::getUniqueStatesWithActiveSedesAndComponents($this->pais->codigo)
            ->pluck('name', 'fkCodeState');
    }

    public function setCiudad($departamento_id, ?array $sede_id = null)
    {
        if ($sede_id) {
            return EscuelaGWDATA::getUniqueMunicipalitiesWithActiveSedesSchoolAndComponentsBySede(
                $this->pais->codigo,
                $sede_id,
                $departamento_id
                )
                ->pluck('name', 'codeMunicipality');
        }

        return EscuelaGWDATA::getUniqueMunicipalitiesWithActiveSedesAndComponents(
            $this->pais->codigo,
            $departamento_id
            )
            ->pluck('name', 'codeMunicipality')
            ->sort();
    }

    public function getAllCiudad($departamento_id)
    {
        return MunicipioGWDATA::where('fkCodeState', $departamento_id)
            ->pluck('name', 'codeMunicipality')
            ->sort();
    }

    public function getSedesEscuelas($codigoMunicipio, ?array $sede_id = null)
    {
        if ($sede_id) {
            return EscuelaGWDATA::getActiveSedeSchoolsWithComponentAndAreaBySede(
                $this->pais->codigo,
                $sede_id,
                $codigoMunicipio
                )
                ->pluck('name', 'school_id');
        }

        return EscuelaGWDATA::getActiveSchoolsWithComponentAndArea(
            $this->pais->codigo,
            $codigoMunicipio
            )
            ->pluck('name', 'school_id');
    }

    public function getSanamenteSubtipos($id)
    {
        return SanamenteSubtiposGWDATA::where('active', 1)
            ->where('id_institucional', $id)
            ->orderBy('name', 'asc')
            ->pluck('name', 'id');
    }

    public function getSubtipos($id)
    {
        return BeneficiariesSubtypesGWDATA::where('active_at', '<>', null)
            ->where('institutional_person_id', $id)
            ->orderBy('name', 'asc')
            ->pluck('name', 'id');
    }

    public function isOtherPerfilIdentifica()
    {
        return $this->pais->nombre === 'México' || $this->pais->nombre === 'Colombia' || $this->pais->nombre === 'Panamá';
    }

    public function getData(): array
    {
        $data = [];

        $data['year'] = Carbon::now()->format('Y');

        $data['departamentos'] = DepartamentoGWDATA::where('fkCodeCountry', $this->pais->codigo)
            ->pluck('name', 'codeState')
            ->sort();


        $queryInstitucion = InstitucionOrganizacion::active()
            ->where('pais_id', $this->pais->id);

        if ($this->pais->nombre === 'El Salvador') {
            if ($this->form->isPnc) {
                $queryInstitucion = InstitucionOrganizacion::active()
                    ->where('pais_id', $this->pais->id)
                    ->whereLike('nombre', '%(PNC)')
                    ->orWhereLike('nombre', '%(CAM)');
            }
            else {
                $queryInstitucion->whereNotLike('nombre', '%(PNC)')
                    ->whereNotLike('nombre', '%(CAM)');
            }
        }

        $data['institucionOrganizaciones'] = $queryInstitucion->pluck('nombre', 'id');


        $data['grados'] = GradoGWDATA::where('orden', '>', 0)
            ->orderBy('orden')
            ->pluck('name', 'id');

        $data['gradoSecciones'] = SectionGWDATA::where('activo', 1)
            ->pluck('name', 'id');

        $data['gradoJornadas'] = JornadaGWDATA::pluck('name', 'id');

        $data['gradoAlcanzados'] = UltimoGradoGWDATA::pluck('name', 'id');

        $data['discapacidades'] = DiscapacidadGWDATA::where('name', '<>', 'Ninguna')
            ->pluck('name', 'id');


        $data['perfilInstitucionales'] = PersonalInstitucionalGWDATA::where('active_at', '<>', null)
            ->orderBy('name')
            ->pluck('name', 'id');

        // Solo muestra personal de la policia para el perfil de PNC
        if ($this->pais->nombre === 'El Salvador' && $this->form->isPnc) {
            $data['perfilInstitucionales'] = $data['perfilInstitucionales']->filter(function ($item, $key) {
                return str_contains($item, 'Personal de la Policía');
            });
        }

        $data['perfilIdentificas'] = TipoBeneficiarioGWDATA::where('id', 10)
            ->pluck('name', 'id');

        $data['centroEducativoJornadas'] = collect([1 => 'Matutina', 2 => 'Vespertina', 3 => 'Nocturna']);

        if ($this->pais->slug === 'honduras') {
            $data['centroEducativoTipos'] = CentroEducativoTipo::active()
                ->pluck('nombre', 'id');

            $data['centroEducativoCargos'] = CentroEducativoCargo::active()
                ->pluck('nombre', 'id');

            $data['centroEducativoNiveles'] = CentroEducativoNivel::active()
                ->pluck('nombre', 'id');

            $data['centroEducativoCiclos'] = CentroEducativoCiclo::active()
                ->pluck('nombre', 'id');

            $data['laboraDepartamento'] = DepartamentoGWDATA::where('fkCodeCountry', $this->pais->codigo)
                ->pluck('name', 'codeState')
                ->sort();
        }

        return $data;
    }

    public function getLabels(): array {
        $labels = [
            'honduras' => [
                'nacionalidad' => 'Hondureño(a)',
                'bienvenido' => '¡Hola! Te damos la bienvenida a la familia de Glasswing International. Es un agrado que quieras participar en nuestras actividades. A continuación, te presentamos un formulario de inscripción que debe ser llenado solamente una vez, sin importar que participes en uno o más clubes, formaciones, cafés comunitarios, entre otros impartidos por Glasswing Internacional. La información solicitada es para usos exclusivos de Glasswing, te aseguramos que tu información no será compartida con terceros sin tu autorización. Toda la información será guardada con estricta confidencialidad y nada de lo que compartas tendrá repercusiones sobre tu persona o tu participación en las actividades. Si tienes consultas sobre este formulario puedes hacerlas sin ningún problema a la persona líder de la actividad en cualquier momento.',
                'departamento' => 'Selecciona el departamento en el que resides:',
                'minicipio' => 'Selecciona el municipio en el que resides:',
                'dni' => 'Escribe el número de tu Documento Nacional de Identificación (DNI):',
                'departamento_escuela' => 'Selecciona el departamento donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el municipio donde se encuentra la escuela/sede a la que perteneces:',
                'autorizacion1' => 'Hacemos de su conocimiento que la información solicitada es utilizada para nuestros registros internos, en los cuales llevamos un seguimiento de las y los participantes. Los datos son guardados en una plataforma institucional de único acceso para personal de Glasswing International a cargo del monitoreo e implementación del programa. Para efectos de rendición de cuentas con donantes de nuestros programas y/o socios implementadores, se podrá compartir información de forma general sin detalles personales del registro de la persona participante.',
                'autorizacion2' => 'Por lo anterior, confirmo que he leído y se me ha informado el uso que se le dará a los datos compartidos en este formulario y reconozco que tengo el derecho de retirar mi autorización en cualquier momento si así lo estimo conveniente. De ser así, puedes enviar un correo a "info_hn@glasswing.org" retirando tu autorización para compartir datos.',
            ],
            'guatemala' => [
                'nacionalidad' => 'Guatemalteco(a)',
                'bienvenido' => '¡Hola! Te damos la bienvenida a la familia de Glasswing International. Es un agrado que quieras participar en nuestras actividades. A continuación, te presentamos un formulario de inscripción que debe ser llenado solamente una vez, sin importar que participes en uno o más clubes, formaciones, cafés comunitarios, entre otros impartidos por Glasswing Internacional. La información solicitada es para usos exclusivos de Glasswing, te aseguramos que tu información no será compartida con terceros sin tu autorización. Toda la información será guardada con estricta confidencialidad y nada de lo que compartas tendrá repercusiones sobre tu persona o tu participación en las actividades. Si tienes consultas sobre este formulario puedes hacerlas sin ningún problema a la persona líder de la actividad en cualquier momento.',
                'departamento' => 'Selecciona el departamento en el que resides:',
                'minicipio' => 'Selecciona el municipio en el que resides:',
                'dni' => 'Escribe el número de tu Documento Personal de Identificación (DPI):',
                'departamento_escuela' => 'Selecciona el departamento donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el municipio donde se encuentra la escuela/sede a la que perteneces:',
                'autorizacion1' => 'Hacemos de su conocimiento que la información solicitada es utilizada para nuestros registros internos, en los cuales llevamos un seguimiento de las y los participantes. Los datos son guardados en una plataforma institucional de único acceso para personal de Glasswing International a cargo del monitoreo e implementación del programa. Para efectos de rendición de cuentas con donantes de nuestros programas y/o socios implementadores, se podrá compartir información de forma general sin detalles personales del registro de la persona participante.',
                'autorizacion2' => 'Por lo anterior, confirmo que he leído y se me ha informado el uso que se le dará a los datos compartidos en este formulario y reconozco que tengo el derecho de retirar mi autorización en cualquier momento si así lo estimo conveniente. De ser así, puedes enviar un correo a "info_gt@glasswing.org" retirando tu autorización para compartir datos.',
            ],
            'el-salvador' => [
                'nacionalidad' => 'Salvadoreño(a)',
                'bienvenido' => '¡Hola! Te damos la bienvenida a la familia de Glasswing International. Es un agrado que quieras participar en nuestras actividades. A continuación, te presentamos un formulario de inscripción que debe ser llenado solamente una vez, sin importar que participes en uno o más clubes, formaciones, cafés comunitarios, entre otros impartidos por Glasswing Internacional. La información solicitada es para usos exclusivos de Glasswing, te aseguramos que tu información no será compartida con terceros sin tu autorización. Toda la información será guardada con estricta confidencialidad y nada de lo que compartas tendrá repercusiones sobre tu persona o tu participación en las actividades. Si tienes consultas sobre este formulario puedes hacerlas sin ningún problema a la persona líder de la actividad en cualquier momento.',
                'departamento' => 'Selecciona el departamento en el que resides:',
                'minicipio' => 'Selecciona el municipio en el que resides:',
                'dni' => 'Escribe el número de tu Documento Unico de Identidad (DUI):',
                'departamento_escuela' => 'Selecciona el departamento donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el municipio donde se encuentra la escuela/sede a la que perteneces:',
                'autorizacion1' => 'Hacemos de su conocimiento que la información solicitada es utilizada para nuestros registros internos, en los cuales llevamos un seguimiento de las y los participantes. Los datos son guardados en una plataforma institucional de único acceso para personal de Glasswing International a cargo del monitoreo e implementación del programa. Para efectos de rendición de cuentas con donantes de nuestros programas y/o socios implementadores, se podrá compartir información de forma general sin detalles personales del registro de la persona participante.',
                'autorizacion2' => 'Por lo anterior, confirmo que he leído y se me ha informado el uso que se le dará a los datos compartidos en este formulario y reconozco que tengo el derecho de retirar mi autorización en cualquier momento si así lo estimo conveniente. De ser así, puedes enviar un correo a "info_sv@glasswing.org" retirando tu autorización para compartir datos.',
            ],
            'mexico' => [
                'nacionalidad' => 'Mexicano(a)',
                'bienvenido' => '¡Hola! Te damos la bienvenida a la familia de Glasswing International. Es un agrado que quieras participar en nuestras actividades. A continuación, te presentamos un formulario de inscripción que debe ser llenado solamente una vez, sin importar que participes en uno o más clubes, formaciones, cafés comunitarios, entre otros impartidos por Glasswing Internacional. La información solicitada es para usos exclusivos de Glasswing, te aseguramos que tu información no será compartida con terceros sin tu autorización. Toda la información será guardada con estricta confidencialidad y nada de lo que compartas tendrá repercusiones sobre tu persona o tu participación en las actividades. Si tienes consultas sobre este formulario puedes hacerlas sin ningún problema a la persona líder de la actividad en cualquier momento.',
                'departamento' => 'Selecciona el estado en el que resides:',
                'minicipio' => 'Selecciona la alcaldía o municipio en el que resides:',
                'dni' => 'Escribe tu número de identificador (ID)- Tu ID se compone las primera 4 letras de tu CURP más la fecha de nacimiento aa/mm/dd:',
                'departamento_escuela' => 'Selecciona el estado donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el municipio donde se encuentra la escuela/sede a la que perteneces:',
                'autorizacion1' => 'Hacemos de su conocimiento que la información solicitada es utilizada para nuestros registros internos, en los cuales llevamos un seguimiento de las y los participantes. Los datos son guardados en una plataforma institucional de único acceso para personal de Glasswing International a cargo del monitoreo e implementación del programa. Para efectos de rendición de cuentas con donantes de nuestros programas y/o socios implementadores, se podrá compartir información de forma general sin detalles personales del registro de la persona participante.',
                'autorizacion2' => 'Por lo anterior, confirmo que he leído y se me ha informado el uso que se le dará a los datos compartidos en este formulario y reconozco que tengo el derecho de retirar mi autorización en cualquier momento si así lo estimo conveniente. De ser así, puedes enviar un correo a "info_me@glasswing.org" retirando tu autorización para compartir datos.',
            ],
            'panama' => [
                'nacionalidad' => 'Panameño(a)',
                'bienvenido' => '¡Hola! Te damos la bienvenida a la familia de Glasswing International.  Es un agrado que quieras participar en nuestras actividades. A continuación, te presentamos un formulario de inscripción que debe ser llenado solamente una vez, sin importar que participes en uno o más clubes, formaciones, cafés comunitarios, entre otros impartidos por Glasswing Internacional. La información solicitada es para usos exclusivos de Glasswing, te aseguramos que tu información no será compartida con terceros sin tu autorización. Toda la información será guardada con estricta confidencialidad y nada de lo que compartas tendrá repercusiones sobre tu persona o tu participación en las actividades. Si tienes consultas sobre este formulario puedes hacerlas sin ningún problema a la persona líder de la actividad en cualquier momento.',
                'departamento' => 'Selecciona la provincia en la que resides:',
                'minicipio' => 'Selecciona el distrito en el que resides:',
                'dni' => 'Escribe tu Cédula de Identidad Personal (CIP):',
                'departamento_escuela' => 'Selecciona la provincia donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el distrito donde se encuentra la escuela/sede a la que perteneces:',
                'autorizacion1' => 'Hacemos de su conocimiento que la información solicitada es utilizada para nuestros registros internos, en los cuales llevamos un seguimiento de las y los participantes. Los datos son guardados en una plataforma institucional de único acceso para personal de Glasswing International a cargo del monitoreo e implementación del programa. Para efectos de rendición de cuentas con donantes de nuestros programas y/o socios implementadores, se podrá compartir información de forma general sin detalles personales del registro de la persona participante.',
                'autorizacion2' => 'Por lo anterior, confirmo que he leído y se me ha informado el uso que se le dará a los datos compartidos en este formulario y reconozco que tengo el derecho de retirar mi autorización en cualquier momento si así lo estimo conveniente. De ser así, puedes enviar un correo a "info_pa@glasswing.org" retirando tu autorización para compartir datos.',
            ],
            'costa-rica' => [
                'nacionalidad' => 'Costarriqueño(a)',
                'bienvenido' => '¡Hola! Te damos la bienvenida a la familia de Glasswing International. Es un agrado que quieras participar en nuestras actividades. A continuación, te presentamos un formulario de inscripción que debe ser llenado solamente una vez, sin importar que participes en uno o más clubes, formaciones, cafés comunitarios, entre otros impartidos por Glasswing Internacional. La información solicitada es para usos exclusivos de Glasswing, te aseguramos que tu información no será compartida con terceros sin tu autorización. Toda la información será guardada con estricta confidencialidad y nada de lo que compartas tendrá repercusiones sobre tu persona o tu participación en las actividades. Si tienes consultas sobre este formulario puedes hacerlas sin ningún problema a la persona líder de la actividad en cualquier momento.',
                'departamento' => 'Selecciona la provincia en la que resides:',
                'minicipio' => 'Selecciona el distrito en el que resides:',
                'dni' => 'Escribe el número de tu Cédula de Identidad:',
                'departamento_escuela' => 'Selecciona la provincia donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el distrito donde se encuentra la escuela/sede a la que perteneces:',
                'autorizacion1' => 'Hacemos de su conocimiento que la información solicitada es utilizada para nuestros registros internos, en los cuales llevamos un seguimiento de las y los participantes. Los datos son guardados en una plataforma institucional de único acceso para personal de Glasswing International a cargo del monitoreo e implementación del programa. Para efectos de rendición de cuentas con donantes de nuestros programas y/o socios implementadores, se podrá compartir información de forma general sin detalles personales del registro de la persona participante.',
                'autorizacion2' => 'Por lo anterior, confirmo que he leído y se me ha informado el uso que se le dará a los datos compartidos en este formulario y reconozco que tengo el derecho de retirar mi autorización en cualquier momento si así lo estimo conveniente. De ser así, puedes enviar un correo a "info_cr@glasswing.org" retirando tu autorización para compartir datos.',
            ],
            'colombia' => [
                'nacionalidad' => 'Colombiano(a)',
                'bienvenido' => '¡Hola! Te damos la bienvenida a la familia de Glasswing International.  Es un agrado que quieras participar en nuestras actividades. A continuación, te presentamos un formulario de inscripción que debe ser llenado solamente una vez, sin importar que participes en uno o más clubes, formaciones, cafés comunitarios, entre otros impartidos por Glasswing Internacional. La información solicitada es para usos exclusivos de Glasswing, te aseguramos que tu información no será compartida con terceros sin tu autorización. Toda la información será guardada con estricta confidencialidad y nada de lo que compartas tendrá repercusiones sobre tu persona o tu participación en las actividades. Si tienes consultas sobre este formulario puedes hacerlas sin ningún problema a la persona líder de la actividad en cualquier momento.',
                'departamento' => 'Selecciona el departamento en el que resides:',
                'minicipio' => 'Selecciona el municipio en el que resides:',
                'dni' => 'Escribe tu Número de documento de identidad:',
                'departamento_escuela' => 'Selecciona el departamento donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el municipio donde se encuentra la escuela/sede a la que perteneces:',
                'autorizacion1' => 'Hacemos de su conocimiento que la información solicitada es utilizada para nuestros registros internos, en los cuales llevamos un seguimiento de las y los participantes. Los datos son guardados en una plataforma institucional de único acceso para personal de Glasswing International a cargo del monitoreo e implementación del programa. Para efectos de rendición de cuentas con donantes de nuestros programas y/o socios implementadores, se podrá compartir información de forma general sin detalles personales del registro de la persona participante.',
                'autorizacion2' => 'Por lo anterior, confirmo que he leído y se me ha informado el uso que se le dará a los datos compartidos en este formulario y reconozco que tengo el derecho de retirar mi autorización en cualquier momento si así lo estimo conveniente. De ser así, puedes enviar un correo a "info_co@glasswing.org" retirando tu autorización para compartir datos.',
            ],
        ];

        return $labels[$this->pais->slug];
    }



}
