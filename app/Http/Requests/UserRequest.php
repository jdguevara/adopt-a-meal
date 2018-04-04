<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/4/18
 * Time: 9:41 AM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
        return $rules;
    }
}