<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'access dashboard']);

        // Editor permissions
        Permission::create(['name' => 'view advanced history']);

        // Admin
        Permission::create(['name' => 'access admin']);

        // create roles and assign created permissions
        Role::create(['name' => 'applicant']);

        // this can be done as separate statements
        $role_editor = Role::create(['name' => 'editor']);
        $role_editor
            ->givePermissionTo('view advanced history')
            ->givePermissionTo('access dashboard');

        $role_admin = Role::create(['name' => 'super admin']);
        $role_admin->givePermissionTo(Permission::all());
    }
}
