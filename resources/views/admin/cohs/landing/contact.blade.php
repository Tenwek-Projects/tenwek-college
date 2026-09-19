@php
    $socialRows = 6;
    if (is_array(old('social_label'))) {
        $socialPairs = [];
        for ($i = 0; $i < $socialRows; $i++) {
            $socialPairs[] = [
                'label' => old('social_label.'.$i, ''),
                'url' => old('social_url.'.$i, ''),
            ];
        }
    } else {
        $fromContact = $contact['social_links'] ?? [];
        $socialPairs = array_values($fromContact);
        while (count($socialPairs) < $socialRows) {
            $socialPairs[] = ['label' => '', 'url' => ''];
        }
        $socialPairs = array_slice($socialPairs, 0, $socialRows);
    }

    $phoneNumbersText = old('phone_numbers');
    if ($phoneNumbersText === null) {
        $lines = [];
        foreach ($contactPage['phone_rows'] ?? [] as $row) {
            foreach ($row['numbers'] ?? [] as $num) {
                if (is_array($num) && filled($num['display'] ?? null)) {
                    $lines[] = $num['display'];
                }
            }
        }
        if ($lines === [] && is_array($contact['phones'] ?? null)) {
            $lines = $contact['phones'];
        }
        $phoneNumbersText = implode("\n", $lines);
    }

    $phoneRowLabel = old('phone_row_label', $contactPage['phone_rows'][0]['label'] ?? 'Phone');
@endphp
<x-layouts.admin header="COHS - Contact">
    <form method="post" action="{{ route('admin.cohs.contact.update') }}" class="admin-page-narrow">
        @csrf
        @method('PUT')
        <div class="admin-card p-6 sm:p-8">
            <div class="admin-form-stack">
                <p class="text-sm leading-relaxed text-thc-text/80">
                    Updates the header top bar, the <a href="{{ route('schools.show', $cohs) }}#contact" class="admin-link" target="_blank" rel="noopener">landing contact band</a>, and the
                    <a href="{{ route('schools.pages.show', [$cohs, 'contact-us']) }}" class="admin-link" target="_blank" rel="noopener">/cohs/contact-us</a> page.
                </p>

                <div class="admin-field-inset">
                    <p class="admin-field-inset-title">Shared contact details</p>
                    <p class="admin-hint !mt-0">Email and phones appear in the header, landing contact band, and contact page.</p>

                    <x-admin.ui.group label="Office email" for="email" name="email">
                        <input type="email" name="email" id="email" value="{{ old('email', $contactPage['email'] ?? $contact['email'] ?? $topBar['email'] ?? '') }}" required class="admin-input">
                    </x-admin.ui.group>

                    <x-admin.ui.group label="Phone numbers" for="phone_numbers" name="phone_numbers" hint="One display number per line. Used on the contact page and landing band. First number also fills the header if header call is left blank.">
                        <textarea name="phone_numbers" id="phone_numbers" rows="4" required class="admin-textarea">{{ $phoneNumbersText }}</textarea>
                    </x-admin.ui.group>

                    <x-admin.ui.group label="Phone section label" for="phone_row_label" name="phone_row_label" hint="Heading above phone links on the contact page (e.g. Phone).">
                        <input type="text" name="phone_row_label" id="phone_row_label" value="{{ $phoneRowLabel }}" required class="admin-input">
                    </x-admin.ui.group>
                </div>

                <div class="admin-field-inset">
                    <p class="admin-field-inset-title">Header top bar</p>
                    <p class="admin-hint !mt-0">Shown in the COHS site header. Leave call fields blank to use the first phone number above.</p>

                    <x-admin.ui.group label="Call label" for="call_prefix" name="call_prefix">
                        <input type="text" name="call_prefix" id="call_prefix" value="{{ old('call_prefix', $topBar['call_prefix'] ?? 'Call:') }}" class="admin-input">
                    </x-admin.ui.group>
                    <x-admin.ui.group label="Call display" for="call_display" name="call_display">
                        <input type="text" name="call_display" id="call_display" value="{{ old('call_display', $topBar['call_display'] ?? '') }}" class="admin-input" placeholder="e.g. 0736 568 177">
                    </x-admin.ui.group>
                    <x-admin.ui.group label="Tel (dialable)" for="call_tel" name="call_tel" hint="E.164 style, e.g. +254736568177">
                        <input type="text" name="call_tel" id="call_tel" value="{{ old('call_tel', $topBar['call_tel'] ?? '') }}" class="admin-input" placeholder="+254…">
                    </x-admin.ui.group>
                </div>

                <div class="admin-field-inset">
                    <p class="admin-field-inset-title">Landing contact band (/cohs#contact)</p>

                    <x-admin.ui.group label="Kicker" for="landing_kicker" name="landing_kicker">
                        <input type="text" name="landing_kicker" id="landing_kicker" value="{{ old('landing_kicker', $contact['kicker'] ?? '') }}" required class="admin-input">
                    </x-admin.ui.group>
                    <x-admin.ui.group label="Location lines" for="landing_location_lines" name="landing_location_lines" hint="One line per row.">
                        <textarea name="landing_location_lines" id="landing_location_lines" rows="4" required class="admin-textarea">{{ old('landing_location_lines', implode("\n", $contact['location_lines'] ?? [])) }}</textarea>
                    </x-admin.ui.group>
                    <x-admin.ui.group label="Office hours / apply notes" for="office_hours_lines" name="office_hours_lines" hint="Optional; one line per row (e.g. intakes, application fee).">
                        <textarea name="office_hours_lines" id="office_hours_lines" rows="4" class="admin-textarea">{{ old('office_hours_lines', implode("\n", $contact['office_hours_lines'] ?? [])) }}</textarea>
                    </x-admin.ui.group>

                    <div>
                        <p class="admin-label">Social links</p>
                        <p class="admin-hint !mt-0">Optional. Both label and URL required for each link shown.</p>
                        @foreach ($socialPairs as $idx => $pair)
                            <div class="admin-grid-2 !gap-3 {{ $idx > 0 ? 'mt-3' : 'mt-2' }}">
                                <div>
                                    <label class="sr-only" for="social_label_{{ $idx }}">Social label {{ $idx + 1 }}</label>
                                    <input type="text" name="social_label[]" id="social_label_{{ $idx }}" value="{{ $pair['label'] ?? '' }}" class="admin-input" placeholder="Label (e.g. Facebook)" autocomplete="off">
                                </div>
                                <div>
                                    <label class="sr-only" for="social_url_{{ $idx }}">Social URL {{ $idx + 1 }}</label>
                                    <input type="url" name="social_url[]" id="social_url_{{ $idx }}" value="{{ $pair['url'] ?? '' }}" class="admin-input" placeholder="https://…" autocomplete="off">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="admin-field-inset">
                    <p class="admin-field-inset-title">Contact page (/cohs/contact-us)</p>

                    <x-admin.ui.group label="Hero kicker" for="hero_kicker" name="hero_kicker">
                        <input type="text" name="hero_kicker" id="hero_kicker" value="{{ old('hero_kicker', $contactPage['hero_kicker'] ?? '') }}" required class="admin-input">
                    </x-admin.ui.group>
                    <div class="admin-grid-2">
                        <x-admin.ui.group label="Headline" for="headline" name="headline">
                            <input type="text" name="headline" id="headline" value="{{ old('headline', $contactPage['headline'] ?? '') }}" required class="admin-input">
                        </x-admin.ui.group>
                        <x-admin.ui.group label="Headline accent (italic)" for="headline_accent" name="headline_accent">
                            <input type="text" name="headline_accent" id="headline_accent" value="{{ old('headline_accent', $contactPage['headline_accent'] ?? '') }}" class="admin-input">
                        </x-admin.ui.group>
                    </div>
                    <x-admin.ui.group label="Lead paragraph" for="lead" name="lead">
                        <textarea name="lead" id="lead" rows="2" required class="admin-textarea">{{ old('lead', $contactPage['lead'] ?? '') }}</textarea>
                    </x-admin.ui.group>
                    <x-admin.ui.group label="Intro (use :email for mailto placeholder)" for="intro" name="intro">
                        <textarea name="intro" id="intro" rows="3" required class="admin-textarea">{{ old('intro', $contactPage['intro'] ?? '') }}</textarea>
                    </x-admin.ui.group>
                    <x-admin.ui.group label="Office title" for="office_title" name="office_title">
                        <input type="text" name="office_title" id="office_title" value="{{ old('office_title', $contactPage['office_title'] ?? '') }}" required class="admin-input">
                    </x-admin.ui.group>
                    <x-admin.ui.group label="Address lines" for="address_lines" name="address_lines" hint="One line per row on the contact page.">
                        <textarea name="address_lines" id="address_lines" rows="4" required class="admin-textarea">{{ old('address_lines', implode("\n", $contactPage['address_lines'] ?? [])) }}</textarea>
                    </x-admin.ui.group>
                </div>

                <x-admin.ui.group label="Map embed URL" for="map_embed_url" name="map_embed_url" hint="Shown on the contact page. Leave blank to remove a saved override.">
                    <input type="url" name="map_embed_url" id="map_embed_url" value="{{ old('map_embed_url', $mapEmbed) }}" class="admin-input" placeholder="https://maps.google.com/...">
                </x-admin.ui.group>
            </div>
            <div class="admin-actions admin-actions-sticky mt-8">
                <div class="admin-actions-primary">
                    <button type="submit" class="admin-btn-primary">Save</button>
                    <a href="{{ route('admin.cohs.dashboard') }}" class="admin-btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
