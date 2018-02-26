<?php

namespace App;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MealIdea extends Model
{
    protected $table = 'meal_ideas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'ingredients_json',
        'external_link', 'name', 'email', 'meal_idea_status'
    ];
}
