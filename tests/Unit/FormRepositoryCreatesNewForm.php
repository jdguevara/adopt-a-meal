<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormRepositoryCreatesNewForm extends TestCase
{
    protected $formService;

    public function setUp()
    {
        parent::setUp();
        $this->formService = $this->app->make('App\Contracts\IVolunteerFormRepository');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_smoke()
    {
        $this->assertTrue( $this->formService != null);
    }

    public function test_creates_new_form()
    {
        $mockRequest = [
            'organization_name' => 'Testing Test',
            'phone' => '2081234567',
            'email' => 'testing@test.com',
            'meal_description' => 'Food and stuff.',
            'notes' => 'Some testy mctest notes.',
            'food_confirmation' => true,
            'tableware_confirmation' => false,
            'open_event_id' => 1,
            'form_status' => 0,
        ];

        $id = $this->formService->create($mockRequest);
        $this->assertNotNull($id);
        $form = $this->formService->get($id);
        $this->assertNotNull($form);
        //Clean up...
        $this->formService->delete($id);
    }

}