<?php

namespace App\Http\Middleware;

use App\Http\Middleware;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user = $request->user();
        $user_id = Auth::id();
        $user = User::find($user_id);
        echo $user, "SSS";
        if ($user && ($user->type === 'admin')) {
            return $next($request);
        }

        return response('Access denied', 403);
    }
}
