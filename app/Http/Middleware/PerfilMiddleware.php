<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Response;


class PerfilMiddleware
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
        $user = JWTAuth::parseToken()->toUser();

        if($user->permission != 'PROFESSOR'){
             return Response::json(['acesso_negado'=>'Você não possui permissão'],401);
        }
            
        return $next($request);
    }
}
