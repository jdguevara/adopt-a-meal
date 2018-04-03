<?php


namespace App\Contracts;


interface IMealIdeaRepository
{
    public function all();

    public function get($id);

    public function getNewMealIdeas();

    public function getConfirmedMealIdeas();

    public function getPublicMealIdeas();

    public function create($input);

    public function update($id, $input);

    public function delete($id);

    public function approve($mealIdeaId, $mealIdea);

    public function deny($id);

}