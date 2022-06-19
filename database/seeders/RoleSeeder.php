<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin',
            'user',
        ];

        $adminPermissions = [
            'user.index',
            'user.create',
            'user.edit',
            'user.delete',
            'pqr.index',
            'pqr.create',
            'pqr.edit',
            'pqr.delete',
        ];

        $userPermissions = [
            'pqr.index',
            'pqr.create',
        ];

        foreach ($roles as $key => $role) {
            $role = Role::create(['name' => $role]);

            if ($key === 0) {
                $role->syncPermissions($adminPermissions);
            } else {
                $role->syncPermissions($userPermissions);
            }
        }
    }
}
