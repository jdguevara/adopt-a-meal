<?php


namespace App\Contracts;


interface IVolunteerFormRepository
{
    public function all();

    public function get($id);

    public function create($input);

    public function update($input);

    public function delete($input);

    public function find($id);
}