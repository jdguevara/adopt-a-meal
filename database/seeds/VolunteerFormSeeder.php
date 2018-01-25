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
        $env = env('APP_ENV', '');
        if(empty($env) || $env != 'prod')
            return;

        //Scaffolded out the seed but getting the EventId/time might be difficult
        DB::table('volunteer_forms')->insert([
            'open_event_id' => '',
            'open_event_id' => '',
            'open_event_id' => '',
            'open_event_id' => '',
            'open_event_id' => '',
            'open_event_id' => '',
        ]);
    }
}
