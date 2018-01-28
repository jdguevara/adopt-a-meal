<?php


namespace App\Http\Controllers;


use App\Http\Requests;
use App\Contracts\IVolunteerFormRepository;
use Illuminate\Http\Request;

class VolunteerFormController extends Controller
{
    protected $formRepository;

    public function __construct(IVolunteerFormRepository $formRepository)
    {
        $this->formRepository = $formRepository;
        $this->middleware('guest');
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'organization_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'meal_description' => 'required',
        ]);

        $this->formRepository->create($request->all());
        flash('Volunteer form submitted successfully', 'success');
        return redirect('/');
    }
}