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
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
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
            'meal_name' => 'required',
            'description' => 'required',
        ]);
         
        $this->sendEmail($request->all());
        $this->formRepository->create($request->all());
        // flash('Meal suggestion sent successfully')->success();
        return redirect('/');
    }

    /**
     */
}