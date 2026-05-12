<?php

namespace App\Http\Controllers\Admin\Cohs;

use App\Models\NewsPost;
use App\Models\School;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CohsNewsAdminController extends BaseCohsAdminController
{
    public function index(Request $request): View
    {
        $cohs = $this->cohsSchool($request);
        $posts = NewsPost::query()
            ->where('school_id', $cohs->id)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.cohs.news.index', compact('cohs', 'posts'));
    }

    public function create(Request $request): View
    {
        $cohs = $this->cohsSchool($request);

        return view('admin.cohs.news.create', compact('cohs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cohs = $this->cohsSchool($request);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:192'],
            'excerpt' => ['nullable', 'string', 'max:2000'],
            'body' => ['nullable', 'string', 'max:500000'],
            'seo_title' => ['nullable', 'string', 'max:192'],
            'seo_description' => ['nullable', 'string', 'max:512'],
            'published_at' => ['nullable', 'date'],
            'featured_image' => ['nullable', 'image', 'max:8192'],
        ]);
        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        $slug = $this->uniqueSlug($cohs->id, $slug);
        $data = Arr::except($validated, ['slug', 'featured_image']);
        if ($request->hasFile('featured_image')) {
            $data['featured_image_path'] = $request->file('featured_image')->store($cohs->slug.'/'.$cohs->id.'/news', 'public');
        }
        NewsPost::query()->create([
            ...$data,
            'slug' => $slug,
            'school_id' => $cohs->id,
            'author_id' => $request->user()->id,
        ]);

        return redirect()->route('admin.cohs.news.index')->with('status', 'News post created.');
    }

    public function edit(Request $request, NewsPost $news): View
    {
        $cohs = $this->cohsSchool($request);
        abort_unless((int) $news->school_id === (int) $cohs->id, 404);

        return view('admin.cohs.news.edit', compact('cohs', 'news'));
    }

    public function update(Request $request, NewsPost $news): RedirectResponse
    {
        $cohs = $this->cohsSchool($request);
        abort_unless((int) $news->school_id === (int) $cohs->id, 404);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:192'],
            'excerpt' => ['nullable', 'string', 'max:2000'],
            'body' => ['nullable', 'string', 'max:500000'],
            'seo_title' => ['nullable', 'string', 'max:192'],
            'seo_description' => ['nullable', 'string', 'max:512'],
            'published_at' => ['nullable', 'date'],
            'featured_image' => ['nullable', 'image', 'max:8192'],
        ]);
        $slug = $validated['slug'] ?? $news->slug;
        $slug = $this->uniqueSlug($cohs->id, $slug, $news->id);
        $data = Arr::except($validated, ['slug', 'featured_image']);
        if ($request->hasFile('featured_image')) {
            $this->deleteStoredFeaturedImage($cohs, $news->featured_image_path);
            $data['featured_image_path'] = $request->file('featured_image')->store($cohs->slug.'/'.$cohs->id.'/news', 'public');
        }
        $news->update([...$data, 'slug' => $slug]);

        return redirect()->route('admin.cohs.news.index')->with('status', 'News post updated.');
    }

    public function destroy(Request $request, NewsPost $news): RedirectResponse
    {
        $cohs = $this->cohsSchool($request);
        abort_unless((int) $news->school_id === (int) $cohs->id, 404);
        $this->deleteStoredFeaturedImage($cohs, $news->featured_image_path);
        $news->delete();

        return redirect()->route('admin.cohs.news.index')->with('status', 'News post deleted.');
    }

    private function uniqueSlug(int $schoolId, string $slug, ?int $ignoreId = null): string
    {
        $base = $slug;
        $i = 2;
        while (NewsPost::query()
            ->where('school_id', $schoolId)
            ->where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }

    private function deleteStoredFeaturedImage(School $school, ?string $path): void
    {
        if ($path === null || $path === '') {
            return;
        }
        $prefix = $school->slug.'/'.$school->id.'/news/';
        if (str_starts_with($path, $prefix)) {
            Storage::disk('public')->delete($path);
        }
    }
}
