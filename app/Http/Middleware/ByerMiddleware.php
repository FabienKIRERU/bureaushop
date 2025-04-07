<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ByerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // verifier si l'utilisateur connécté est le byer,(rôle = byer)
        $user = Auth::user();

        if ($user->hasRole('byer')) {
            // si oui, on va jusqu'à la prochaine requête, 
            return $next($request);            
        }else{
            // sinon on redirige vers la page de connection
            abort(403, "vous ne pouvez pas accéder");
        }
    }
}
