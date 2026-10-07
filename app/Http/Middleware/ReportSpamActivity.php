<?php

namespace App\Http\Middleware;

use App\Support\SpamActivityReporter;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportSpamActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        $form = (string) ($request->route()?->getName() ?: $request->path());
        if (filled($request->input('website')) || filled($request->input('fax'))) {
            SpamActivityReporter::record($request, $form, 'honeypot_filled');
        }
        $response = $next($request);
        if ($response->getStatusCode() === 429) {
            SpamActivityReporter::record($request, $form, 'rate_limited');
        }
        return $response;
    }
}
