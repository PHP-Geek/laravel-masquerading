<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Analyst
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!Auth::check()) {
            return $request->method() == 'POST' ? response()->json(['code' => '0', 'message' => 'Session Expired. Please refresh the page']) : redirect('/login');
        }
        $roles = Auth::user()->userRole;
       
        $roleArray = array_column($roles->toArray(), 'roleSlug');
        //check for system analyst role
        if (!in_array('analyst', $roleArray)) {
            return $request->method() == 'POST' ? response()->json(['code' => '0', 'message' => 'Not Authorized to access the page.']) : redirect('/home');
        }
        return $next($request);
    }

}
