<?php

namespace App\Http\Controllers;
use App\Services\VolunteerFormRepository;
use App\VolunteerForm;
use App\Calendar;


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
    public function index(VolunteerFormRepository  $forms)
    {
        $volunteerForms = $forms->getAllNewForms();
        return view('admin', ['volunteerForms' => $volunteerForms]);
    }
}
