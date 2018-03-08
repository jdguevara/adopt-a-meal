<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CalendarTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCalendar()
    {
        echo "\nTesting Calendar\n";
        $this->browse(function (Browser $browser) {
            $currentdate = date('F Y');
            $nextmonth = date('F Y', mktime(0, 0, 0, date('m') + 1, 1, date('Y')));
            $browser->visit('/')
                    ->assertSee($currentdate);

            $browser->click('.fc-next-button')
                    ->assertSee($nextmonth)
                    ->click('.fc-day-grid-event')
                    ->assertInputValue('#email','');
        });
        echo "Done\n";
    }
}
