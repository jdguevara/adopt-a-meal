<?php 

namespace App\Contracts;
interface IEmailService
{
    /**
     * Sends Email on volunteer sumbission
     */
    public function sendRegistrationEmail($form);
}