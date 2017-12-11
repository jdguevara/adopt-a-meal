<?php

use Illuminate\Database\Seeder;

class MasterAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Adds the master user to the User table
        $user = env('MASTER_USER', '');
        $pass = env('MASTER_PASS', '');
        $email = env('MASTER_EMAIL', '');

        if(!(empty($user) || empty($pass) || empty($email))) {
            DB::table('users')->insert([
                'name' => $user,
                'email' => $email,
                'password' => bcrypt($pass)
            ]);
        }
    }
}
