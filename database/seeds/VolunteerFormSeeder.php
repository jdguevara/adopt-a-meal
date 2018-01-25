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
        $env = env('APP_ENV');
        if(empty($env) || $env != 'prod')
            return;

        //Scaffolded out the seed but getting the EventId/time might be difficult
        DB::table('volunteer_forms')->insert([
            'organization_name' => '',
            'email' => '',
            'phone' => '',
            'meal_description' => '',
            'notes' => '',
            'food_confirmation' => true, // Must be true 
            'tableware_confirmation' => false, // Can be false
            'form_status' => 0, // integer, 0 or 1 or 2
            'open_event_id' => '', // not sure how to get this field
            'event_date_time' => '', // not sure how to get this field
            'confirmed_event_id' => '' // not sure how to get this field
        ]);
    }
}
