<?php

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;

use App\RoleUser;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*
        
        This does NOT work because Laravel is looking for `rule_users` table

        $roleUser = new RoleUser();
        $roleUser->role_id      = 1;
        $roleUser->user_id      = 1;
        $roleUser->save();

        So we will fix this with DB facade

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1
        ]);
        
        */


        $roleUser = new RoleUser();
        $roleUser->role_id      = 1;
        $roleUser->user_id      = 1;
        $roleUser->save();

    }
}
