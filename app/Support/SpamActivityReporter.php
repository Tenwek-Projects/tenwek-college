<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Throwable;

final class SpamActivityReporter
{
    public static function record(Request $request, string $form, string $reason): void
    {
        $globalKey = 'spam.alert.college.global';
        try {
            $ip = (string) ($request->ip() ?: 'unknown');
            $signal = hash('sha256', strtolower($ip).'|'.$form.'|'.$reason);
            $windowKey = 'spam.activity.college.'.$signal;
            Cache::add($windowKey, 0, now()->addMinutes(10));
            $sourceCount = Cache::increment($windowKey);
            $group = hash('sha256', $form.'|'.$reason);
            $groupKey = 'spam.activity.college.group.'.$group;
            Cache::add($groupKey, 0, now()->addMinutes(10));
            $groupCount = Cache::increment($groupKey);
            if ($sourceCount < 3 && $groupCount < 8) {
                return;
            }
            if (! Cache::add($globalKey, true, now()->addMinutes(15))) {
                return;
            }
            Mail::raw("Repeated suspicious form activity was detected.\n\nSite: Tenwek Hospital College\nForm: {$form}\nSignal: {$reason}\nSource IP: {$ip}\nFrom this source in 10 minutes: {$sourceCount}\nAcross this form in 10 minutes: {$groupCount}\nRoute: ".$request->path()."\nDetected: ".now()->toDateTimeString()."\n\nSubmitted form contents were not included.", fn ($mail) => $mail->to('albertmuhatia@gmail.com')->subject('[Tenwek College] Repeated spam activity detected'));
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
