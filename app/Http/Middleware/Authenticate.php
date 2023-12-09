<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|string|null
     */

    protected function redirectTo($request){
        if ($request->expectsJson()){
            die(json_encode(['success' => 0, 'message' => 'unauthenticated']));
        }else{
            return route('login');
        }
    }
}
