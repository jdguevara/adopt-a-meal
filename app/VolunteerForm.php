<?php

namespace App;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VolunteerForm extends Model
{
    protected $table = 'volunteer_forms';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'organization_name', 'phone', 'email', 'meal_description',
        'notes', 'paper_goods', 'form_status', 'open_event_id', 
        'event_date_time', 'confirmed_event_id'
    ];


}
