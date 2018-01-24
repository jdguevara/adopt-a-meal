<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 1/23/18
 * Time: 7:28 PM
 */

namespace App\Http\Services;


interface IVolunteerFormRepository
{
    public function all();

    public function get($id);

    public function create($input);

    public function update($input);

    public function delete($input);

    public function find($id);
}