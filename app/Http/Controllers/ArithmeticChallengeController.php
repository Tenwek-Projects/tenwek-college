<?php

namespace App\Http\Controllers;

use App\Support\Forms\ArithmeticChallenge;
use Illuminate\Http\JsonResponse;

class ArithmeticChallengeController extends Controller
{
    public function store(): JsonResponse
    {
        $challenge = ArithmeticChallenge::issue();

        return response()->json([
            'token' => $challenge['token'],
            'prompt' => $challenge['prompt'],
            'message' => 'Solve this to continue.',
        ]);
    }
}
