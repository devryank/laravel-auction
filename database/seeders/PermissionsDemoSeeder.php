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
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'super-admin']);
        $role1->givePermissionTo('create users');
        $role1->givePermissionTo('delete users');

        $role2 = Role::create(['name' => 'seller']);
        $role2->givePermissionTo('create users');

        $role3 = Role::create(['name' => 'bidder']);
        $role3->givePermissionTo('update users');

        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Super-Admin User',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Seller User',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Bidder User',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role3);
    }
}
