<?php

namespace App\Services\Payments;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DarajaStkService
{
    public function isConfigured(): bool
    {
        return filled(config('mpesa.consumer_key'))
            && filled(config('mpesa.consumer_secret'))
            && filled(config('mpesa.shortcode'))
            && filled(config('mpesa.passkey'))
            && filled(config('mpesa.callback_url'));
    }

    public function baseUrl(): string
    {
        return config('mpesa.environment') === 'production'
            ? 'https://api.safaricom.co.ke'
            : 'https://sandbox.safaricom.co.ke';
    }

    /**
     * Normalize to 2547XXXXXXXX / 2541XXXXXXXX.
     */
    public function normalizeKenyaPhone(string $raw): ?string
    {
        $digits = preg_replace('/\D+/', '', $raw) ?? '';
        if ($digits === '') {
            return null;
        }
        if (str_starts_with($digits, '0') && strlen($digits) >= 9) {
            $digits = '254'.substr($digits, 1);
        }
        if (str_starts_with($digits, '7') && strlen($digits) === 9) {
            $digits = '254'.$digits;
        }
        if (str_starts_with($digits, '1') && strlen($digits) === 9) {
            $digits = '254'.$digits;
        }
        if (preg_match('/^254[17]\d{8}$/', $digits)) {
            return $digits;
        }

        return null;
    }

    /**
     * @return array{success: bool, message: string, checkout_request_id?: string}
     */
    public function requestStkPush(string $phone254, int $amount, string $accountReference, string $transactionDesc): array
    {
        if (! $this->isConfigured()) {
            return ['success' => false, 'message' => 'M-Pesa STK is not configured.'];
        }

        if ($amount < 1 || $amount > 250_000) {
            return ['success' => false, 'message' => 'Amount must be between 1 and 250,000 Ksh.'];
        }

        try {
            $token = $this->accessToken();
        } catch (\Throwable $e) {
            return ['success' => false, 'message' => 'Could not reach M-Pesa. Try again later.'];
        }

        $shortcode = (string) config('mpesa.shortcode');
        $passkey = (string) config('mpesa.passkey');
        $timestamp = now()->timezone('Africa/Nairobi')->format('YmdHis');
        $password = base64_encode($shortcode.$passkey.$timestamp);

        $response = Http::timeout(45)
            ->withToken($token)
            ->acceptJson()
            ->asJson()
            ->post($this->baseUrl().'/mpesa/stkpush/v1/processrequest', [
                'BusinessShortCode' => $shortcode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $phone254,
                'PartyB' => $shortcode,
                'PhoneNumber' => $phone254,
                'CallBackURL' => config('mpesa.callback_url'),
                'AccountReference' => Str::limit($accountReference, 12, ''),
                'TransactionDesc' => Str::limit($transactionDesc, 13, ''),
            ]);

        $json = $response->json() ?? [];

        if (! $response->successful()) {
            return [
                'success' => false,
                'message' => is_string($json['errorMessage'] ?? null)
                    ? $json['errorMessage']
                    : 'M-Pesa request failed.',
            ];
        }

        if (($json['ResponseCode'] ?? '') !== '0') {
            return [
                'success' => false,
                'message' => (string) ($json['CustomerMessage'] ?? $json['ResponseDescription'] ?? 'STK request was rejected.'),
            ];
        }

        return [
            'success' => true,
            'message' => (string) ($json['CustomerMessage'] ?? 'Success. Check your phone for the M-Pesa prompt.'),
            'checkout_request_id' => isset($json['CheckoutRequestID']) ? (string) $json['CheckoutRequestID'] : null,
        ];
    }

    /**
     * @throws \RuntimeException
     */
    protected function accessToken(): string
    {
        $response = Http::timeout(20)
            ->withBasicAuth((string) config('mpesa.consumer_key'), (string) config('mpesa.consumer_secret'))
            ->get($this->baseUrl().'/oauth/v1/generate?grant_type=client_credentials');

        if (! $response->successful()) {
            throw new \RuntimeException('Daraja OAuth failed.');
        }

        $token = $response->json('access_token');
        if (! is_string($token) || $token === '') {
            throw new \RuntimeException('Daraja OAuth returned no token.');
        }

        return $token;
    }
}
