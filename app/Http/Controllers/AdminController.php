<?php

namespace App\Http\Controllers;
use App\VolunteerForms;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VolunteerForms $volunteerForms)
    {
        $forms = $volunteerForms->getNewVolunteerForms();
//        dd($forms);
        return view('admin', ['forms' => $forms]);
    }
}
