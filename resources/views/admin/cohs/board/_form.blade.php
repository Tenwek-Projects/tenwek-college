<x-admin.ui.group label="Name" for="name" name="name">
    <input type="text" name="name" id="name" value="{{ old('name', $board->name ?? '') }}" required class="admin-input">
</x-admin.ui.group>

<x-admin.ui.group label="Role / title" for="role_title" name="role_title" hint="Shown under the name on the About us page (e.g. Board Chair).">
    <input type="text" name="role_title" id="role_title" value="{{ old('role_title', $board->role_title ?? '') }}" required class="admin-input">
</x-admin.ui.group>

<x-admin.ui.group label="Bio" for="bio" name="bio" hint="Optional short biography shown on the member card when provided.">
    <textarea name="bio" id="bio" rows="4" class="admin-textarea">{{ old('bio', $board->bio ?? '') }}</textarea>
</x-admin.ui.group>

<x-admin.ui.group label="Sort order" for="sort_order" name="sort_order" hint="Lower numbers appear first.">
    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $board->sort_order ?? 0) }}" min="0" class="admin-input">
</x-admin.ui.group>

<div class="flex flex-wrap gap-6">
    <label class="admin-check-row">
        <input type="hidden" name="highlight" value="0">
        <input type="checkbox" name="highlight" value="1" @checked(old('highlight', $board->highlight ?? false)) class="admin-checkbox">
        <span>Highlight card</span>
    </label>
    <label class="admin-check-row">
        <input type="hidden" name="is_published" value="0">
        <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $board->is_published ?? true)) class="admin-checkbox">
        <span>Published</span>
    </label>
</div>

<x-admin.ui.group label="Photo" for="image" name="image" hint="Portrait for the hospital board grid on About us. JPEG, PNG, WebP, or GIF up to 5&nbsp;MB.">
    <input type="file" name="image" id="image" accept="image/*" class="admin-file-input">
    @if (($board->exists ?? false) && $board->image_path)
        @php($imgUrl = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl($board->image_path) ?? asset($board->image_path))
        <div class="mt-3 flex flex-wrap items-end gap-4">
            <img src="{{ $imgUrl }}" alt="" class="h-32 w-24 rounded-lg border border-thc-navy/10 object-cover shadow-sm" width="96" height="128" loading="lazy" decoding="async">
            <div class="space-y-2">
                <p class="admin-hint">Current file: <span class="admin-code">{{ $board->image_path }}</span> — choose a new file above to replace it.</p>
                <label class="admin-check-row">
                    <input type="checkbox" name="remove_image" value="1" class="admin-checkbox">
                    <span>Remove photo</span>
                </label>
            </div>
        </div>
    @endif
</x-admin.ui.group>
