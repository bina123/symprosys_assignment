<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class verifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->header('Authorization') || ! $request->bearerToken()) {
            return redirect('/');
        }

        $token = $request->bearerToken();

        $personalAccessToken = DB::table('personal_access_tokens')->first();
        dump(hash_equals(bcrypt($token), $personalAccessToken->token));
        dd($personalAccessToken);
        if ($personalAccessToken->expires_at < now()) {
            return response()->json(['message' => 'Token Expired']);
        }

        return $next($request);
    }
}
