<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/8/18
 * Time: 4:44 PM
 */

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->isAdmin())
        {
            return $next($request);
        }

        return redirect('/');
    }
}