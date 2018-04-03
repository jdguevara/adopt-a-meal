<?php

namespace App\Models;


abstract class VolunteerFormStatus
{
    const NEW = 0;
    const APPROVED = 1;
    const DENIED = 2;
    const CANCELLED = 3;
}