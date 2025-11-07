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
                'name' => 'Aeróbicos',
                'description' => 'Ejercicios cardiovasculares con música energizante para mejorar resistencia y quemar calorías.'
            ],
            [
                'name' => 'Fitness de Combate',
                'description' => 'Combinación de técnicas de artes marciales y boxeo para un entrenamiento completo de cardio y fuerza.'
            ],
            [
                'name' => 'HIIT',
                'description' => 'Entrenamiento de intervalos de alta intensidad para quemar grasa y mejorar la resistencia.'
            ],
            [
                'name' => 'Funcional',
                'description' => 'Entrenamiento funcional que mejora movimientos cotidianos, equilibrio y coordinación.'
            ],
            [
                'name' => 'Musculación',
                'description' => 'Entrenamiento con pesas y máquinas para desarrollar fuerza y masa muscular.'
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
                'class_type' => 'Aeróbicos',
                'name' => 'Aeróbicos Matutino',
                'description' => 'Comienza tu semana con energía. Cardio intenso con música motivadora.',
                'day' => 'monday',
                'start_time' => '07:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Musculación',
                'name' => 'Musculación Básica',
                'description' => 'Entrenamiento con pesas para principiantes e intermedios.',
                'day' => 'monday',
                'start_time' => '09:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'HIIT',
                'name' => 'HIIT Power',
                'description' => 'Intervalos de alta intensidad. ¡Supera tus límites!',
                'day' => 'monday',
                'start_time' => '18:00',
                'duration_minutes' => 45,
            ],
            [
                'class_type' => 'Fitness de Combate',
                'name' => 'Combate Nocturno',
                'description' => 'Libera estrés con técnicas de boxeo y artes marciales.',
                'day' => 'monday',
                'start_time' => '19:00',
                'duration_minutes' => 60,
            ],

            // Martes
            [
                'class_type' => 'Funcional',
                'name' => 'Funcional Matutino',
                'description' => 'Mejora tu rendimiento diario con ejercicios funcionales.',
                'day' => 'tuesday',
                'start_time' => '07:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'HIIT',
                'name' => 'HIIT Extreme',
                'description' => 'Máxima quema de calorías en mínimo tiempo.',
                'day' => 'tuesday',
                'start_time' => '09:00',
                'duration_minutes' => 45,
            ],
            [
                'class_type' => 'Aeróbicos',
                'name' => 'Aeróbicos Fitness',
                'description' => 'Cardio dinámico con coreografías divertidas.',
                'day' => 'tuesday',
                'start_time' => '18:30',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Musculación',
                'name' => 'Musculación Avanzada',
                'description' => 'Entrenamiento intenso para desarrollo muscular.',
                'day' => 'tuesday',
                'start_time' => '20:00',
                'duration_minutes' => 60,
            ],

            // Miércoles
            [
                'class_type' => 'Fitness de Combate',
                'name' => 'Combate Cardio',
                'description' => 'Combina técnicas de combate con cardio intenso.',
                'day' => 'wednesday',
                'start_time' => '07:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Funcional',
                'name' => 'Funcional Total',
                'description' => 'Entrenamiento completo para todo el cuerpo.',
                'day' => 'wednesday',
                'start_time' => '09:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'HIIT',
                'name' => 'HIIT Circuit',
                'description' => 'Circuito de alta intensidad con ejercicios variados.',
                'day' => 'wednesday',
                'start_time' => '18:00',
                'duration_minutes' => 45,
            ],
            [
                'class_type' => 'Aeróbicos',
                'name' => 'Aeróbicos Dance',
                'description' => 'Baila y quema calorías con los mejores ritmos.',
                'day' => 'wednesday',
                'start_time' => '19:00',
                'duration_minutes' => 60,
            ],

            // Jueves
            [
                'class_type' => 'Musculación',
                'name' => 'Musculación Fuerza',
                'description' => 'Enfócate en ganar fuerza con ejercicios compuestos.',
                'day' => 'thursday',
                'start_time' => '07:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Funcional',
                'name' => 'Funcional Fitness',
                'description' => 'Mejora tu condición física con movimientos funcionales.',
                'day' => 'thursday',
                'start_time' => '09:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'HIIT',
                'name' => 'HIIT Total Body',
                'description' => 'Trabaja todo tu cuerpo con intervalos intensos.',
                'day' => 'thursday',
                'start_time' => '18:30',
                'duration_minutes' => 45,
            ],
            [
                'class_type' => 'Fitness de Combate',
                'name' => 'Combate Técnico',
                'description' => 'Aprende y perfecciona técnicas de combate.',
                'day' => 'thursday',
                'start_time' => '20:00',
                'duration_minutes' => 60,
            ],

            // Viernes
            [
                'class_type' => 'Aeróbicos',
                'name' => 'Aeróbicos Power',
                'description' => 'Termina la semana quemando calorías con energía.',
                'day' => 'friday',
                'start_time' => '07:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Musculación',
                'name' => 'Musculación Full Body',
                'description' => 'Entrenamiento completo de cuerpo entero.',
                'day' => 'friday',
                'start_time' => '09:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Funcional',
                'name' => 'Funcional Weekend',
                'description' => 'Prepárate para el fin de semana con un buen entrenamiento.',
                'day' => 'friday',
                'start_time' => '19:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'HIIT',
                'name' => 'HIIT Friday',
                'description' => 'Cierra la semana con máxima intensidad.',
                'day' => 'friday',
                'start_time' => '20:00',
                'duration_minutes' => 45,
            ],

            // Sábado
            [
                'class_type' => 'Fitness de Combate',
                'name' => 'Combate Especial',
                'description' => 'Clase especial de fin de semana con técnicas avanzadas.',
                'day' => 'saturday',
                'start_time' => '08:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Funcional',
                'name' => 'Funcional Bootcamp',
                'description' => 'Entrenamiento militar estilo bootcamp.',
                'day' => 'saturday',
                'start_time' => '10:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'HIIT',
                'name' => 'HIIT Extreme',
                'description' => 'La clase más intensa de la semana.',
                'day' => 'saturday',
                'start_time' => '11:30',
                'duration_minutes' => 45,
            ],
            [
                'class_type' => 'Aeróbicos',
                'name' => 'Aeróbicos Party',
                'description' => 'Celebra el sábado con música y cardio divertido.',
                'day' => 'saturday',
                'start_time' => '17:00',
                'duration_minutes' => 60,
            ],

            // Domingo
            [
                'class_type' => 'Funcional',
                'name' => 'Funcional Recovery',
                'description' => 'Entrenamiento suave de recuperación.',
                'day' => 'sunday',
                'start_time' => '09:00',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Musculación',
                'name' => 'Musculación Ligera',
                'description' => 'Entrenamiento suave para mantener músculo activo.',
                'day' => 'sunday',
                'start_time' => '10:30',
                'duration_minutes' => 60,
            ],
            [
                'class_type' => 'Aeróbicos',
                'name' => 'Aeróbicos Relax',
                'description' => 'Cardio moderado para cerrar la semana con energía.',
                'day' => 'sunday',
                'start_time' => '11:30',
                'duration_minutes' => 60,
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
