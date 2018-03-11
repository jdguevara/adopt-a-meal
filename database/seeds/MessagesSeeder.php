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
                'type_id' => '1',
                'version' => '1',
                'content' => 'Test Message',
                'user_id' => '1',
            ],

            [
                'type_id' => '2',
                'version' => '1',
                'content' => 'Test Message',
                'user_id' => '1',
            ],

            [
                'type_id' => '3',
                'version' => '1',
                'content' => 'Test Message',
                'user_id' => '1',
            ],

        ];

        forEach($messages as $message) {
            DB::table('messages')->insert($message);
        }

    }



}
