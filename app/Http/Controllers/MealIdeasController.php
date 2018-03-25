<?php

namespace App\Http\Controllers;
use App\Contracts\IMealIdeaRepository;
use App\Contracts\IMessagesRepository;
use Illuminate\Http\Request;

class MealIdeasController extends Controller
{
    protected $mealIdeaRepository;
    protected $messagesRepository;

    public function __construct(IMealIdeaRepository $repository, IMessagesRepository $messagesRepository)
    {
        $this->mealIdeaRepository = $repository;
        $this->messagesRepository = $messagesRepository;
    }

    /**
     * Show the cards of meal ideas
     */
    public function index()
    {
        $recipes = $this->mealIdeaRepository->getPublicMealIdeas();
        foreach($recipes as $recipe){
            $recipe->ingredients = json_decode($recipe->ingredients_json);
        }

        $messages = $this->messagesRepository->allContent();
        return view('mealideas', ['mealideas' => $recipes, 'messages' => $messages ]);

    }

    public function submit(Request $request)
    {
        $request['display'] = $request['display'] == "on" ? true : false;
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'instructions' => 'required',
            'display' => 'required',
            'ingredient' => 'required',
        ]);
        $this->mealIdeaRepository->create($request->all());
        flash('Meal suggestion sent successfully')->success();
        return redirect('/meal-ideas');
    }

}