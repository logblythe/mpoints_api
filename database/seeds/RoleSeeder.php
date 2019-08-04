<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
                'title' => 'Admin',
                'description' => 'User with all privileges'
            ]
        );
        Role::create([
                'title' => 'Seller',
                'description' => 'User with privilege of creating resources'
            ]
        );
        Role::create([
                'title' => 'User',
                'description' => 'Normal user'
            ]
        ); //
    }
}
