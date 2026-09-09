<?php

namespace Tests;

use App\Support\Forms\ArithmeticChallenge;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    protected function withMathChallenge(array $payload = []): array
    {
        return array_merge($payload, ArithmeticChallenge::testingPayload());
    }
}
