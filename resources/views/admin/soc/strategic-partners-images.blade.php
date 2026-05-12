@php
    use App\Support\Soc\SocLandingRepository;
@endphp
<x-layouts.admin header="SOC — Strategic partners (images)">
    <form method="post" action="{{ route('admin.soc.strategic-partners.images.update') }}" enctype="multipart/form-data" class="admin-page-narrow">
        @csrf
        @method('PUT')
        <div class="admin-card p-6 sm:p-8 space-y-6">
            @if (session('status'))
                <div class="admin-alert-success mb-4" role="status">{{ session('status') }}</div>
            @endif

            <div class="admin-field-inset space-y-2">
                <p class="admin-field-inset-title">Partner logos &amp; photos</p>
                <p class="admin-hint -mt-1">
                    Text for each partner still comes from <a href="{{ route('admin.soc.json.edit', ['section' => 'strategic_partners']) }}" class="admin-link">Landing JSON → strategic_partners</a>.
                    Here you only replace images; uploads are stored under <span class="admin-code">storage/soc/{{ $soc->id }}/strategic-partners</span>.
                </p>
                <p class="admin-hint">
                    <a href="{{ route('schools.pages.show', [$soc, 'strategic-partners']) }}" class="admin-link" target="_blank" rel="noopener">View public page</a>
                </p>
            </div>

            <div class="admin-form-stack space-y-8">
                @foreach ($partners as $i => $partner)
                    @php
                        $name = $partner['name'] ?? ('Partner #'.($i + 1));
                        $abbr = $partner['abbr'] ?? null;
                        $imgPath = $partner['image'] ?? null;
                        $preview = SocLandingRepository::publicMediaUrl($imgPath);
                    @endphp
                    <div class="admin-field-inset space-y-4">
                        <div class="flex flex-wrap items-baseline justify-between gap-2">
                            <p class="admin-field-inset-title">
                                {{ $name }}
                                @if ($abbr)
                                    <span class="font-normal text-thc-text/70">({{ $abbr }})</span>
                                @endif
                            </p>
                        </div>
                        @if ($preview)
                            <div class="flex items-start gap-4">
                                <img src="{{ $preview }}" alt="" class="max-h-24 w-auto rounded border border-thc-border/40 bg-white object-contain">
                            </div>
                        @else
                            <p class="admin-hint">No image set — default layout may hide this block or use a placeholder.</p>
                        @endif
                        <x-admin.ui.group label="Upload image" for="partner_image_{{ $i }}" name="partner_image.{{ $i }}">
                            <input type="file" name="partner_image[{{ $i }}]" id="partner_image_{{ $i }}" accept="image/*" class="admin-file-input">
                        </x-admin.ui.group>
                        <label class="flex items-center gap-2 text-sm text-thc-text">
                            <input type="hidden" name="clear_image[{{ $i }}]" value="0">
                            <input type="checkbox" name="clear_image[{{ $i }}]" value="1" class="admin-checkbox">
                            Clear custom image (revert to config / no upload)
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="admin-actions admin-actions-sticky mt-8">
                <div class="admin-actions-primary">
                    <button type="submit" class="admin-btn-primary">Save images</button>
                    <a href="{{ route('admin.soc.dashboard') }}" class="admin-btn-secondary">Back to CMS</a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
