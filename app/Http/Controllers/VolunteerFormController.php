<?php


namespace App\Http\Controllers;


use App\Http\Services\IVolunteerFormRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VolunteerFormController extends Controller
{
    private $formRepository;

    public function __construct(IVolunteerFormRepository $formRepository)
    {
        $this->formRepository = $formRepository;
        $this->middleware('guest');
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'orgName' => 'required',
            'email' => 'required',
            'phoneNumber' => 'required',
            'mealDescription' => 'required',
            'bringingFood' => 'required',
            'bringingUtensils' => 'required',
        ]);

        $this->formRepository->create($request->all());

        return redirect('/');
    }
}