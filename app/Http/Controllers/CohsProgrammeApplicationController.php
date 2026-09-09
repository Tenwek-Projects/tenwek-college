<?php

namespace App\Http\Controllers;

use App\Http\Requests\CohsProgrammeApplicationStoreRequest;
use App\Mail\CohsProgrammeApplicationMail;
use App\Models\FormSubmission;
use App\Models\School;
use App\Support\CohsKenyaCounties;
use App\Support\CohsProgrammeApplicationCatalog;
use App\Support\Seo\SeoPresenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CohsProgrammeApplicationController extends Controller
{
    public function show(Request $request, string $form): View
    {
        $def = CohsProgrammeApplicationCatalog::find($form);
        abort_if($def === null, 404);

        $school = School::query()->where('slug', 'cohs')->where('is_active', true)->firstOrFail();

        $seo = SeoPresenter::build($request, [
            'title' => 'Apply: '.$def['programme'].' | '.$school->name.' | '.config('tenwek.name'),
            'description' => 'Online application for '.$def['programme'].' at Tenwek Hospital College, School of Health Sciences.',
            'canonical' => route('cohs.programme-application', $form),
            'breadcrumbs' => [
                ['label' => 'Home', 'href' => route('home')],
                ['label' => $school->name, 'href' => route('schools.show', $school)],
                ['label' => 'Application forms', 'href' => route('schools.pages.show', [$school, 'application-forms'])],
                ['label' => 'Apply online', 'href' => route('cohs.programme-application', $form)],
            ],
        ]);

        $counties = CohsKenyaCounties::all();
        $healthFlags = CohsProgrammeApplicationCatalog::healthFlags();
        $paymentInstructions = CohsProgrammeApplicationCatalog::paymentInstructions();

        return view('schools.cohs.programme-application', [
            'seo' => $seo,
            'school' => $school,
            'form' => $def,
            'counties' => $counties,
            'healthFlags' => $healthFlags,
            'paymentInstructions' => $paymentInstructions,
        ]);
    }

    public function store(CohsProgrammeApplicationStoreRequest $request, string $form): RedirectResponse
    {
        $def = $request->formDef();
        $school = School::query()->where('slug', 'cohs')->where('is_active', true)->firstOrFail();

        $fileKeys = [
            'kcse_results',
            'leaving_certificate',
            'national_id',
            'proof_of_payment',
            'marriage_certificate',
            'youngest_child_birth_certificate',
            'practice_licence',
            'diploma_or_degree',
            'hd_anaesthesia_or_ecco',
        ];

        $payload = Arr::except($request->validated(), $fileKeys);
        $payload['programme'] = $def['programme'];
        $payload['pdf_title'] = $def['pdf_title'];
        $payload['apply_slug'] = $def['slug'];
        $payload['family'] = $def['family'];

        $payload['secondary'] = $this->cleanNamedRows($payload['secondary'] ?? [], 'name');
        $payload['colleges'] = $this->cleanNamedRows($payload['colleges'] ?? [], 'name');
        $payload['former_employers'] = $this->cleanNamedRows($payload['former_employers'] ?? [], 'name');

        $submission = FormSubmission::query()->create([
            'form_key' => $def['form_key'],
            'school_id' => $school->id,
            'payload' => $payload,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 512),
        ]);

        $base = 'cohs-programme/'.$def['slug'].'/'.$submission->id;
        $files = [];
        foreach ($fileKeys as $key) {
            $uploaded = $request->file($key);
            if ($uploaded instanceof UploadedFile) {
                $files[$key.'_path'] = $uploaded->store($base, 'local');
            }
        }

        $submission->update([
            'payload' => array_merge($submission->payload, $files),
        ]);

        $to = config('tenwek.cohs_landing.contact_page.email');
        if (is_string($to) && filter_var($to, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($to)->send(new CohsProgrammeApplicationMail($submission->fresh(), $def['programme']));
            } catch (\Throwable) {
                // Stored in CMS; mail can be retried from the server logs.
            }
        }

        return redirect()
            ->route('cohs.programme-application', $form)
            ->with('status', __('Thank you. Your application has been received. We will contact you using the details you provided.'));
    }

    /**
     * @param  array<int, array<string, mixed>>  $rows
     * @return list<array<string, mixed>>
     */
    private function cleanNamedRows(array $rows, string $nameKey): array
    {
        $out = [];
        foreach ($rows as $row) {
            if (! is_array($row) || ! filled($row[$nameKey] ?? null)) {
                continue;
            }
            $out[] = $row;
        }

        return $out;
    }
}
