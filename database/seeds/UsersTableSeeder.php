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
        $role->email     = 'admin@alkesystems.es';
        $role->password  = '$2y$10$aROeZxqiW09Kqx0iX2oMI.Y4aEQVOFFRX22kZsr24cRYi2Ocr1/nC';
        $role->save();
    }
}
