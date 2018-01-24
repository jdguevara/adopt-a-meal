<?php

namespace App\Http\Controllers;
use App\VolunteerForm;
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
    public function index(VolunteerForm $volunteerForms)
    {
        $forms = $volunteerForms->getNewVolunteerForms();
//        dd($forms);
        return view('admin', ['forms' => $forms]);
    }
}
