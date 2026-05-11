<?php

namespace App\Http\Controllers;

use App\Services\Payments\DarajaStkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SocMpesaStkController extends Controller
{
    public function initiate(Request $request, DarajaStkService $stk): JsonResponse
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:32'],
            'amount' => ['required', 'numeric', 'min:1', 'max:250000'],
        ]);

        if (! $stk->isConfigured()) {
            return response()->json([
                'message' => __('Online STK payments are not configured yet. Use Pay Bill instructions below or contact the office.'),
            ], 503);
        }

        $phone = $stk->normalizeKenyaPhone($validated['phone']);
        if ($phone === null) {
            return response()->json([
                'message' => __('Enter a valid Kenyan M-Pesa number (e.g. 07XX XXX XXX).'),
            ], 422);
        }

        $amount = (int) round((float) $validated['amount']);
        $accountRef = (string) config('mpesa.account_reference', 'SOCFEES');

        $result = $stk->requestStkPush($phone, $amount, $accountRef, 'School fees');

        if (! $result['success']) {
            Log::warning('mpesa_stk_failed', [
                'phone' => substr($phone, 0, 5).'…',
                'amount' => $amount,
                'message' => $result['message'],
            ]);

            return response()->json(['message' => $result['message']], 422);
        }

        return response()->json([
            'message' => $result['message'],
            'checkout_request_id' => $result['checkout_request_id'] ?? null,
        ]);
    }

    /**
     * Safaricom Daraja STK callback (no CSRF).
     */
    public function callback(Request $request): JsonResponse
    {
        Log::info('mpesa_stk_callback', ['payload' => $request->all()]);

        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'Accepted',
        ]);
    }
}
