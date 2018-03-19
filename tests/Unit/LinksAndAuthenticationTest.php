<?php
/**
 * Created by PhpStorm.
 * User: danielbakyono
 * Date: 2/25/18
 * Time: 8:47 PM
 */

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
class LinksAndAuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test for routes and views and authentication.
     *
     * @return void
     */
    public function testLinkAuthentication()
    {

        echo "\nTesting Home route\n";
        // Checking the Welcome page works fine
        $response = $this->get('/');
        $response->assertViewIs('welcome');
        $response->assertStatus(200);
        $this->assertGuest($guard = null);
        echo "Done\n";

        echo "\nTesting Admin route\n";
        // Checking the /admin URL works fine
        $response = $this->get('/admin');
        //$response->assertViewIs('auth.login');
        $response->assertStatus(302);
        $this->assertGuest($guard = null);
        echo "Done\n";

        echo "\nTesting MealIdeas route\n";
        // Checking the meal-ideas URL works fine
        $response = $this->get('/meal-ideas');
        $response->assertViewIs('mealideas');
        $response->assertStatus(200);
        $this->assertGuest($guard = null);
        echo "Done\n";

        echo "\nTesting Login route\n";
        // Checking the login URL works fine
        $response = $this->get('/login');
        $response->assertViewIs('auth.login');
        $response->assertStatus(200);
        $this->assertGuest($guard = null);
        echo "Done\n";

        echo "\nTesting Authentication with random user\n";
        // Checking the authentication works fine
        $user = factory(User::class)->create();
        //dump($user);
        $response = $this->actingAs($user, 'api')
            ->withSession(['foo' => 'bar'])
            ->get('/');
        $this->assertAuthenticated($guard = 'api');
        $this->assertAuthenticatedAs($user, $guard = null);
        echo "Done\n";
    }
}