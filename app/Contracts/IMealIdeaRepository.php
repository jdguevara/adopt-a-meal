<?php


namespace App\Contracts;


interface IMealIdeaRepository
{
    public function all();

    public function get($id);

    public function getNewMealIdeas();

    public function getConfirmedMealIdeas();

    public function create($input);

    public function update($form, $input);

    public function delete($id);

    public function approve($id);

    public function deny($id);

}