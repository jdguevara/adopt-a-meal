<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MealIdeaFormRepositoryStoresTest extends TestCase
{
    protected $formService;

    public function setUp()
    {
        parent::setUp();
        $this->formService = $this->app->make('App\Contracts\IMealIdeaRepository');
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
        $this->assertNotNull($form);
        //$this->formService->all();
        //Clean up...
        //$this->formService->delete($id);
    }

}