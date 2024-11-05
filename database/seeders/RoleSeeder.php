<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $admin= Role::create(['name'=> 'admin']);
        $organizer=  Role::create(['name'=> 'organizer']);
        $client= Role::create(['name'=> 'client']);

        /**
         * crear todos los permisos en un array
         */
        $permissions = [
            'user.create', 'user.destroy', 'user.edit', 'user.show',
            'raffle.create', 'raffle.destroy', 'raffle.edit', 'raffle.show',
            'role.create', 'role.destroy', 'role.edit', 'role.show',
            'raffle.purchase'
        ];
        /**
         * crear los permisos y buscarlos en la base de datos
         */
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        /**
         * Asignando permisos a cada rol
         */
        $admin->syncPermissions($permissions);


        $organizer->syncPermissions([
            'raffle.create',
            'raffle.edit',
            'raffle.show',
            'raffle.purchase',
        ]);

        $client->syncPermissions([
            'raffle.show',
            'raffle.purchase',
        ]);

    }
}
