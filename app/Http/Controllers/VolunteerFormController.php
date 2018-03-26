<?php


namespace App\Http\Controllers;

use App\Contracts\IVolunteerFormRepository;
use App\Contracts\IEmailService;
use App\Http\Requests\VolunteerFormRequest;
use http\Exception;
use Illuminate\Http\Request;

class VolunteerFormController extends Controller
{
    protected $formRepository;
    protected $emailService;

    public function __construct(IVolunteerFormRepository $formRepository, IEmailService $emailService)
    {
        $this->formRepository = $formRepository;
        $this->emailService = $emailService;
    }

    public function volunteer(VolunteerFormRequest $request)
    {
        $request['paper_goods'] = $request['paper_goods'] == "on" ? true : false;

        try {
            $this->emailService->sendRegistrationEmail($request->all());
            $this->formRepository->create($request->all());
            flash('Your volunteer request was submitted successfully!')->success();
        } catch(\Exception $e) {
            flash('Your request couldn\'t be sent right now. Please try again later or contact us!')->error();
        }

        return redirect('/');
    }
    
}