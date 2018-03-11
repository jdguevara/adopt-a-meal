<?php

namespace App\Services;

use App\Contracts\IMealIdeaRepository;
use App\MealIdea;
use DateTime;

class MealIdeaRepository implements IMealIdeaRepository
{
    private $mealidea;

    public function __construct(MealIdea $mealidea)
    {
        $this->mealidea = $mealidea;
    }

    public function all()
    {
        $this->mealidea->all();
    }

    public function get($id)
    {
        return $this->mealidea->find($id);
    }

    public function getNewMealIdeas()
    {
        return $this->mealidea->where('meal_idea_status', '=', 0)->get();
    }

    public function getConfirmedMealIdeas()
    {
        return $this->mealidea->where('meal_idea_status', '=', 1)->get();
    }

    public function getVisibleMealIdeas() {
        return $this->mealidea->where('meal_idea_status', '=',1)->where('display', '=', '1')->get();
    }

    public function create($input)
    {
        $this->mealidea->fill([
            'title' => $input['title'],
            'description' => $input['description'],
            'instructions' => $input['instructions'],
            'ingredients_json' => json_encode($input['ingredient']),
            'external_link' => $input['external_link'],
            'name' => $input['name'],
            'email' => $input['email'],
            'display' => 1,
            'meal_idea_status' => 0
        ]);
        $this->mealidea->save();

        return $this->mealidea->id;
    }
    public function update($form, $input)
    {
        $form = $this->mealidea->find($form->id);
    }

    public function delete($id)
    {
        $mealidea = $this->mealidea->find($id);
        $mealidea->delete();
    }

    public function approve($mealIdeaId, $newMealIdea)
    {
        $this->mealidea = $this->mealidea->find($mealIdeaId);
        $this->mealidea->fill([
            'title' => $newMealIdea['title'],
            'description' => $newMealIdea['description'],
            'instructions' => $newMealIdea['instructions'],
            'ingredients_json' => $newMealIdea['ingredients'],
            'external_link' => $newMealIdea['external_link'],
            'name' => $newMealIdea['name'],
            'email' => $newMealIdea['email'],
            'display' => $newMealIdea['display'],
            'meal_idea_status' => 1,
        ]);
        $this->mealidea->save();
    }

    public function deny($mealIdeaId){
        $this->mealidea->where('id', $mealIdeaId)->update(['meal_idea_status' => 2]);
    }

}