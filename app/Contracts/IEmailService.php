<?php 

namespace App\Contracts;
interface IEmailService
{
    /**
     * Sends Email on volunteer sumbission
     */
    public function sendRegistrationEmail($form);
    /**
     * Sends emails upon form approval
     */
    public function sendApprovalEmail($form);
}