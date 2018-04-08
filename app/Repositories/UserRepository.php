<?php

namespace App\Repositories;

use App\User;
use App\Contracts\IUserRepository;

class UserRepository implements IUserRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user->all();
    }

    public function get($id)
    {
        return $this->user->findOrFail($id);
    }

    public function add($user)
    {
        $this->user->fill([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
            'is_admin' => $user['is_admin'] == 'on' ? 1 : 0,
        ])->save();

        return $this->user->id;
    }

    public function delete($id)
    {
        $user = $this->user->findOrFail($id);
        $user->delete();
    }

    public function update($userId, $userData)
    {
        $user = $this->user->findOrFail($userId);
        $user->fill([
            'name' => $userData['name'],
            'is_admin' => $userData['is_admin'] == 'on' ? 1 : 0,
        ])->save();
    }
}