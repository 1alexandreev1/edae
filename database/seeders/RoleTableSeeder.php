<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $config = config('roles');
        foreach ($config['permissions'] as $key => $item) {
            foreach (explode(',', $item) as $p => $perm) {
                $name = $key . '-' . $config['permissions_map'][$perm];
                Permission::firstOrCreate(['name' => $name]);
            }
        }

        foreach ($config['roles'] as $nameRole => $permission) {
            $role = Role::firstOrCreate(['name' => $nameRole]);
            // $role->display_name = $config['display_name_roles'][$nameRole];
            $role->save();
            if (!is_array($permission) && $permission === 'all') {
                $role->givePermissionTo(Permission::all());
            } elseif (is_array($permission)) {
                foreach ($permission as $key => $item) {
                    foreach (explode(',', $item) as $p => $perm) {
                        $name = $key . '-' . $config['permissions_map'][$perm];
                        $newPermission = Permission::firstOrCreate(['name' => $name]);
                        $role->givePermissionTo($newPermission);
                    }
                }
            }
        }
        User::updateOrCreate([
            'login' => 'Admin',
        ], [
            'name' => 'Alexandr',
            'email' => 'admin@edaee.ru',
            'password' => 'qwerty', //$2y$10$XYWUBjKMCFjkdXBw/nC5s.RGoUsBNmoqp3pRl/uYIQbncaTPGpi4u
        ])->assignRole('admin');

        User::updateOrCreate([
            'login' => 'Test',
        ], [
            'name' => 'User Test',
            'email' => 'test@edaee.ru',
            'password' => 'qwerty', //$2y$10$npnqrDGSi0ukMahaE6x/SuExp4PzzyuE6wf5pZUTopSQeAv977evC
        ])->assignRole('user');
    }
}
