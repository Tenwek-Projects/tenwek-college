<x-layouts.admin
    header="Institution settings"
    :breadcrumbs="[['label' => 'Admin', 'href' => route('admin.dashboard')], ['label' => 'Settings']]"
>
    @php
        $heroImgPath = $hero['image'] ?? '';
        $heroPreviewUrl = $heroImgPath !== '' && ! \Illuminate\Support\Str::startsWith($heroImgPath, ['http://', 'https://'])
            ? asset($heroImgPath)
            : ($heroImgPath !== '' ? $heroImgPath : null);
        $isUploadedHero = $heroImgPath !== '' && str_starts_with($heroImgPath, 'storage/hero/');
    @endphp

    <form method="post" action="{{ route('admin.settings.update') }}" class="admin-page-narrow" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="admin-card p-6 sm:p-8">
            <p class="text-sm leading-relaxed text-thc-text/85">These values override the defaults from configuration and <code class="admin-code">.env</code> for public-facing copy (site name, tagline, contact line). Leave a field empty to keep using the file default for that key.</p>

            <div class="admin-form-stack mt-6">
                <x-admin.ui.group label="Site display name" for="site_name" name="site_name" hint="Shown in titles and branding when set.">
                    <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $general['site_name']) }}" class="admin-input" placeholder="{{ config('tenwek.name') }}">
                </x-admin.ui.group>

                <x-admin.ui.group label="Tagline" for="tagline" name="tagline" hint="Short institutional line; feeds default meta description when Global SEO description is empty.">
                    <textarea name="tagline" id="tagline" rows="3" class="admin-textarea" placeholder="{{ \Illuminate\Support\Str::limit(config('tenwek.tagline'), 80) }}">{{ old('tagline', $general['tagline']) }}</textarea>
                </x-admin.ui.group>

                <x-admin.ui.group label="Legal / formal name" for="institution_legal" name="institution_legal" hint="Used in title patterns and structured data.">
                    <input type="text" name="institution_legal" id="institution_legal" value="{{ old('institution_legal', $general['institution_legal']) }}" class="admin-input" placeholder="{{ config('tenwek.institution_legal') }}">
                </x-admin.ui.group>

                <x-admin.ui.group label="Public email" for="email_public" name="email_public">
                    <input type="email" name="email_public" id="email_public" value="{{ old('email_public', $general['email_public']) }}" class="admin-input" placeholder="{{ config('tenwek.email_public') }}">
                </x-admin.ui.group>

                <x-admin.ui.group label="Public phone" for="phone" name="phone">
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $general['phone']) }}" class="admin-input" placeholder="{{ config('tenwek.phone') }}">
                </x-admin.ui.group>

                <div class="mt-6 border-t border-thc-navy/10 pt-6">
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-thc-text/55">Homepage hero</p>
                    <p class="mt-2 text-sm leading-relaxed text-thc-text/85">Update the hero section background and supporting line shown on the public landing page.</p>

                    <div class="admin-form-stack mt-5">
                        <x-admin.ui.group label="Credibility line" for="hero_credibility" name="hero_credibility" hint="Short line above headings (optional).">
                            <input
                                type="text"
                                name="hero_credibility"
                                id="hero_credibility"
                                value="{{ old('hero_credibility', $hero['credibility']) }}"
                                class="admin-input"
                                placeholder="{{ config('tenwek.hero.credibility') }}"
                            >
                        </x-admin.ui.group>

                        <x-admin.ui.group label="Hero image alt text" for="hero_image_alt" name="hero_image_alt" hint="Accessibility text for the hero background image (optional).">
                            <input
                                type="text"
                                name="hero_image_alt"
                                id="hero_image_alt"
                                value="{{ old('hero_image_alt', $hero['image_alt']) }}"
                                class="admin-input"
                                placeholder="{{ config('tenwek.hero.image_alt') }}"
                            >
                        </x-admin.ui.group>

                        <div class="admin-field">
                            <label class="admin-label" for="hero_image_upload">Hero background image</label>
                            <p class="mt-1 text-xs text-thc-text/65">Upload a file (JPEG, PNG, WebP, or GIF, max 8&nbsp;MB), or set a path under <code class="admin-code">public/</code> / full URL below.</p>

                            @if($heroPreviewUrl)
                                <div class="mt-3 overflow-hidden rounded-xl border border-thc-navy/10 bg-thc-navy/[0.02] p-3">
                                    <p class="text-[11px] font-semibold uppercase tracking-wide text-thc-text/55">{{ __('Current image') }}</p>
                                    <img src="{{ $heroPreviewUrl }}" alt="" class="mt-2 max-h-44 w-auto max-w-full rounded-lg object-contain object-left shadow-sm" loading="lazy">
                                    @if($isUploadedHero)
                                        <label class="mt-3 flex cursor-pointer items-center gap-2 text-sm text-thc-text/80">
                                            <input type="checkbox" name="clear_hero_image" value="1" class="rounded border-thc-navy/20 text-thc-royal focus:ring-thc-royal/30">
                                            {{ __('Remove uploaded image and fall back to config default') }}
                                        </label>
                                    @endif
                                </div>
                            @endif

                            <input
                                type="file"
                                name="hero_image_upload"
                                id="hero_image_upload"
                                accept="image/jpeg,image/png,image/webp,image/gif"
                                class="admin-input mt-3 file:mr-4 file:rounded-lg file:border-0 file:bg-thc-navy file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-thc-royal"
                            >
                            @error('hero_image_upload')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror

                            <x-admin.ui.group label="Image path or URL (optional)" for="hero_image" name="hero_image" hint="e.g. ctc.jpg under public/, storage/hero/… after upload, or https://… . Leave empty to use the default from config when no file is uploaded." class="mt-5">
                                <input type="text" name="hero_image" id="hero_image" value="{{ old('hero_image', $hero['image']) }}" class="admin-input" placeholder="{{ config('tenwek.hero.image') }}">
                            </x-admin.ui.group>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-actions admin-actions-sticky mt-8">
                <div class="admin-actions-primary">
                    <button type="submit" class="admin-btn-primary">Save settings</button>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
