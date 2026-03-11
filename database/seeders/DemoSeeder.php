<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use App\Models\Doctor;
use App\Models\Servicio;
use App\Models\Testimonio;
use App\Models\Categoria;
use App\Models\Articulo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Especialidades ───────────────────────────────────────────
        $especialidades = [
            ['nombre' => 'Cardiología',       'slug' => 'cardiologia',       'icono' => 'heroicon-o-heart',          'descripcion' => 'Diagnóstico y tratamiento de enfermedades del corazón y sistema cardiovascular.'],
            ['nombre' => 'Pediatría',          'slug' => 'pediatria',         'icono' => 'heroicon-o-face-smile',     'descripcion' => 'Atención médica integral para niños desde el nacimiento hasta los 18 años.'],
            ['nombre' => 'Dermatología',       'slug' => 'dermatologia',      'icono' => 'heroicon-o-sparkles',       'descripcion' => 'Tratamiento de enfermedades de la piel, cabello y uñas.'],
            ['nombre' => 'Neurología',         'slug' => 'neurologia',        'icono' => 'heroicon-o-bolt',           'descripcion' => 'Diagnóstico y tratamiento de trastornos del sistema nervioso.'],
            ['nombre' => 'Traumatología',      'slug' => 'traumatologia',     'icono' => 'heroicon-o-wrench-screwdriver', 'descripcion' => 'Tratamiento de lesiones y enfermedades del aparato locomotor.'],
            ['nombre' => 'Medicina General',   'slug' => 'medicina-general',  'icono' => 'heroicon-o-user',           'descripcion' => 'Atención primaria y preventiva para toda la familia.'],
        ];

        foreach ($especialidades as $data) {
            Especialidad::firstOrCreate(['slug' => $data['slug']], array_merge($data, ['activo' => true]));
        }

        // ─── Doctores ─────────────────────────────────────────────────
        $doctores = [
            [
                'nombre'          => 'Carlos',
                'apellido'        => 'Mendoza Ríos',
                'especialidad_id' => 1, // Cardiología
                'cmp'             => 'CMP-045123',
                'dni'             => '45123678',
                'telefono'        => '+51 999 111 222',
                'email'           => 'carlos.mendoza@clinica.demo',
                'biografia'       => 'El Dr. Carlos Mendoza cuenta con más de 15 años de experiencia en cardiología intervencionista. Realizó su especialización en el Hospital Rebagliati y tiene una maestría en cardiología avanzada por la UNMSM. Ha atendido más de 3,000 pacientes con enfermedades cardiovasculares complejas.',
                'activo'          => true,
            ],
            [
                'nombre'          => 'Ana',
                'apellido'        => 'Rodríguez Torres',
                'especialidad_id' => 2, // Pediatría
                'cmp'             => 'CMP-038765',
                'dni'             => '38765412',
                'telefono'        => '+51 999 333 444',
                'email'           => 'ana.rodriguez@clinica.demo',
                'biografia'       => 'La Dra. Ana Rodríguez es pediatra con 12 años de experiencia. Especialista en neonatología y desarrollo infantil. Formada en el Instituto Nacional de Salud del Niño, es conocida por su trato cálido y su dedicación a los pequeños pacientes y sus familias.',
                'activo'          => true,
            ],
            [
                'nombre'          => 'Roberto',
                'apellido'        => 'Vega Castillo',
                'especialidad_id' => 3, // Dermatología
                'cmp'             => 'CMP-052341',
                'dni'             => '52341890',
                'telefono'        => '+51 999 555 666',
                'email'           => 'roberto.vega@clinica.demo',
                'biografia'       => 'El Dr. Roberto Vega es dermatólogo certificado con subespecialidad en dermatología cosmética y oncológica. Con 10 años de experiencia, es pionero en tratamientos láser y procedimientos estéticos mínimamente invasivos en la región.',
                'activo'          => true,
            ],
            [
                'nombre'          => 'María',
                'apellido'        => 'Flores Huanca',
                'especialidad_id' => 4, // Neurología
                'cmp'             => 'CMP-041987',
                'dni'             => '41987230',
                'telefono'        => '+51 999 777 888',
                'email'           => 'maria.flores@clinica.demo',
                'biografia'       => 'La Dra. María Flores es neuróloga con especialización en epilepsia y cefaleas. Egresada de la Universidad Peruana Cayetano Heredia, cuenta con 8 años de experiencia clínica y ha publicado investigaciones en revistas médicas internacionales.',
                'activo'          => true,
            ],
        ];

        foreach ($doctores as $data) {
            Doctor::firstOrCreate(['email' => $data['email']], $data);
        }

        // ─── Servicios ────────────────────────────────────────────────
        $servicios = [
            ['nombre' => 'Consulta Cardiológica',        'slug' => 'consulta-cardiologica',       'especialidad_id' => 1, 'precio' => 150.00, 'duracion_minutos' => 45, 'descripcion' => 'Evaluación completa del sistema cardiovascular con electrocardiograma incluido.'],
            ['nombre' => 'Ecocardiograma',               'slug' => 'ecocardiograma',              'especialidad_id' => 1, 'precio' => 250.00, 'duracion_minutos' => 60, 'descripcion' => 'Ultrasonido del corazón para evaluar su estructura y funcionamiento.'],
            ['nombre' => 'Control Pediátrico',           'slug' => 'control-pediatrico',          'especialidad_id' => 2, 'precio' => 80.00,  'duracion_minutos' => 30, 'descripcion' => 'Control de crecimiento y desarrollo para niños de 0 a 18 años.'],
            ['nombre' => 'Vacunación Infantil',          'slug' => 'vacunacion-infantil',         'especialidad_id' => 2, 'precio' => 60.00,  'duracion_minutos' => 20, 'descripcion' => 'Aplicación del esquema de vacunas según calendario nacional.'],
            ['nombre' => 'Consulta Dermatológica',       'slug' => 'consulta-dermatologica',      'especialidad_id' => 3, 'precio' => 120.00, 'duracion_minutos' => 40, 'descripcion' => 'Diagnóstico y tratamiento de afecciones de piel, cabello y uñas.'],
            ['nombre' => 'Tratamiento Láser',            'slug' => 'tratamiento-laser',           'especialidad_id' => 3, 'precio' => 350.00, 'duracion_minutos' => 60, 'descripcion' => 'Tratamiento láser para manchas, cicatrices y rejuvenecimiento cutáneo.'],
            ['nombre' => 'Consulta Neurológica',         'slug' => 'consulta-neurologica',        'especialidad_id' => 4, 'precio' => 180.00, 'duracion_minutos' => 50, 'descripcion' => 'Evaluación del sistema nervioso central y periférico.'],
            ['nombre' => 'Consulta Medicina General',    'slug' => 'consulta-medicina-general',   'especialidad_id' => 6, 'precio' => 60.00,  'duracion_minutos' => 30, 'descripcion' => 'Atención médica general para adultos y diagnóstico de enfermedades comunes.'],
        ];

        foreach ($servicios as $data) {
            Servicio::firstOrCreate(['slug' => $data['slug']], array_merge($data, ['activo' => true]));
        }

        // ─── Testimonios ──────────────────────────────────────────────
        $testimonios = [
            ['nombre' => 'Patricia Gómez',    'estrellas' => 5, 'servicio' => 'Cardiología',    'aprobado' => true, 'destacado' => true,  'comentario' => 'El Dr. Mendoza es un excelente profesional. Me explicó todo con mucha claridad y paciencia. Gracias a su diagnóstico oportuno pude tratar mi arritmia a tiempo. 100% recomendado.'],
            ['nombre' => 'Jorge Ramírez',     'estrellas' => 5, 'servicio' => 'Pediatría',      'aprobado' => true, 'destacado' => true,  'comentario' => 'La Dra. Ana Rodríguez es maravillosa con los niños. Mi hijo llegaba llorando al médico y ahora pide ir a verla. Su trato es increíblemente cálido y profesional.'],
            ['nombre' => 'Lucía Fernández',   'estrellas' => 5, 'servicio' => 'Dermatología',   'aprobado' => true, 'destacado' => true,  'comentario' => 'Después de años sufriendo de acné, el Dr. Vega encontró el tratamiento correcto en mi primera consulta. En tres meses mi piel cambió completamente. Estoy muy agradecida.'],
            ['nombre' => 'Miguel Torres',     'estrellas' => 4, 'servicio' => 'Medicina General','aprobado' => true, 'destacado' => false, 'comentario' => 'Muy buena atención, el personal administrativo es amable y los tiempos de espera son razonables. Las instalaciones están muy limpias y bien equipadas.'],
            ['nombre' => 'Carmen Huerta',     'estrellas' => 5, 'servicio' => 'Neurología',     'aprobado' => true, 'destacado' => true,  'comentario' => 'La Dra. Flores me diagnosticó migraña crónica cuando otros médicos no sabían qué tenía. Con su tratamiento mis dolores de cabeza bajaron un 90%. Es una especialista excepcional.'],
            ['nombre' => 'David Morales',     'estrellas' => 5, 'servicio' => 'Cardiología',    'aprobado' => true, 'destacado' => false, 'comentario' => 'Llegué con mucho miedo por unos dolores en el pecho. El Dr. Mendoza me hizo todos los estudios y me tranquilizó con su diagnóstico detallado. Excelente clínica.'],
            ['nombre' => 'Rosa Quispe',       'estrellas' => 4, 'servicio' => 'Pediatría',      'aprobado' => true, 'destacado' => false, 'comentario' => 'Traje a mis dos hijos gemelos y los atendieron perfectamente. La Dra. Rodríguez tiene mucha paciencia y conocimiento. El consultorio es muy cómodo para los niños.'],
            ['nombre' => 'Fernando Castro',   'estrellas' => 5, 'servicio' => 'Dermatología',   'aprobado' => true, 'destacado' => true,  'comentario' => 'Me hice el tratamiento láser para unas manchas solares y quedé impresionado con los resultados. El Dr. Vega es muy profesional y el equipo que usan es de última tecnología.'],
        ];

        foreach ($testimonios as $data) {
            Testimonio::firstOrCreate(['nombre' => $data['nombre']], $data);
        }

        // ─── Categorías del Blog ──────────────────────────────────────
        $categorias = [
            ['nombre' => 'Salud Cardiovascular', 'slug' => 'salud-cardiovascular', 'color' => '#ef4444', 'descripcion' => 'Artículos sobre el cuidado del corazón y la salud cardiovascular.'],
            ['nombre' => 'Salud Infantil',        'slug' => 'salud-infantil',        'color' => '#3b82f6', 'descripcion' => 'Consejos de salud y bienestar para niños y adolescentes.'],
            ['nombre' => 'Cuidado de la Piel',    'slug' => 'cuidado-de-la-piel',    'color' => '#a855f7', 'descripcion' => 'Tips y tratamientos para mantener una piel saludable.'],
            ['nombre' => 'Vida Saludable',        'slug' => 'vida-saludable',        'color' => '#22c55e', 'descripcion' => 'Hábitos, alimentación y ejercicio para una vida plena.'],
            ['nombre' => 'Noticias Médicas',      'slug' => 'noticias-medicas',      'color' => '#f59e0b', 'descripcion' => 'Novedades y avances en el mundo de la medicina.'],
        ];

        foreach ($categorias as $data) {
            Categoria::firstOrCreate(['slug' => $data['slug']], $data);
        }

        // ─── Artículos del Blog ───────────────────────────────────────
        $articulos = [
            [
                'titulo'            => '5 hábitos que cuidan tu corazón todos los días',
                'slug'              => '5-habitos-que-cuidan-tu-corazon',
                'categoria_id'      => 1,
                'extracto'          => 'Tu corazón trabaja las 24 horas del día. Descubre qué pequeños cambios en tu rutina pueden marcar una gran diferencia en tu salud cardiovascular.',
                'contenido'         => "## Tu corazón nunca descansa\n\nEl corazón es el músculo más trabajador del cuerpo humano. Late unas 100,000 veces al día, bombeando sangre a cada rincón de tu organismo. Por eso merece que lo cuides con acciones concretas y diarias.\n\n## 1. Camina 30 minutos cada día\n\nNo necesitas correr un maratón. Caminar a paso moderado durante 30 minutos activa la circulación, reduce la presión arterial y fortalece el músculo cardíaco. Empieza con 10 minutos si recién comienzas.\n\n## 2. Reduce la sal en tus comidas\n\nEl exceso de sodio eleva la presión arterial, que es uno de los principales enemigos del corazón. Prueba reemplazar la sal por hierbas aromáticas como orégano, tomillo o romero.\n\n## 3. Duerme entre 7 y 8 horas\n\nDormir poco aumenta el cortisol (hormona del estrés) que afecta directamente al sistema cardiovascular. Una buena noche de sueño es medicina preventiva gratuita.\n\n## 4. Controla tu estrés\n\nEl estrés crónico es silencioso pero dañino. Practica respiración profunda, meditación o simplemente desconéctate del teléfono por una hora al día.\n\n## 5. Hazte un chequeo anual\n\nUn electrocardiograma y análisis de colesterol al año pueden detectar problemas antes de que se conviertan en emergencias. La prevención siempre es más barata y eficaz que el tratamiento.",
                'publicado'         => true,
                'fecha_publicacion' => now()->subDays(5),
                'visitas'           => 145,
            ],
            [
                'titulo'            => '¿Cuándo llevar a tu hijo al pediatra de urgencia?',
                'slug'              => 'cuando-llevar-hijo-pediatra-urgencia',
                'categoria_id'      => 2,
                'extracto'          => 'Como padre o madre, saber distinguir cuándo una situación es urgente puede salvar la vida de tu hijo. Aquí te explicamos las señales que no debes ignorar.',
                'contenido'         => "## Los signos de alerta que todo padre debe conocer\n\nCuando un niño se enferma, la primera reacción de los padres suele ser el miedo. ¿Es grave? ¿Voy al médico ahora o espero? Esta guía te ayudará a tomar esa decisión con más seguridad.\n\n## Ve de inmediato si tu hijo tiene:\n\n- **Fiebre mayor a 38°C en bebés menores de 3 meses**\n- **Dificultad para respirar** o respiración muy rápida\n- **Convulsiones**, aunque sean breves\n- **Pérdida de consciencia** o respuesta muy lenta\n- **Labios o uñas de color azulado**\n- **Llanto inconsolable** por más de 2 horas en bebés\n\n## Puedes esperar y llamar al médico si:\n\n- Fiebre moderada en niños mayores de 6 meses que come y juega\n- Tos sin dificultad respiratoria\n- Diarrea sin signos de deshidratación\n- Golpe leve sin pérdida de consciencia\n\n## Señales de deshidratación en niños\n\nPrestá especial atención a: boca seca, sin lágrimas al llorar, ojos hundidos, no hace pipí por más de 6 horas. Estos son signos de deshidratación que requieren atención rápida.\n\n## Consejo final\n\nSiempre es mejor una consulta de más que una de menos. Nunca te sientas mal por llevar a tu hijo al médico ante la duda.",
                'publicado'         => true,
                'fecha_publicacion' => now()->subDays(10),
                'visitas'           => 203,
            ],
            [
                'titulo'            => 'Protege tu piel del sol: guía completa para el verano',
                'slug'              => 'protege-tu-piel-del-sol-guia-verano',
                'categoria_id'      => 3,
                'extracto'          => 'El sol es necesario para la vida, pero en exceso daña la piel y puede causar cáncer. Aprende cómo protegerte de forma inteligente este verano.',
                'contenido'         => "## El sol: amigo y enemigo a la vez\n\nNecesitamos el sol para sintetizar vitamina D y regular nuestro ritmo biológico. Pero la exposición sin protección acumula daño en la piel que puede llevar a manchas, envejecimiento prematuro y en casos graves, melanoma.\n\n## Elige el protector solar correcto\n\n- **FPS 30 mínimo** para el día a día\n- **FPS 50+** para playa, piscina o actividades al aire libre prolongadas\n- Busca protectores de **amplio espectro** (protegen contra UVA y UVB)\n- Si tienes piel grasa, opta por fórmulas en gel o sin aceite\n\n## ¿Cada cuánto reaplicar?\n\nCada 2 horas si estás al sol. Y después de cada baño en el mar o piscina, aunque el protector diga que es resistente al agua.\n\n## Horarios de mayor riesgo\n\nEntre las 10am y las 4pm es cuando los rayos UV son más intensos. Si puedes, evita estar bajo el sol directo en ese rango horario.\n\n## No olvides estas zonas\n\nOrejas, nuca, empeines de los pies y labios son zonas que se olvidan con frecuencia y son muy vulnerables.\n\n## Revisión anual con dermatólogo\n\nUna revisión de lunares y manchas una vez al año puede detectar lesiones sospechosas a tiempo. El diagnóstico precoz salva vidas.",
                'publicado'         => true,
                'fecha_publicacion' => now()->subDays(15),
                'visitas'           => 312,
            ],
            [
                'titulo'            => 'Alimentación saludable: mitos y verdades que debes conocer',
                'slug'              => 'alimentacion-saludable-mitos-y-verdades',
                'categoria_id'      => 4,
                'extracto'          => 'La información sobre nutrición en internet es confusa y contradictoria. Hoy separamos los mitos más comunes de las verdades científicamente comprobadas.',
                'contenido'         => "## ¿Por qué hay tanta confusión con la nutrición?\n\nCada semana aparece una nueva dieta milagrosa, un superalimento o un villano nutricional. La industria alimentaria y las redes sociales inundan de información contradictoria que confunde más que ayuda.\n\n## Mito 1: Los carbohidratos engordan\n\n**Verdad:** Los carbohidratos no son el enemigo. El problema es el tipo y la cantidad. Los carbohidratos integrales (avena, quinua, arroz integral) son esenciales para la energía. Lo que engorda es el exceso calórico, sea de lo que sea.\n\n## Mito 2: Comer grasa hace daño\n\n**Verdad:** Las grasas saludables (aguacate, aceite de oliva, frutos secos) son indispensables para el cerebro y las hormonas. Las que dañan son las grasas trans de los ultraprocesados.\n\n## Mito 3: Las frutas tienen demasiada azúcar\n\n**Verdad:** El azúcar de la fruta viene con fibra, vitaminas y antioxidantes. Es completamente diferente al azúcar refinado de los dulces. Comer 2-3 frutas al día es sano para la mayoría de personas.\n\n## Mito 4: Necesitas suplementos para estar sano\n\n**Verdad:** Si tu alimentación es variada y equilibrada, no necesitas suplementos. Los necesitan quienes tienen deficiencias específicas diagnosticadas por un médico.\n\n## El consejo que siempre funciona\n\nCome variado, incluye vegetales en cada comida, bebe suficiente agua y reduce los ultraprocesados. Sencillo de decir, poderoso en resultados.",
                'publicado'         => true,
                'fecha_publicacion' => now()->subDays(20),
                'visitas'           => 189,
            ],
            [
                'titulo'            => 'Dolor de cabeza frecuente: ¿cuándo es señal de algo más?',
                'slug'              => 'dolor-de-cabeza-frecuente-cuando-consultar',
                'categoria_id'      => 5,
                'extracto'          => 'Casi todos sufrimos de dolor de cabeza alguna vez, pero cuando se vuelve frecuente puede ser señal de un problema subyacente que merece atención médica.',
                'contenido'         => "## El dolor de cabeza más común: la cefalea tensional\n\nLa mayoría de dolores de cabeza son cefaleas tensionales, causadas por estrés, mala postura, deshidratación o falta de sueño. Se sienten como una presión en la frente o en la nuca y mejoran con descanso, hidratación y analgésicos simples.\n\n## La migraña: un nivel diferente\n\nLa migraña es un tipo especial de dolor de cabeza que puede incapacitar. Sus características:\n\n- Dolor intenso, generalmente de un solo lado\n- Náuseas o vómitos\n- Sensibilidad extrema a la luz y el sonido\n- Puede durar entre 4 y 72 horas\n\nSi tienes estas características más de 4 veces al mes, es momento de ver a un neurólogo.\n\n## Señales de alarma que no puedes ignorar\n\nConsulta de emergencia si el dolor de cabeza:\n\n- Es el más intenso que has tenido en tu vida (inicio explosivo)\n- Apareció tras un golpe en la cabeza\n- Viene acompañado de fiebre alta y rigidez en el cuello\n- Te despierta de noche regularmente\n- Se acompaña de visión doble o debilidad en un lado del cuerpo\n\n## Lleva un diario de tus dolores de cabeza\n\nAnota cuándo ocurren, cuánto duran, qué los desencadena y qué los alivia. Esta información es muy valiosa para el médico durante la consulta.",
                'publicado'         => true,
                'fecha_publicacion' => now()->subDays(25),
                'visitas'           => 267,
            ],
        ];

        foreach ($articulos as $data) {
            Articulo::firstOrCreate(['slug' => $data['slug']], $data);
        }

        $this->command->info('✅ Datos demo cargados correctamente.');
        $this->command->info('   - ' . count($especialidades) . ' especialidades');
        $this->command->info('   - ' . count($doctores) . ' doctores');
        $this->command->info('   - ' . count($servicios) . ' servicios');
        $this->command->info('   - ' . count($testimonios) . ' testimonios');
        $this->command->info('   - ' . count($categorias) . ' categorías');
        $this->command->info('   - ' . count($articulos) . ' artículos del blog');
    }
}
