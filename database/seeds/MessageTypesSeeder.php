<?php

use Illuminate\Database\Seeder;

class MessageTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $messageTypes = [
            ['type' => 'CONFIRM'],
            ['type' => 'DENY'],
            ['type' => 'VOLUNTEER_APPROVE_EMAIL'],
            ['type' => 'ADMIN_APPROVE_EMAIL']
        ];

        forEach($messageTypes as $type) {
            DB::table('message_types')->insert($type);
        }

    }
}
