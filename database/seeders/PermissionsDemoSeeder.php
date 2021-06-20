<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'super-admin']);
        $role1->givePermissionTo('create users');
        $role1->givePermissionTo('read users');
        $role1->givePermissionTo('update users');
        $role1->givePermissionTo('delete users');
        $role1->givePermissionTo('create roles');
        $role1->givePermissionTo('update roles');
        $role1->givePermissionTo('delete roles');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('create users');
        $role2->givePermissionTo('read users');
        $role2->givePermissionTo('update users'); // update own account
        $role2->givePermissionTo('delete users'); // delete own account

        $role3 = Role::create(['name' => 'user']);
        $role3->givePermissionTo('read users');
        $role3->givePermissionTo('update users'); // update own account
        $role3->givePermissionTo('delete users'); // delete own account

        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Super-Admin User',
            'email' => 'superadmin@app.test',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@app.test',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@app.test',
        ]);
        $user->assignRole($role3);
    }
}
