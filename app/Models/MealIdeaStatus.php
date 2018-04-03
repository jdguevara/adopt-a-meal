<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 3/24/18
 * Time: 9:35 PM
 */

namespace App\Models;


abstract class MealIdeaStatus
{
    const NEW = 0;
    const APPROVED = 1;
    const DENIED = 2;
}