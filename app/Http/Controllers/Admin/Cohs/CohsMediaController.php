<?php

namespace App\Http\Controllers\Admin\Cohs;

use App\Models\MediaAsset;
use App\Support\Media\GdImageDownscaler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CohsMediaController extends BaseCohsAdminController
{
    public function index(Request $request): View
    {
        $cohs = $this->cohsSchool($request);
        $assets = MediaAsset::query()
            ->where('school_id', $cohs->id)
            ->orderByDesc('id')
            ->paginate(24);

        return view('admin.cohs.media.index', compact('cohs', 'assets'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cohs = $this->cohsSchool($request);
        $request->validate([
            'file' => ['required', 'file', 'max:12288', 'mimes:jpg,jpeg,png,gif,webp,svg,pdf'],
            'alt_text' => ['nullable', 'string', 'max:500'],
        ]);
        $file = $request->file('file');
        GdImageDownscaler::downscaleMaxWidth($file->getRealPath());
        $disk = \App\Support\UploadsDisk::name();
        $path = \App\Support\UploadsDisk::store($file, 'cohs/'.$cohs->id.'/library');
        $medium = MediaAsset::query()->create([
            'user_id' => $request->user()->id,
            'school_id' => $cohs->id,
            'disk' => $disk,
            'path' => $path,
            'original_filename' => $file->getClientOriginalName(),
            'mime_type' => str_ends_with($path, '.webp') ? 'image/webp' : $file->getMimeType(),
            'size_bytes' => Storage::disk($disk)->size($path),
            'alt_text' => $request->input('alt_text'),
        ]);
        if ($disk === 'public') {
            $fullPath = Storage::disk('public')->path($path);
            if (GdImageDownscaler::downscaleMaxWidth($fullPath)) {
                $medium->update(['size_bytes' => Storage::disk('public')->size($path)]);
            }
        }

        return redirect()->route('admin.cohs.media.index')->with('status', 'File uploaded. Path: '.$path);
    }

    public function destroy(Request $request, MediaAsset $medium): RedirectResponse
    {
        $cohs = $this->cohsSchool($request);
        abort_unless((int) $medium->school_id === (int) $cohs->id, 404);
        Storage::disk($medium->disk)->delete($medium->path);
        $medium->delete();

        return redirect()->route('admin.cohs.media.index')->with('status', 'Asset removed.');
    }
}
