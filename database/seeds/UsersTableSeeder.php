<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new User();
        $role->name      = 'admin';
        $role->email     = 'admin@disttant.com';
        $role->password  = '$2y$10$wjYoKUVOLNAdvLc5m5a5f.JDT/YwrAbaLonvG7jnj83e2xMDfB.N2';
        $role->save();
    }
}
