<?php

namespace App\Http\Controllers;
use App\Contracts\IMealIdeaRepository;
use App\Contracts\IMessagesRepository;
use App\Http\Requests\MealIdeaRequest;
use Exception;

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
     * Show the cards of meal ideas to users that have been approved by
     * admins.
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

    /**
     * Submit a new meal idea that will be reviewed by the admins.
     */
    public function submit(MealIdeaRequest $request)
    {
        $request['display'] = $request['display'] == "on" ? true : false;

        try {
            $this->mealIdeaRepository->create($request->all());
            flash('Your meal suggestion was sent successfully!')->success();
        } catch(\Exception $e) {
            flash("Sorry, we encountered a problem when trying to send your meal idea. 
                Please try again or come back later.")->error();
        }
        return redirect('/meal-ideas');
    }

}