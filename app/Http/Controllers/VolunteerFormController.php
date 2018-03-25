<?php


namespace App\Http\Controllers;

use App\Contracts\IVolunteerFormRepository;
use App\Contracts\IEmailService;
use App\Http\Requests\VolunteerFormRequest;
use Illuminate\Http\Request;

define('INTERFAITH_ADMINS', env('INTERFAITH_ADMINS'));

class VolunteerFormController extends Controller
{
    protected $formRepository;
    protected $emailService;

    public function __construct(IVolunteerFormRepository $formRepository, IEmailService $emailService)
    {
        $this->formRepository = $formRepository;
        $this->middleware('guest');
        $this->emailService = $emailService;
    }

    public function volunteer(VolunteerFormRequest $request)
    {
        $request['paper_goods'] = $request['paper_goods'] == "on" ? true : false;
        $this->emailService->sendRegistraitonEmail($request->all());
        $this->formRepository->create($request->all());
        flash('Volunteer form submitted successfully')->success();
        return redirect('/');
    }
    
}