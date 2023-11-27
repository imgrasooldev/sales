<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'techsolutionstuff',
            'last_name' => 'techsolutionstuff',
            'email' => 'test@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => 123,
            'address' => 123,
            'pseudo_name' => 123,
            'position' => 123,
            'join_date' => today(),
            'country' => 123,
            'profile_image' => 123,
            'status' => 123,
            'team_lead' => 123,
            'target' => 123,
            'type' => 123,
        ]);

        $role = Role::create(['name' => 'Super-Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
