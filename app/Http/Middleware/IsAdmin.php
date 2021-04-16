<?php

namespace App\Http\Middleware;

use Closure;
use App\Profil;

class IsAdmin
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
        $p = Profil::find(auth()->user()->profil_id);

        if($p->isAdmin == 1)
        {
            return $next($request);
        }
        return redirect('/home')->with('errors','Désolé, il faut être administrateur pour pouvoir accéder à cette page.');
    }
}
