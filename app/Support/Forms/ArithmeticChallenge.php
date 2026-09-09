<?php

namespace App\Support\Forms;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

final class ArithmeticChallenge
{
    private const SESSION_PREFIX = 'arithmetic_challenge.';

    /**
     * @return array{token: string, prompt: string}
     */
    public static function issue(): array
    {
        $a = random_int(2, 12);
        $b = random_int(1, 9);
        $add = (bool) random_int(0, 1);

        if (! $add && $b > $a) {
            [$a, $b] = [$b, $a];
        }

        $answer = $add ? $a + $b : $a - $b;
        $prompt = $add ? "{$a} + {$b}" : "{$a} − {$b}";
        $token = (string) Str::uuid();

        Session::put(self::SESSION_PREFIX.$token, [
            'answer' => $answer,
            'expires_at' => now()->addMinutes(10)->getTimestamp(),
        ]);

        return [
            'token' => $token,
            'prompt' => $prompt,
        ];
    }

    public static function verify(?string $token, mixed $answer): bool
    {
        if (! is_string($token) || $token === '') {
            return false;
        }

        $payload = Session::get(self::SESSION_PREFIX.$token);
        if (! is_array($payload)) {
            return false;
        }

        $expiresAt = (int) ($payload['expires_at'] ?? 0);
        if ($expiresAt < now()->getTimestamp()) {
            Session::forget(self::SESSION_PREFIX.$token);

            return false;
        }

        if (! is_numeric($answer)) {
            return false;
        }

        return (int) $payload['answer'] === (int) $answer;
    }

    public static function forget(?string $token): void
    {
        if (is_string($token) && $token !== '') {
            Session::forget(self::SESSION_PREFIX.$token);
        }
    }

    /**
     * Seed a known challenge for feature tests.
     */
    public static function seedForTesting(string $token = 'test-math-token', int $answer = 4): void
    {
        Session::put(self::SESSION_PREFIX.$token, [
            'answer' => $answer,
            'expires_at' => now()->addHour()->getTimestamp(),
        ]);
    }

    /**
     * @return array{math_challenge_token: string, math_challenge_answer: int}
     */
    public static function testingPayload(string $token = 'test-math-token', int $answer = 4): array
    {
        self::seedForTesting($token, $answer);

        return [
            'math_challenge_token' => $token,
            'math_challenge_answer' => $answer,
        ];
    }
}
