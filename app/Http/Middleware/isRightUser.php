<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isRightUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_id = $request->route('id_user');
        $auth_user_id = Auth::user()->id;

        if ($auth_user_id !== (int) $user_id) {
            return redirect()->route('bouteille.index');
        }
        return $next($request);
    }
}