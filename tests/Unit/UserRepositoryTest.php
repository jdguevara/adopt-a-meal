<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    protected $userRepository;

    public function setUp()
    {
        parent::setUp();
        $this->userRepository = $this->app->make('App\Contracts\IUserRepository');
    }

    function test_create_user()
    {
        $user = array(
            'name' => 'Test User 1',
            'email' => 'testuser@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => 1
        );

        $new_id = $this->userRepository->add($user);
        $db_user = $this->userRepository->get($new_id);

        $this->assertNotNull($db_user);
    }

    function test_delete_user()
    {
        $user = array(
            'name' => 'Test User 1',
            'email' => 'testuser2@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => 1
        );

        $new_id = $this->userRepository->add($user);
        $this->userRepository->delete($new_id);
        $test_user = $this->userRepository->get($new_id);

        $this->assertNull($test_user);
    }
}