<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSystemAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = $request->user()->id;
        $user_role = UserRole::where('user_id', $userId)->get();
        if($user_role[0]->role_id == 1 || $user_role[0]->role_id == 2 || $user_role[0]->role_id == 3 ){
            return $next($request);
        }else{
           return Redirect('/home');
        }
    }
}
