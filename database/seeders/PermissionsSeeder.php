<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list allcollections']);
        Permission::create(['name' => 'view allcollections']);
        Permission::create(['name' => 'create allcollections']);
        Permission::create(['name' => 'update allcollections']);
        Permission::create(['name' => 'delete allcollections']);

        Permission::create(['name' => 'list allpeople']);
        Permission::create(['name' => 'view allpeople']);
        Permission::create(['name' => 'create allpeople']);
        Permission::create(['name' => 'update allpeople']);
        Permission::create(['name' => 'delete allpeople']);

        Permission::create(['name' => 'list allrentals']);
        Permission::create(['name' => 'view allrentals']);
        Permission::create(['name' => 'create allrentals']);
        Permission::create(['name' => 'update allrentals']);
        Permission::create(['name' => 'delete allrentals']);

        Permission::create(['name' => 'list allseries']);
        Permission::create(['name' => 'view allseries']);
        Permission::create(['name' => 'create allseries']);
        Permission::create(['name' => 'update allseries']);
        Permission::create(['name' => 'delete allseries']);

        Permission::create(['name' => 'list videos']);
        Permission::create(['name' => 'view videos']);
        Permission::create(['name' => 'create videos']);
        Permission::create(['name' => 'update videos']);
        Permission::create(['name' => 'delete videos']);

        Permission::create(['name' => 'list videopeople']);
        Permission::create(['name' => 'view videopeople']);
        Permission::create(['name' => 'create videopeople']);
        Permission::create(['name' => 'update videopeople']);
        Permission::create(['name' => 'delete videopeople']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
