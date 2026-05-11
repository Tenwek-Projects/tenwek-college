<x-admin.ui.group label="Title" for="title" name="title">
    <input type="text" name="title" id="title" value="{{ old('title', $post->title ?? '') }}" required class="admin-input">
</x-admin.ui.group>

<x-admin.ui.group label="Slug" for="slug" name="slug" hint="Optional; generated from title when left blank.">
    <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug ?? '') }}" class="admin-input" placeholder="auto-generated">
</x-admin.ui.group>

<x-admin.ui.group label="Excerpt" for="excerpt" name="excerpt">
    <textarea name="excerpt" id="excerpt" rows="3" class="admin-textarea">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
</x-admin.ui.group>

<x-admin.ui.group label="Body" for="body" name="body">
    <textarea name="body" id="body" rows="12" class="admin-textarea">{{ old('body', $post->body ?? '') }}</textarea>
</x-admin.ui.group>

<x-admin.ui.group label="Featured image" for="featured_image" name="featured_image" hint="Upload an image file (JPEG, PNG, WebP, or GIF, max 8MB). A preview will appear below.">
    <input type="file" name="featured_image" id="featured_image" accept="image/jpeg,image/png,image/webp,image/gif" class="admin-file-input">
    @error('featured_image')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror

    @php
        $existingUrl = ($post->exists ?? false) ? $post->featuredImagePublicUrl() : null;
    @endphp

    <div class="mt-3 flex flex-wrap items-end gap-4">
        <img
            id="cohs-featured-image-preview"
            src="{{ $existingUrl ?? '' }}"
            alt=""
            class="h-28 max-w-[12rem] rounded-lg border border-thc-navy/10 object-cover shadow-sm {{ $existingUrl ? '' : 'hidden' }}"
            loading="lazy"
            decoding="async"
            width="192"
            height="112"
        >
        <p class="admin-hint">
            @if($existingUrl)
                Current image — choose a new file to replace it.
            @else
                Choose a file to see a preview.
            @endif
        </p>
    </div>
</x-admin.ui.group>

<div class="admin-grid-2">
    <x-admin.ui.group label="SEO title" for="seo_title" name="seo_title">
        <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $post->seo_title ?? '') }}" class="admin-input">
    </x-admin.ui.group>
    <x-admin.ui.group label="Published at" for="published_at" name="published_at">
        <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}" class="admin-input">
    </x-admin.ui.group>
</div>

<x-admin.ui.group label="SEO description" for="seo_description" name="seo_description">
    <textarea name="seo_description" id="seo_description" rows="2" class="admin-textarea">{{ old('seo_description', $post->seo_description ?? '') }}</textarea>
</x-admin.ui.group>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const input = document.getElementById('featured_image');
                const preview = document.getElementById('cohs-featured-image-preview');
                if (!input || !preview) return;

                input.addEventListener('change', function () {
                    const file = input.files && input.files[0] ? input.files[0] : null;
                    if (!file) {
                        return;
                    }
                    if (!file.type || !file.type.startsWith('image/')) {
                        return;
                    }
                    const url = URL.createObjectURL(file);
                    preview.src = url;
                    preview.classList.remove('hidden');
                });
            });
        </script>
    @endpush
@endonce
