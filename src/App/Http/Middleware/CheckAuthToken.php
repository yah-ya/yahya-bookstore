<?php

namespace Yahyya\bookstore\App\Http\Middleware;
use Closure;
use Yahyya\bookstore\App\Models\User;

class CheckAuthToken{

    public function handle($request , Closure $next)
    {
        $token = $request->bearerToken();
        $user = User::where('api_token',$token)->first();
        if($user){
            auth()->login($user);
            return $next($request);
        }

        return response(['message'=>'Unauthenticated'],403);
    }
}
