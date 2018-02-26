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
            'meal_name' => 'required',
            'description' => 'required',
        ]);
         
        //$this->sendEmail($request->all());
        $this->mealIdeaRepository->create($request->all());
        flash('Meal suggestion sent successfully')->success();
        return redirect('/meal-ideas');
    }

    public function addMorePost(Request $request)
    {
        $rules = [];
        foreach($request->input('name') as $key => $value) {
            $rules["name.{$key}"] = 'required';
        }
        //$validator = Validator::make($request->all(), $rules);
        //if ($validator->passes()) {
            foreach($request->input('name') as $key => $value) {
                TagList::create(['name'=>$value]);
            }
            return response()->json(['success'=>'done']);
        //}
        //return response()->json(['error'=>$validator->errors()->all()]);
    }
}