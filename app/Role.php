<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/4/18
 * Time: 7:51 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'id', 'name'
    ];

}