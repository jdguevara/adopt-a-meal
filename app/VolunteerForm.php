<?php

namespace App;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class VolunteerForm extends Model
{
    protected $table = 'volunteer_forms';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organization_name', 'phone', 'email', 'meal_description',
        'notes', 'food_confirmation', 'tableware_confirmation',
        'form_status', 'open_event_id', 'event_date_time', 'confirmed_event_id'
    ];


}
