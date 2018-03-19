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
                'type' => 'admin_approved_email',
                'content' => 'A request to Adopt-A-Meal has been approved!',
                'user_id' => 1
            ],

            [
                'type' => 'volunteer_approved_email',
                'content' => 'Your request to Adopt-A-Meal at Interfaith Sanctuary has been approved!.',
                'user_id' => 1
            ],

            [
                'type' => 'volunteer_approved_email_thank_you',
                'content' => 'Thank you so much for adopting a meal at the Interfaith Sanctuary!',
                'user_id' => 1
            ],
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
            ],

            [
                'type' => 'volunteer_prompt',
                'content' => 'Select a date to Adopt A Meal',
                'user_id' => 1
            ],

            [
                'type' => 'landing_page_title',
                'content' => 'Adopt A Meal',
                'user_id' => 1
            ],

            [
                'type' => 'volunteer_instructions',
                'content' => "<h4>Instructions:</h4>
                    <ol>
                        <li>Click an open volunteer event in the Calendar above (Open events are blue).</li>
                        <li>Fill out the form that opens with a your organization's name or your name, contact information, and some information about the meal that will be provided. 
                            If you're unsure of the exact meal, please include that in the meal description and we will work with you!</li>
                        <li>Submit the form, and then you will recieve an e-mail confirmation.</li>
                        <li>Staff at Interfaith Sanctuary will contact you once they've been notified of your request.</li>
                    </ol>",
                'user_id' => 1
            ],

            [
                'type' => 'volunteer_thank_you',
                'content' => "<h1>Thank you for adopting a meal!</h1>
                                <p>We would like to thank all the organizations who have volunteered for their wonderful contributions!</p>",
                'user_id' => 1
            ],

            [
                'type' => 'event_taken_title',
                'content' => 'This event is in the past',
                'user_id' => 1
            ],

            [
                'type' => 'event_taken',
                'content' => 'Sorry, but this event has already happened. Please check some of the current events to adopt a meal!',
                'user_id' => 1
            ],

            [
                'type' => 'volunteer_form_title',
                'content' => 'Adopt-A-Meal Form',
                'user_id' => 1
            ],

            [
                'type' => 'volunteer_form_instructions',
                'content' => "<h5>
                            Please provide the following information. Once the form is
                            complete you will recieve a confirmation e-mail and we will
                            contact you to help ensure your adopted meal will be a success!
                            </h5>",
                'user_id' => 1
            ],

            [
                'type' => 'volunteer_confirmation',
                'content' => "<strong>
                              By clicking 'Volunteer' I acknowledge that I am volunteering 
                              to be responsible for bringing at least 200 servings to the 
                              Interfaith Sanctuary building by 5pm on the chosen date.
                              </strong>",
                'user_id' => 1
            ],

            [
                'type' => 'volunteer_loading',
                'content' => 'Your volunteer information is being sent!',
                'user_id' => 1
            ],

            [
                'type' => 'confirmed_event_title',
                'content' => '<h3>An organization has adopted this meal!</h3>',
                'user_id' => 1
            ],
            [
            'type' => 'meal_idea_title',
            'content' => '<h3>Suggest a Meal Idea</h3>',
            'user_id' => 1
            ],
            [
                'type' => 'meal_idea_instructions',
                'content' => "<p>Thank you for taking the time to fill out a meal idea!</p>
                            <p>A provided recipe should be able to make at least 200 portions</p>",
                'user_id' => 1
            ],
            [
                'type' => 'meal_idea_loading',
                'content' => 'Your recipe is being submitted for review!',
                'user_id' => 1
            ]
        ];

        forEach($messages as $message) {
            DB::table('messages')->insert($message);
        }

    }



}
