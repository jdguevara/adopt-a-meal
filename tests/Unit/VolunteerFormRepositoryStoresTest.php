<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VolunteerFormRepositoryStoresTest extends TestCase
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

    public function test_create_minimum_requirement()
    {
        $mockRequest = [

            'organization_name' => 'abc',
            'phone' => '2082082088',
            'email' => 'someemail@some.com',
            'meal_description' => 'blah blah',
            'notes' => $input['notes'] ?? '',
            'paper_goods' => $input['paper_goods'] ?? false,
            'open_event_id' => $input['open_event_id'],
            'open_event_date_time' => new DateTime($input['open_event_date_time']),
            'form_status' => 0,

        //

        ];

        $id = $this->formService->create($mockRequest);
        $this->assertNotNull($id);
        $form = $this->formService->get($id);
        $this->assertNotNull($form);
    }

    /**
    * @expectedException Exception
    */
    public function test_create_missing_requirements()
    {

        $mockRequest = [
            'meal_name' => 'Title',
            'description' => null,
            'ingredient' => [
                'a',
                'b',
                'c',
            ],
            'external_link' => null,
            'name' => null,
            'email' => null,
            'meal_idea_status' => 0,
        ];
        $id = $this->formService->create($mockRequest);
        $this->assertFalse(true); // Should not be reached because an exception will be thrown
    }

    public function test_meal_idea_approve()
    {
        $mockRequest = [
            'meal_name' => 'Title',
            'description' => 'Isn\'t supposed to be null',
            'ingredient' => [
                'a',
                'b',
                'c',
            ],
            'external_link' => null,
            'name' => null,
            'email' => null,
            'meal_idea_status' => 0,
        ];

        $id = $this->formService->create($mockRequest);
        $this->assertNotNull($id);
        $form = $this->formService->get($id);
        $this->formService->approve($form->id, $form);
        $form = $this->formService->get($id);
        $this->assertEquals($form->meal_idea_status, 1);
    }

}