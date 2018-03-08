<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {

        echo "\nTesting Login\n";
        $this->browse(function ($browser) {
            $username = env('MASTER_USER', '');
            $password = env('MASTER_PASS', '');

            $browser->visit('/login')
                ->type('email', $username)
                ->type('password', $password)
                ->press('Login')
                ->assertPathIs('/');
        });
        echo "Done\n";
    }
}
