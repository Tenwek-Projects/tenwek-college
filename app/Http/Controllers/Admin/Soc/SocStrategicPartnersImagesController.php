<?php

namespace App\Http\Controllers\Admin\Soc;

use App\Models\SocLandingSection;
use App\Support\Soc\SocLandingRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocStrategicPartnersImagesController extends BaseSocAdminController
{
    public function edit(Request $request): View
    {
        $soc = $this->socSchool($request);
        $strategic = $this->mergedSection($soc, 'strategic_partners');
        $partners = $strategic['partners'] ?? [];

        return view('admin.soc.strategic-partners-images', [
            'soc' => $soc,
            'partners' => $partners,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $soc = $this->socSchool($request);
        $defaults = config('tenwek.soc_landing.strategic_partners.partners', []);
        $count = count($defaults);
        abort_if($count === 0, 404);

        $request->validate([
            'partner_image' => ['sometimes', 'array'],
            'partner_image.*' => ['nullable', 'image', 'max:10240'],
            'clear_image' => ['sometimes', 'array'],
            'clear_image.*' => ['nullable', 'boolean'],
        ]);

        $existingRow = SocLandingSection::query()
            ->where('school_id', $soc->id)
            ->where('section_key', 'strategic_partners')
            ->first();
        $stored = is_array($existingRow?->payload) ? $existingRow->payload : [];
        /** @var list<array<string, mixed>> $fragments */
        $fragments = is_array($stored['partners'] ?? null) ? $stored['partners'] : [];

        $prefix = 'soc/'.$soc->id.'/strategic-partners';

        for ($i = 0; $i < $count; $i++) {
            $frag = $fragments[$i] ?? [];
            if (! is_array($frag)) {
                $frag = [];
            }
            if ($request->boolean('clear_image.'.$i)) {
                unset($frag['image']);
            }
            if ($request->hasFile('partner_image.'.$i)) {
                $frag['image'] = $request->file('partner_image.'.$i)->store($prefix, 'public');
            }
            $fragments[$i] = $frag;
        }
        $fragments = array_slice($fragments, 0, $count);

        $newPayload = $stored;
        $newPayload['partners'] = $fragments;

        $this->persistSection($soc, 'strategic_partners', $newPayload);

        return redirect()->route('admin.soc.strategic-partners.images.edit')->with('status', 'Strategic partner images saved.');
    }
}
