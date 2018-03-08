<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;



class AdminLoginTest extends DuskTestCase
{
    //use DatabaseMigrations;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testAdminLogin()
    {

        echo "\nTesting Login Admin\n";
        $this->browse(function ($browser) {
            $username = env('MASTER_USER', '');
            $password = env('MASTER_PASS', '');

            $browser->visit('/admin')
                ->type('email', $username)
                ->type('password', $password)
                ->press('Login')
                ->assertPathIs('/admin');

        });
        echo "Done\n";
    }


}
