<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DateTime;

class VolunteerFormRepositoryStoresTest extends TestCase
{
    use RefreshDatabase;
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

    public function test_volunteer_form_create_minimum_requirement()
    {
        $mockRequest = [

            'organization_name' => 'abc',
            'phone' => '2082082088',
            'email' => 'someemail@some.com',
            'meal_description' => 'blah blah',
            'notes' => 'notes notes notes',
            'paper_goods' => true,
            'open_event_id' => '0002',
            'open_event_date_time' => mktime(0, 0, 0, date('m') + 1, 1, date('Y')),
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
    public function test_volunteer_form_create_missing_requirements()
    {

        $mockRequest = [
            'organization_name' => null,
            'phone' => '2082082088',
            'email' => null,
            'meal_description' => 'blah blah',
            'notes' => 'notes notes notes',
            'paper_goods' => true,
            'open_event_id' => '0002',
            'open_event_date_time' => mktime(0, 0, 0, date('m') + 1, 1, date('Y')),
            'form_status' => 0,
        ];
        $id = $this->formService->create($mockRequest);
        $this->assertFalse(true); // Should not be reached because an exception will be thrown
    }

    public function test_volunteer_form_approve()
    {
        $mockRequest = [
            'organization_name' => 'abc',
            'phone' => '2082082088',
            'email' => 'someemail@some.com',
            'meal_description' => 'blah blah',
            'notes' => 'notes notes notes',
            'paper_goods' => true,
            'open_event_id' => '0002',
            'open_event_date_time' => mktime(0, 0, 0, date('m') + 1, 1, date('Y')),
            'form_status' => 0,
        ];

        $id = $this->formService->create($mockRequest);
        $this->assertNotNull($id);
        $form = $this->formService->get($id);
        $this->assertEquals($form->form_status, 0);
        $this->formService->approve($form->id, $form);
        $form = $this->formService->get($id);
        $this->assertEquals($form->form_status, 1);
    }



    public function test_volunteer_form_deny()
    {
        $mockRequest = [
            'organization_name' => 'abc',
            'phone' => '2082082088',
            'email' => 'someemail@some.com',
            'meal_description' => 'blah blah',
            'notes' => 'notes notes notes',
            'paper_goods' => true,
            'open_event_id' => '0002',
            'open_event_date_time' => mktime(0, 0, 0, date('m') + 1, 1, date('Y')),
            'form_status' => 0,
        ];

        $id = $this->formService->create($mockRequest);
        $this->assertNotNull($id);
        $form = $this->formService->get($id);
        $this->assertEquals($form->form_status, 0);
        $this->formService->deny($form->id);
        $form = $this->formService->get($id);
        $this->assertEquals($form->form_status, 2);
    }

}