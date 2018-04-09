<?php

namespace App\Contracts;

interface IUserRepository {
    public function getAll();
    public function get($id);
    public function add($user);
    public function delete($id);
    public function update($userId, $userData);
}