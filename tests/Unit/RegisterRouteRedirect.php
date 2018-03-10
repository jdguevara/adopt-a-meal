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

class RegisterRouteRedirect extends TestCase
{

    public function test_redirect()
    {
        $response = $this->get('/register');
        $response->assertStatus(301);
    }


}