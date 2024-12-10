<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear o encontrar el usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456789'),
            ]
        );

        // Crear o encontrar el usuario organizer
        $organizer = User::firstOrCreate(
            ['email' => 'santiago.londono07@gmail.com'],
            [
                'name' => 'Santiago',
                'password' => Hash::make('Medellin27'),
            ]
        );

        // Crear roles si no existen
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $organizerRole = Role::firstOrCreate(['name' => 'organizer']);

        // Asignar roles a los usuarios
        $admin->assignRole($adminRole);
        $organizer->assignRole($organizerRole);

        // Mensajes de éxito
        $this->command->info('Admin user creado con éxito.');
        $this->command->info('Organizer user creado con éxito.');
    }
}
