<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Administrator;
use App\Models\Trainer;
use App\Models\Client;
use App\Models\ClassType;
use App\Models\Room;
use App\Models\Session;
use App\Models\Plan;
use App\Models\Membership;
use App\Models\Payment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $plans = Plan::factory(4)->create();
        $rooms = Room::factory(3)->create();

        // ========================================
        // USUARIO ENTRENADOR DE PRUEBA
        // ========================================
        $trainerUser = User::create([
            'name' => 'Carlos',
            'lastname' => 'Ramírez',
            'email' => 'entrenador@gym.com',
            'password' => bcrypt('password123'),
            'phone' => '987654321',
            'dni' => '12345678',
        ]);

        $mainTrainer = Trainer::create([
            'user_id' => $trainerUser->id,
            'speciality' => 'HIIT',
            'years_of_experience' => 8,
        ]);

        $this->command->info('✅ Usuario Entrenador creado:');
        $this->command->info('   Email: entrenador@gym.com');
        $this->command->info('   Password: password123');
        $this->command->line('');

        // ========================================
        // OTROS USUARIOS (ficticios)
        // ========================================
        $adminUsers = User::factory(3)->create();
        $trainerUsers = User::factory(5)->create();
        $clientUsers = User::factory(15)->create();


        $adminUsers->each(fn($user) => Administrator::factory()->create([
            'user_id' => $user->id,
        ]));


        $trainers = $trainerUsers->map(fn($user) => Trainer::factory()->create([
            'user_id' => $user->id,
        ]));

        // Agregar el entrenador principal a la colección
        $trainers->prepend($mainTrainer);

        $clients = $clientUsers->map(fn($user) => Client::factory()->create([
            'user_id' => $user->id,
        ]));

        // Crear sesiones reales con el SessionSeeder
        $this->call(SessionSeeder::class);

        // Obtener todas las sesiones creadas
        $sessions = Session::all();

        // inscripn de clientes a sesiones
        $sessions->each(function ($session) use ($clients) {
            $randomClients = $clients->random(rand(3, 7));
            $randomClients->each(function ($client) use ($session) {
                $session->clients()->attach($client->id, [
                    'attendance' => fake()->randomElement([0,1]),
                ]);
            });
        });

        // memebresias
        $memberships = collect();
        foreach ($clients as $client) {
            $clientMemberships = Membership::factory(rand(1, 2))->create([
                'client_id' => $client->id,
                'plan_id' => $plans->random()->id,
            ]);
            $memberships = $memberships->merge($clientMemberships);
        }

        // pagos
        $memberships->each(function ($membership) {
            Payment::factory(rand(1, 3))->create([
                'membership_id' => $membership->id,
            ]);
        });

        $this->command->info('database seed ejecutado');
    }
}
