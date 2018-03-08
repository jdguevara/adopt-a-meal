<?php

namespace App\Http\Controllers;
use App\Contracts\IMealIdeaRepository;
use App\Calendar;
use Illuminate\Http\Request;

class MealIdeasController extends Controller
{
    protected $mealIdeaRepository;

    public function __construct(IMealIdeaRepository $repository)
    {
        $this->mealIdeaRepository = $repository;
    }

    /**
     * Show the cards of meal ideas
     */
    public function index()
    {
        $recipes = $this->mealIdeaRepository->getConfirmedMealIdeas();
        foreach($recipes as $recipe){
            $recipe->ingredients = json_decode($recipe->ingredients_json);
        }
        return view('mealideas', ['mealideas' => $recipes, ]);

    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'meal_name' => 'required',
            'description' => 'required',
            'ingredient' => 'required',
        ]);
        $this->mealIdeaRepository->create($request->all());
        flash('Meal suggestion sent successfully')->success();
        return redirect('/meal-ideas');
    }

}