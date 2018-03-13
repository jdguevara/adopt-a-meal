<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessagesSeeder extends Seeder
{

    public function run()
    {
        $env = env('APP_ENV');

        $messages = [

            [
                'type' => 'volunteer_email_thank_you',
                'content' => 'Thank you for submitting your request to Adopt-A-Meal at the Interfaith Sanctuary!',
                'user_id' => 1
            ],

            [
                'type' => 'volunteer_email_process',
                'content' => 'Your request as been forwarded to a volunteer coordinator at Interfaith Sanctuary and you will hear from us shortly.',
                'user_id' => 1
            ],

            [
                'type' => 'meal_ideas_title',
                'content' => 'Meals Suggested By Volunteers and Community Members',
                'user_id' => 1
            ],

            [
                'type' => 'meal_ideas_share_prompt',
                'content' => 'If you have an idea click here ',
                'user_id' => 1
            ]
            
        ];

        forEach($messages as $message) {
            DB::table('messages')->insert($message);
        }

    }



}
