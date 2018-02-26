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
    public function index(Calendar $calendar)
    {
       // $events = array_merge($calendar->findVolunteerEvents(), $calendar->findAllAccepted());

        $volunteerEvents = $calendar->findVolunteerEvents();
        $acceptedEvents = $calendar->findAllAccepted();

        return view('mealideas', ['mealideas' => $acceptedEvents]);

    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'ingredients_json' => 'nullable',
            'external_link' => 'nullable',
            'name' => 'nullable',
            'email' => 'nullable',
            'meal_idea_status' => 'required',
        ]);
        //$this->sendEmail($request->all());
        $this->mealIdeaRepository->create($request->all());
        flash('Meal suggestion sent successfully')->success();
        return redirect('/meal-ideas');
    }

}