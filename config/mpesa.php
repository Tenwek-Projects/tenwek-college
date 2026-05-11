<?php

/**
 * Safaricom Daraja M-Pesa (Lipa na M-Pesa Online / STK Push).
 *
 * Sandbox: https://developer.safaricom.co.ke
 * Set MPESA_CALLBACK_URL to a public HTTPS URL (e.g. ngrok in local dev).
 */
return [
    'environment' => env('MPESA_ENVIRONMENT', 'sandbox'),

    'consumer_key' => env('MPESA_CONSUMER_KEY'),
    'consumer_secret' => env('MPESA_CONSUMER_SECRET'),

    /** Paybill / till shortcode from Daraja (sandbox often uses 174379). */
    'shortcode' => env('MPESA_SHORTCODE'),
    'passkey' => env('MPESA_PASSKEY'),

    /** Must be publicly reachable for Safaricom to POST the result. */
    'callback_url' => env('MPESA_CALLBACK_URL'),

    /** Shown on customer statement / reconciliation (max ~12 chars). */
    'account_reference' => env('MPESA_ACCOUNT_REFERENCE', 'SOCFEES'),
];
