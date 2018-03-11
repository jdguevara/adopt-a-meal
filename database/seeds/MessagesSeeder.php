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
                'type' => '1',
                'content' => 'Test Message',
                'user_id' => '1'
            ],

            [
                'type' => '2',
                'content' => 'Test Message',
                'user_id' => '1'
            ],

            [
                'type' => '3',
                'content' => 'Test Message',
                'user_id' => '1'
            ],

        ];

        forEach($messages as $message) {
            DB::table('messages')->insert($message);
        }

    }



}
