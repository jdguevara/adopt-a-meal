<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 12/4/17
 * Time: 2:15 PM
 */

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailRouteRedirect extends TestCase
{

    public function VolunteerFormRedirectTest()
    {
        $response = $this->get('/testEmail');
        $response->assertStatus(301);
    }
}