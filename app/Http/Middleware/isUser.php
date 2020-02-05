<?php

namespace App\Http\Middleware;

use Closure;

class isUser
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
        if(auth()->check() && $request->user()->role == 1){
            // JIKA BUKAN PEMILIK 
            return redirect('/home');
        }
        // JIKA PEMILIK
        return $next($request);

    }
}
