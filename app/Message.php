<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id', 'content', 'user_id'
    ];
}