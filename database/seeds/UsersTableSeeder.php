<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'id'=> 1,
            'name'=> 'Admin',
            'email'=> 'admin@elixir.dev',
            'password'=> bcrypt('allowadmin'),
        ]);
        $permissions = Permission::all();
        $admin->permissions()->attach($permissions);
    }
}
