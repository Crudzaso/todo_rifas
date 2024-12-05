<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // User::factory(10)->create();

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('123456789')
            ]
        );

        /** Obtener el rol admin*/
        $role = Role::firstOrCreate(['name' => 'admin']);

        /***Asignar el rol admin al usuario creado*/
        $admin->assignRole('admin');

        $this->command->info('Admin user creado con éxito.');
    }
}
