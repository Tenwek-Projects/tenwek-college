<?php

namespace Tests\Feature;

use Database\Seeders\TenwekFoundationSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SocFeeMpesaStkTest extends TestCase
{
    use RefreshDatabase;

    public function test_stk_initiate_returns_503_when_not_configured(): void
    {
        $this->seed(TenwekFoundationSeeder::class);
        config(['mpesa.consumer_key' => null]);

        $response = $this->postJson(route('soc.fee.mpesa.stk'), [
            'phone' => '0712345678',
            'amount' => 17_500,
        ]);

        $response->assertStatus(503);
    }

    public function test_stk_initiate_calls_daraja_when_configured(): void
    {
        config([
            'mpesa.environment' => 'sandbox',
            'mpesa.consumer_key' => 'key',
            'mpesa.consumer_secret' => 'secret',
            'mpesa.shortcode' => '174379',
            'mpesa.passkey' => 'pass',
            'mpesa.callback_url' => 'https://example.com/cb',
            'mpesa.account_reference' => 'SOC',
        ]);

        Http::fake([
            'sandbox.safaricom.co.ke/oauth/v1/generate*' => Http::response(['access_token' => 'test-token']),
            'sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest' => Http::response([
                'MerchantRequestID' => 'm',
                'CheckoutRequestID' => 'ws_CO_1',
                'ResponseCode' => '0',
                'ResponseDescription' => 'Success',
                'CustomerMessage' => 'Success. Request accepted.',
            ]),
        ]);

        $response = $this->postJson(route('soc.fee.mpesa.stk'), [
            'phone' => '0712345678',
            'amount' => 17_500,
        ]);

        $response->assertOk()
            ->assertJsonFragment(['checkout_request_id' => 'ws_CO_1']);

        Http::assertSentCount(2);
    }

    public function test_stk_callback_accepts_post_without_csrf(): void
    {
        $response = $this->postJson('/payments/mpesa/stk-callback', ['Body' => ['stkCallback' => []]]);

        $response->assertOk()->assertJson(['ResultCode' => 0]);
    }
}
