<?php

namespace App\Services;

use App\Contracts\ICalendarRepository;
use App\Contracts\IVolunteerFormRepository;
use App\VolunteerForm;
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

    public function getConfirmedMealIdeas()
    {
        return $this->mealidea->where('meal_idea_status', '=', 1)->get();
    }

    public function create($input)
    {
        $this->mealidea->fill([
            
        ]);

        $this->mealidea->save();

        return $this->mealidea->id;
    }

    public function update($form, $input)
    {
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