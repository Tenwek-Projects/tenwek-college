<?php

namespace Tests;

use App\Support\Cohs\CohsLandingRepository;
use App\Support\Forms\ArithmeticChallenge;
use App\Support\Soc\SocLandingRepository;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        CohsLandingRepository::flushCache();
        SocLandingRepository::flushCache();
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    protected function withMathChallenge(array $payload = []): array
    {
        return array_merge($payload, ArithmeticChallenge::testingPayload());
    }
}
