<?php

namespace App\Livewire\ClubNNA\Traits;

trait LabelsTrait
{
    public function getLabels(): array { 
        $labels = [
            'honduras' => [
                'nacionalidad' => 'Hondureño(a)',
                'bienvenido' => 'Reciba un cordial saludo de Fundación Crisálida Internacional/Glasswing International (en adelante Glasswing). El presente formulario tiene la finalidad de solicitar su autorización para que la niña o adolescente (en adelante NNA) bajo su patria potestad o tutela pueda participar en el programa Club de Niñas que desarrollamos en el centro educativo o sede al cual asiste. Todas las actividades son realizadas dentro del centro educativo o sede, en los días entre lunes y sábado, en horarios que son acordados con la administración de la sede, por lo que la niña no requiere movilizarse hacia otro lugar. En caso de que se realicen actividades fuera del centro educativo sede, le solicitaremos una autorización especial para la actividad y traslado de la NNA. La oferta de actividades dentro del programa incluye áreas como: bienestar integral y emocional, relación con el entorno, relaciones saludables, salud sexual y reproductiva, toma de decisiones y proyecto de vida, entre otras. Glasswing es responsable del uso y protección de sus datos personales. A continuación, se detalla la información sobre las autorizaciones solicitadas:',
                'autorizacion' => 'Solicitamos permiso para tomar fotos y videos en grupo o individuales, siguiendo reglas importantes que protegen tus derechos, tomando de referencia el artículo 16 de la Convención sobre los Derechos de las Niñas y Niños y el artículo 11 del Código de la niñez y adolescencia y artículo 32 del decreto 35-2013.  Esta autorización incluye:',
                'email' => 'info_hn@glasswing.org',
                'departamento_label' => 'Departamento',
                'departamento' => 'Selecciona el departamento en el que resides:',
                'minicipio' => 'Selecciona el municipio en el que resides:',
                'dni_label' => 'Escribe el número de Documento Unico de Identidad (DNI):',
                'dni' => 'Documento Unico de Identidad (DNI)',
                'departamento_escuela' => 'Selecciona el departamento donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el municipio donde se encuentra la escuela/sede a la que perteneces:',
            ],
            'guatemala' => [
                'nacionalidad' => 'Guatemalteco(a)',
                'bienvenido' => 'Reciba un cordial saludo de Fundación Crisálida Internacional/Glasswing International (en adelante Glasswing). El presente formulario tiene la finalidad de solicitar su autorización para que la niña o adolescente (en adelante NNA) bajo su patria potestad o tutela pueda participar en el programa Club de Niñas que desarrollamos en el centro educativo o sede al cual asiste. Todas las actividades son realizadas dentro del centro educativo o sede, en los días entre lunes y sábado, en horarios que son acordados con la administración de la sede, por lo que la niña no requiere movilizarse hacia otro lugar. En caso de que se realicen actividades fuera del centro educativo sede, le solicitaremos una autorización especial para la actividad y traslado de la NNA. La oferta de actividades dentro del programa incluye áreas como: bienestar integral y emocional, relación con el entorno, relaciones saludables, salud sexual y reproductiva, toma de decisiones y proyecto de vida, entre otras. Glasswing es responsable del uso y protección de sus datos personales. A continuación, se detalla la información sobre las autorizaciones solicitadas:',
                'autorizacion' => 'Solicitamos permiso para tomar fotos y videos en grupo o individuales, siguiendo reglas importantes que protegen tus derechos, tomando de referencia el artículo 16 de la Convención sobre los Derechos de las Niñas y Niños y el artículo 59 de la Ley de Protección Integral de la Niñez y Adolescencia. Esta autorización incluye:',
                'email' => 'info_gt@glasswing.org',
                'departamento_label' => 'Departamento',
                'departamento' => 'Selecciona el departamento en el que resides:',
                'minicipio' => 'Selecciona el municipio en el que resides:',
                'dni_label' => 'Escribe el número de Documento Personal de Identificación (DPI):',
                'dni' => 'Documento Personal de Identificación (DPI)',
                'departamento_escuela' => 'Selecciona el departamento donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el municipio donde se encuentra la escuela/sede a la que perteneces:',
            ],
            'el-salvador' => [
                'nacionalidad' => 'Salvadoreño(a)',
                'bienvenido' => 'Reciba un cordial saludo de Fundación Crisálida Internacional/Glasswing International (en adelante Glasswing). El presente formulario tiene la finalidad de solicitar su autorización para que la niña o adolescente (en adelante NNA) bajo su patria potestad o tutela pueda participar en el programa Club de Niñas que desarrollamos en el centro educativo o sede al cual asiste. Todas las actividades son realizadas dentro del centro educativo o sede, en los días entre lunes y sábado, en horarios que son acordados con la administración de la sede, por lo que la niña no requiere movilizarse hacia otro lugar. En caso de que se realicen actividades fuera del centro educativo sede, le solicitaremos una autorización especial para la actividad y traslado de la NNA. La oferta de actividades dentro del programa incluye áreas como: bienestar integral y emocional, relación con el entorno, relaciones saludables, toma de decisiones y proyecto de vida, entre otras. Glasswing es responsable del uso y protección de sus datos personales. A continuación, se detalla la información sobre las autorizaciones solicitadas:',
                'autorizacion' => 'Solicitamos permiso para tomar fotos y videos en grupo o individuales, siguiendo reglas importantes que protegen tus derechos, tomando de referencia el artículo 16 de la Convención sobre los Derechos de los Niños y Niñas y el artículo 26 de la Ley No. 136-03 Código para el Sistema de Protección y los Derechos Fundamentales de Niños, Niñas y Adolescentes y el artículo 79 de la Ley 65-2000 Ley del Derecho de Autor y Derechos Conexos. Esta autorización incluye:',
                'email' => 'info_sv@glasswing.org',
                'departamento_label' => 'Departamento',
                'departamento' => 'Selecciona el departamento en el que resides:',
                'minicipio' => 'Selecciona el municipio en el que resides:',
                'dni_label' => 'Escribe el número de Documento Unico de Identidad (DUI):',
                'dni' => 'Documento Unico de Identidad (DUI)',
                'departamento_escuela' => 'Selecciona el departamento donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el municipio donde se encuentra la escuela/sede a la que perteneces:',
            ],
            'mexico' => [
                'nacionalidad' => 'Mexicano(a)',
                'bienvenido' => 'Reciba un cordial saludo de Fundación Crisálida Internacional/Glasswing International (en adelante Glasswing). El presente formulario tiene la finalidad de solicitar su autorización para que la niña o adolescente (en adelante NNA) bajo su patria potestad o tutela pueda participar en el programa Club de Niñas que desarrollamos en el centro educativo o sede al cual asiste. Todas las actividades son realizadas dentro del centro educativo o sede, en los días entre lunes y sábado, en horarios que son acordados con la administración de la sede, por lo que la niña no requiere movilizarse hacia otro lugar. En caso de que se realicen actividades fuera del centro educativo sede, le solicitaremos una autorización especial para la actividad y traslado de la NNA. La oferta de actividades dentro del programa incluye áreas como: bienestar integral y emocional, relación con el entorno, relaciones saludables, salud sexual y reproductiva, toma de decisiones y proyecto de vida, entre otras. Glasswing es responsable del uso y protección de sus datos personales. A continuación, se detalla la información sobre las autorizaciones solicitadas:',
                'autorizacion' => 'Solicitamos permiso para tomar fotos y videos en grupo o individuales, siguiendo reglas importantes que protegen tus derechos, tomando de referencia el artículo 16 de la Convención sobre los Derechos de las Niñas y Niños, el artículo 87 de la Ley Federal del Derecho de Autor, los artículos 64, 71, 76 y 77 de la Ley General de los Derechos de Niñas, Niños y Adolescentes, los artículos 6, 7, 8, 9, 15, 16, 17 y demás relativos y aplicables de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, así como lo dispuesto por los artículos 16, 17, 18 y 19 de la Ley de Responsabilidad Civil Esta autorización incluye:',
                'email' => 'info_mx@glasswing.org',
                'departamento_label' => 'Estado',
                'departamento' => 'Selecciona el estado en el que resides:',
                'minicipio' => 'Selecciona el municipio en el que resides:',
                'dni_label' => 'Escribe la Clave Única de Registro de Población (CURP):',
                'dni' => 'Clave Única de Registro de Población (CURP)',
                'departamento_escuela' => 'Selecciona el estado donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el municipio donde se encuentra la escuela/sede a la que perteneces:',
            ],
            'panama' => [
                'nacionalidad' => 'Panameño(a)',
                'bienvenido' => 'Reciba un cordial saludo de Fundación Crisálida Internacional/Glasswing International (en adelante Glasswing). El presente formulario tiene la finalidad de solicitar su autorización para que la niña o adolescente (en adelante NNA) bajo su patria potestad o tutela pueda participar en el programa Club de Niñas que desarrollamos en el centro educativo o sede al cual asiste. Todas las actividades son realizadas dentro del centro educativo o sede, en los días entre lunes y sábado, en horarios que son acordados con la administración de la sede, por lo que la niña no requiere movilizarse hacia otro lugar. En caso de que se realicen actividades fuera del centro educativo sede, le solicitaremos una autorización especial para la actividad y traslado de la NNA. La oferta de actividades dentro del programa incluye áreas como: bienestar integral y emocional, relación con el entorno, relaciones saludables, salud sexual y reproductiva, toma de decisiones y proyecto de vida, entre otras. Glasswing es responsable del uso y protección de sus datos personales. A continuación, se detalla la información sobre las autorizaciones solicitadas:',
                'autorizacion' => 'Solicitamos permiso para tomar fotos y videos en grupo o individuales, siguiendo reglas importantes que protegen tus derechos, tomando de referencia el artículo 16 de la Convención sobre los Derechos de las Niñas y Niños y el artículo 577 de la Ley 3 del Código de Familia en la República de Panamá. Esta autorización incluye:',
                'email' => 'info_pa@glasswing.org',
                'departamento_label' => 'Provincia',
                'departamento' => 'Selecciona la provincia en la que resides:',
                'minicipio' => 'Selecciona el distrito en el que resides:',
                'dni_label' => 'Escribe la Cédula de Identidad Personal (CIP):',
                'dni' => 'Cédula de Identidad Personal (CIP)',
                'departamento_escuela' => 'Selecciona la provincia donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el distrito donde se encuentra la escuela/sede a la que perteneces:',
            ],
            'costa-rica' => [
                'nacionalidad' => 'Costarriqueño(a)',
                'bienvenido' => 'Reciba un cordial saludo de Fundación Crisálida Internacional/Glasswing International (en adelante Glasswing). El presente formulario tiene la finalidad de solicitar su autorización para que la niña o adolescente (en adelante NNA) bajo su patria potestad o tutela pueda participar en el programa Club de Niñas que desarrollamos en el centro educativo o sede al cual asiste. Todas las actividades son realizadas dentro del centro educativo o sede, en los días entre lunes y sábado, en horarios que son acordados con la administración de la sede, por lo que la niña no requiere movilizarse hacia otro lugar. En caso de que se realicen actividades fuera del centro educativo sede, le solicitaremos una autorización especial para la actividad y traslado de la NNA. La oferta de actividades dentro del programa incluye áreas como: bienestar integral y emocional, relación con el entorno, relaciones saludables, salud sexual y reproductiva, toma de decisiones y proyecto de vida, entre otras. Glasswing es responsable del uso y protección de sus datos personales. A continuación, se detalla la información sobre las autorizaciones solicitadas:',
                'autorizacion'=>'Solicitamos permiso para tomar fotos y videos en grupo o individuales, siguiendo reglas importantes que protegen tus derechos, tomando de referencia el artículo 16 de la Convención sobre los Derechos de las Niñas y Niños y el artículo 1 de la Ley de protección de la imagen, la voz y los datos personales de las personas menores de edad. Esta autorización incluye:',
                'email' => 'info_cr@glasswing.org',
                'departamento_label' => 'Provincia',
                'departamento' => 'Selecciona la provincia en la que resides:',
                'minicipio' => 'Selecciona el distrito en el que resides:',
                'dni_label' => 'Escribe el número de Cédula de Identidad:',
                'dni' => 'Cédula de Identidad',
                'departamento_escuela' => 'Selecciona la provincia donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el distrito donde se encuentra la escuela/sede a la que perteneces:',
            ],
            'colombia' => [
                'nacionalidad' => 'Colombiano(a)',
                'bienvenido' => 'Reciba un cordial saludo de Fundación Crisálida Internacional/Glasswing International (en adelante Glasswing). El presente formulario tiene la finalidad de solicitar su autorización para que la niña o adolescente (en adelante NNA) bajo su patria potestad o tutela pueda participar en el programa Club de Niñas que desarrollamos en el centro educativo o sede al cual asiste. Todas las actividades son realizadas dentro del centro educativo o sede, en los días entre lunes y sábado, en horarios que son acordados con la administración de la sede, por lo que la niña no requiere movilizarse hacia otro lugar. En caso de que se realicen actividades fuera del centro educativo sede, le solicitaremos una autorización especial para la actividad y traslado de la NNA. La oferta de actividades dentro del programa incluye áreas como: bienestar integral y emocional, relación con el entorno, relaciones saludables, salud sexual y reproductiva, toma de decisiones y proyecto de vida, entre otras. Glasswing es responsable del uso y protección de sus datos personales. A continuación, se detalla la información sobre las autorizaciones solicitadas:',
                'autorizacion' => 'Solicitamos permiso para tomar fotos y videos en grupo o individuales, siguiendo reglas importantes que protegen tus derechos, tomando de referencia el artículo 16 de la Convención sobre los Derechos de las Niñas y Niños y el artículo 12 del Decreto 1377 del 2013. Esta autorización incluye:',
                'email' => 'info_co@glasswing.org',
                'departamento_label' => 'Departamento',
                'departamento' => 'Selecciona el departamento en el que resides:',
                'minicipio' => 'Selecciona el municipio en el que resides:',
                'dni_label' => 'Escribe el número de Cédula de Ciudadanía:',
                'dni' => 'Cédula de Ciudadanía',
                'departamento_escuela' => 'Selecciona el departamento donde se encuentra la escuela/sede a la que perteneces:',
                'minicipio_escuela' => 'Selecciona el departamento donde se encuentra la escuela/sede a la que perteneces:',
            ]
        ];

        return $labels[$this->pais->slug];
    }
}