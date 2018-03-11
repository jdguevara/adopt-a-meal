<?php

namespace App\Contracts;

interface IMessageTypesRepository
{

    public function all();

    public function get($id);

}