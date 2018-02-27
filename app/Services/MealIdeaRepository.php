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

    public function create($input)
    {
        $this->mealidea->fill([
            'title' => $input['meal_name'],
            'description' => $input['description'],
            'ingredients_json' => json_encode($input['ingredient']),
            'external_link' => $input['external_link'],
            'name' => $input['name'],
            'email' => $input['email'],
            'meal_idea_status' => 0,
            
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

    public function approve($mealIdeaId)
    {
        $this->mealidea->where('id', $mealIdeaId)->update(['meal_idea_status' => 1]);
    }

    public function deny($mealIdeaId){
        $this->mealidea->where('id', $mealIdeaId)->update(['meal_idea_status' => 2]);
    }

}