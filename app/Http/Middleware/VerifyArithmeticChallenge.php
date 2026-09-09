<?php

namespace App\Http\Middleware;

use App\Support\Forms\ArithmeticChallenge;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyArithmeticChallenge
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->input('math_challenge_token');
        $answer = $request->input('math_challenge_answer');

        if (! ArithmeticChallenge::verify(is_string($token) ? $token : null, $answer)) {
            $message = __('Please solve the arithmetic check correctly to continue.');

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'message' => $message,
                    'errors' => [
                        'math_challenge_answer' => [$message],
                    ],
                ], 422);
            }

            return back()
                ->withInput($request->except(['math_challenge_token', 'math_challenge_answer']))
                ->withErrors(['math_challenge_answer' => $message]);
        }

        ArithmeticChallenge::forget(is_string($token) ? $token : null);

        return $next($request);
    }
}
