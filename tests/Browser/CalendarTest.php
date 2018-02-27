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
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('February');

            $browser->click('.fc-next-button')
                    ->assertSee('March')
                    ->click('.fc-day-grid-event')
                    ->assertInputValue('#email','');
        });
    }
}
