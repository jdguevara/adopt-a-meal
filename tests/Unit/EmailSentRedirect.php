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

<<<<<<< HEAD:tests/Unit/EmailSentRedirectTest.php
class EmailSentRedirectTest extends TestCase
=======
class EmailRouteRedirect extends TestCase
>>>>>>> feature/test-unit:tests/Unit/EmailSentRedirect.php
{

    public function test_volunteer_form_redirect()
    {
        $response = $this->get('/testEmail');
        $response->assertStatus(301);
    }
}