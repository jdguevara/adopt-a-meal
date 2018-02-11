<?php

namespace App\Http\Controllers;

use App\Contracts\IVolunteerFormRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    protected $formRepository;

    public function __construct(IVolunteerFormRepository $formRepository)
    {
        $this->formRepository = $formRepository;
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin', ['volunteerForms' => $this->formRepository->getAllNewForms()]);
    }

    public function submit(Request $request)
    {

        $this->validate($request, [
            'open_event_id' => 'required',
            'volunteer_id' => 'required',
            'approve_event' => 'required'
        ]);

        if($request->approve_event)
        {
            $this->formRepository->approve($request->volunteer_id, $request->event_id);
        }

        else
        {
            $this->formRepository->delete($request->event_id);
        }

        return view('admin', ['volunteerForms' => $this->formRepository->getAllNewForms()]);
    }
}
