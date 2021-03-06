<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'developer';
        $role->description = 'Developer';
        $role->save();


        $role = new Role();
        $role->name = 'user';
        $role->description = 'User';
        $role->save();
    }
}
