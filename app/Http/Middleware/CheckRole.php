<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $token = $request->header('api_token');
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;
        $user = Auth::user();
        if ($roles != null) {
            if (in_array('User', $roles) && $user->isUser()) {
                return $next($request);
            } else if (in_array('Seller', $roles) && $user->isSeller()) {
                return $next($request);
            } else if (in_array('Admin', $roles) && $user->isAdmin()) {
                return $next($request);
            }
        }

//        $user = App\User::where('remember_token', $token)->first();
//        if ($user->hasAnyRole($roles) || !$roles) {
//            return $next($request);
//        }
        return response()->json([
            'error' => 'unauthorized',
        ],
            404
        );
    }
}
