<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Session;
use App\Models\Trainer;
use App\Models\Room;
use App\Models\ClassType;
use Carbon\Carbon;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Primero, asegurémonos de tener los tipos de clases
        $this->createClassTypes();

        // Luego creamos las sesiones reales
        $this->createSessions();
    }

    private function createClassTypes()
    {
        $classTypes = [
            [
                'name' => 'Yoga',
                'description' => 'Clase de yoga para todos los niveles, enfocada en flexibilidad, equilibrio y relajación.'
            ],
            [
                'name' => 'CrossFit',
                'description' => 'Entrenamiento funcional de alta intensidad que combina gimnasia, levantamiento de pesas y ejercicio cardiovascular.'
            ],
            [
                'name' => 'Spinning',
                'description' => 'Clase de ciclismo indoor con música motivadora para mejorar resistencia cardiovascular.'
            ],
            [
                'name' => 'Pilates',
                'description' => 'Método de ejercicio que mejora la flexibilidad, fortaleza muscular y postura corporal.'
            ],
            [
                'name' => 'Zumba',
                'description' => 'Clase de baile fitness con ritmos latinos que combina cardio y tonificación muscular.'
            ],
            [
                'name' => 'HIIT',
                'description' => 'Entrenamiento de intervalos de alta intensidad para quemar grasa y mejorar la resistencia.'
            ],
            [
                'name' => 'Boxing',
                'description' => 'Clase de boxeo para mejorar coordinación, fuerza y resistencia cardiovascular.'
            ],
            [
                'name' => 'Stretching',
                'description' => 'Clase de estiramientos para mejorar la flexibilidad y prevenir lesiones.'
            ],
        ];

        foreach ($classTypes as $classType) {
            ClassType::firstOrCreate(
                ['name' => $classType['name']],
                $classType
            );
        }
    }

    private function createSessions()
    {
        $classTypes = ClassType::all();
        $trainers = Trainer::all();
        $rooms = Room::all();

        if ($trainers->isEmpty()) {
            $this->command->warn('No hay entrenadores en la base de datos. Crea entrenadores primero.');
            return;
        }

        if ($rooms->isEmpty()) {
            $this->command->warn('No hay salas en la base de datos. Crea salas primero.');
            return;
        }

        // Definir sesiones reales para la semana
        $sessions = [
            // Lunes
            [
                'class_type' => 'Yoga',
                'name' => 'Yoga Matutino',
                'description' => 'Comienza tu semana con energía. Clase de yoga suave para despertar el cuerpo.',
                'day' => 'monday',
                'start_time' => '07:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'CrossFit',
                'name' => 'CrossFit Intenso',
                'description' => 'Entrenamiento funcional de alta intensidad. ¡Supera tus límites!',
                'day' => 'monday',
                'start_time' => '09:00',
                'duration_minutes' => 45,
            ],
            [
                'class_type' => 'Pilates',
                'name' => 'Pilates Core',
                'description' => 'Fortalece tu centro y mejora tu postura con ejercicios de pilates.',
                'day' => 'monday',
                'start_time' => '18:00',
                'duration_minutes' => 50,
            ],
            [
                'class_type' => 'Zumba',
                'name' => 'Zumba Fitness',
                'description' => 'Baila y quema calorías con los mejores ritmos latinos.',
                'day' => 'monday',
                'start_time' => '19:00',
                'duration_minutes' => 60,
            ],

            // Martes
            [
                'class_type' => 'Spinning',
                'name' => 'Spinning Power',
                'description' => 'Pedalea hacia tus metas con esta intensa clase de spinning.',
                'day' => 'tuesday',
                'start_time' => '07:00',
                'duration_minutes' => 50,
            ],
            [
                'class_type' => 'HIIT',
                'name' => 'HIIT Extreme',
                'description' => 'Intervalos de alta intensidad para máxima quema de grasa.',
                'day' => 'tuesday',
                'start_time' => '09:00',
                'duration_minutes' => 45,
            ],
            [
                'class_type' => 'Yoga',
                'name' => 'Yoga Flow',
                'description' => 'Clase dinámica de yoga con secuencias fluidas.',
                'day' => 'tuesday',
                'start_time' => '18:30',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Boxing',
                'name' => 'Boxing Cardio',
                'description' => 'Combina técnicas de boxeo con cardio para un entrenamiento completo.',
                'day' => 'tuesday',
                'start_time' => '20:00',
                'duration_minutes' => 50,
            ],

            // Miércoles
            [
                'class_type' => 'Yoga',
                'name' => 'Yoga Restaurativo',
                'description' => 'Clase relajante para liberar tensión y estrés.',
                'day' => 'wednesday',
                'start_time' => '07:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'CrossFit',
                'name' => 'CrossFit Funcional',
                'description' => 'Entrenamiento funcional para mejorar tu rendimiento diario.',
                'day' => 'wednesday',
                'start_time' => '09:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Stretching',
                'name' => 'Stretching & Mobility',
                'description' => 'Mejora tu flexibilidad y movilidad con estiramientos guiados.',
                'day' => 'wednesday',
                'start_time' => '18:00',
                'duration_minutes' => 45,
            ],
            [
                'class_type' => 'Zumba',
                'name' => 'Zumba Party',
                'description' => 'Fiesta fitness con los ritmos más movidos. ¡Diversión garantizada!',
                'day' => 'wednesday',
                'start_time' => '19:00',
                'duration_minutes' => 60,
            ],

            // Jueves
            [
                'class_type' => 'Spinning',
                'name' => 'Spinning Resistance',
                'description' => 'Aumenta tu resistencia cardiovascular con esta clase de spinning.',
                'day' => 'thursday',
                'start_time' => '07:00',
                'duration_minutes' => 50,
            ],
            [
                'class_type' => 'Pilates',
                'name' => 'Pilates Mat',
                'description' => 'Clase de pilates en colchoneta para todo el cuerpo.',
                'day' => 'thursday',
                'start_time' => '09:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'HIIT',
                'name' => 'HIIT Total Body',
                'description' => 'Entrenamiento de intervalos para trabajar todo el cuerpo.',
                'day' => 'thursday',
                'start_time' => '18:30',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Boxing',
                'name' => 'Boxing Técnico',
                'description' => 'Aprende y perfecciona técnicas de boxeo.',
                'day' => 'thursday',
                'start_time' => '20:00',
                'duration_minutes' => 60,
            ],

            // Viernes
            [
                'class_type' => 'Yoga',
                'name' => 'Yoga Power',
                'description' => 'Clase dinámica de yoga para desarrollar fuerza y flexibilidad.',
                'day' => 'friday',
                'start_time' => '07:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'CrossFit',
                'name' => 'CrossFit Weekend Prep',
                'description' => 'Termina la semana con un entrenamiento intenso y motivador.',
                'day' => 'friday',
                'start_time' => '09:00',
                'duration_minutes' => 45,
            ],
            [
                'class_type' => 'Spinning',
                'name' => 'Spinning Night',
                'description' => 'Clase nocturna de spinning con música energizante.',
                'day' => 'friday',
                'start_time' => '19:00',
                'duration_minutes' => 50,
            ],
            [
                'class_type' => 'Zumba',
                'name' => 'Zumba Weekend',
                'description' => 'Celebra el fin de semana bailando y quemando calorías.',
                'day' => 'friday',
                'start_time' => '20:00',
                'duration_minutes' => 60,
            ],

            // Sábado
            [
                'class_type' => 'Yoga',
                'name' => 'Yoga & Meditación',
                'description' => 'Clase especial de yoga con meditación guiada.',
                'day' => 'saturday',
                'start_time' => '08:00',
                'duration_minutes' => 75,
            ],
            [
                'class_type' => 'CrossFit',
                'name' => 'CrossFit WOD Especial',
                'description' => 'Workout del día con ejercicios variados y desafiantes.',
                'day' => 'saturday',
                'start_time' => '10:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'HIIT',
                'name' => 'HIIT Bootcamp',
                'description' => 'Entrenamiento militar de alta intensidad.',
                'day' => 'saturday',
                'start_time' => '11:30',
                'duration_minutes' => 50,
            ],
            [
                'class_type' => 'Zumba',
                'name' => 'Zumba Mega Party',
                'description' => 'La clase más divertida de la semana. ¡Ven a bailar!',
                'day' => 'saturday',
                'start_time' => '17:00',
                'duration_minutes' => 60,
            ],

            // Domingo
            [
                'class_type' => 'Yoga',
                'name' => 'Yoga Relax Dominical',
                'description' => 'Relájate y recarga energías para la semana que viene.',
                'day' => 'sunday',
                'start_time' => '09:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Stretching',
                'name' => 'Stretching Recovery',
                'description' => 'Estiramientos suaves para recuperación muscular.',
                'day' => 'sunday',
                'start_time' => '10:30',
                'duration_minutes' => 45,
            ],
            [
                'class_type' => 'Pilates',
                'name' => 'Pilates Suave',
                'description' => 'Clase relajada de pilates perfecta para domingos.',
                'day' => 'sunday',
                'start_time' => '11:30',
                'duration_minutes' => 50,
            ],
        ];

        // Crear sesiones para las próximas 4 semanas
        foreach ($sessions as $sessionData) {
            $classType = $classTypes->firstWhere('name', $sessionData['class_type']);

            if (!$classType) continue;

            // Crear 4 sesiones (una para cada semana del mes)
            for ($week = 0; $week < 4; $week++) {
                $date = Carbon::parse("next {$sessionData['day']}")->addWeeks($week);
                $startDateTime = $date->format('Y-m-d') . ' ' . $sessionData['start_time'];

                Session::create([
                    'trainer_id' => $trainers->random()->id,
                    'room_id' => $rooms->random()->id,
                    'class_type_id' => $classType->id,
                    'name' => $sessionData['name'],
                    'description' => $sessionData['description'],
                    'capacity' => $rooms->random()->capacity,
                    'date' => $date->format('Y-m-d'),
                    'start_datetime' => $startDateTime,
                    'duration_minutes' => $sessionData['duration_minutes'],
                ]);
            }
        }

        $this->command->info('✅ Sesiones creadas exitosamente!');
    }
}
