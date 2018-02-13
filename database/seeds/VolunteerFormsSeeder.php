<?php

use Illuminate\Database\Seeder;
use App\Calendar;

class VolunteerFormsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Calendar $calendar)
    {
        // Adds the master user to the User table
        $env = env('APP_ENV');
        if(empty($env) || $env == 'prod')
            return;

        $events = $calendar->findAll();
        $max = count($events) > 5 ? 5 : count($events);        
        for ($i = 0; $i < $max; $i++) {
            $event = $events[mt_rand(0, count($events) - 1)];
            DB::table('volunteer_forms')->insert([
                'title' => 'Seeded title',
                'organization_name' => 'Seeded Organization',
                'email' => 'seed@seed.seed',
                'phone' => '9998887776',
                'meal_description' => 'Soylent green is people.',
                'notes' => 'Seed notes',
                'paper_goods' => false, // Can be false
                'form_status' => 0, // integer, 0=new or 1=confirmed or 2=rejected
                'open_event_id' => $event['id'], // not sure how to get this field
                'event_date_time' => new DateTime($event['start']['dateTime']), // not sure how to get this field
                'confirmed_event_id' => null // not sure how to get this field
            ]);
        }
    }
}
