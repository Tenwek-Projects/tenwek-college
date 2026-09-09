<?php

namespace App\Http\Controllers\Admin\Cohs;

use App\Models\CohsBoardMember;
use App\Support\Cohs\CohsLandingRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CohsBoardMemberController extends BaseCohsAdminController
{
    public function index(Request $request): View
    {
        $cohs = $this->cohsSchool($request);
        $members = CohsBoardMember::query()
            ->where('school_id', $cohs->id)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(30);

        return view('admin.cohs.board.index', compact('cohs', 'members'));
    }

    public function create(Request $request): View
    {
        $cohs = $this->cohsSchool($request);

        return view('admin.cohs.board.create', compact('cohs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cohs = $this->cohsSchool($request);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role_title' => ['required', 'string', 'max:500'],
            'bio' => ['nullable', 'string', 'max:10000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
            'highlight' => ['sometimes', 'boolean'],
            'is_published' => ['sometimes', 'boolean'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);
        $data = collect($validated)->except('image')->all();
        $data['school_id'] = $cohs->id;
        $data['highlight'] = $request->boolean('highlight', false);
        $data['is_published'] = $request->boolean('is_published', true);
        if ($request->hasFile('image')) {
            $data['image_path'] = \App\Support\UploadsDisk::store($request->file('image'), 'cohs/'.$cohs->id.'/board');
        }
        CohsBoardMember::query()->create($data);
        CohsLandingRepository::flushCache();

        return redirect()->route('admin.cohs.board.index')->with('status', 'Board member added.');
    }

    public function edit(Request $request, CohsBoardMember $board): View
    {
        $cohs = $this->cohsSchool($request);
        abort_unless((int) $board->school_id === (int) $cohs->id, 404);

        return view('admin.cohs.board.edit', compact('cohs', 'board'));
    }

    public function update(Request $request, CohsBoardMember $board): RedirectResponse
    {
        $cohs = $this->cohsSchool($request);
        abort_unless((int) $board->school_id === (int) $cohs->id, 404);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role_title' => ['required', 'string', 'max:500'],
            'bio' => ['nullable', 'string', 'max:10000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
            'highlight' => ['sometimes', 'boolean'],
            'is_published' => ['sometimes', 'boolean'],
            'image' => ['nullable', 'image', 'max:5120'],
            'remove_image' => ['sometimes', 'boolean'],
        ]);
        $data = collect($validated)->except(['image', 'remove_image'])->all();
        $data['highlight'] = $request->boolean('highlight', false);
        $data['is_published'] = $request->boolean('is_published', true);
        if ($request->boolean('remove_image') && ! $request->hasFile('image')) {
            $this->deleteStoredPortrait((int) $cohs->id, $board->image_path);
            $data['image_path'] = null;
        }
        if ($request->hasFile('image')) {
            $this->deleteStoredPortrait((int) $cohs->id, $board->image_path);
            $data['image_path'] = \App\Support\UploadsDisk::store($request->file('image'), 'cohs/'.$cohs->id.'/board');
        }
        $board->update($data);
        CohsLandingRepository::flushCache();

        return redirect()->route('admin.cohs.board.index')->with('status', 'Board member updated.');
    }

    public function destroy(Request $request, CohsBoardMember $board): RedirectResponse
    {
        $cohs = $this->cohsSchool($request);
        abort_unless((int) $board->school_id === (int) $cohs->id, 404);
        $this->deleteStoredPortrait((int) $cohs->id, $board->image_path);
        $board->delete();
        CohsLandingRepository::flushCache();

        return redirect()->route('admin.cohs.board.index')->with('status', 'Board member removed.');
    }

    private function deleteStoredPortrait(int $schoolId, ?string $path): void
    {
        if ($path === null || $path === '') {
            return;
        }
        $prefix = 'cohs/'.$schoolId.'/board/';
        if (str_starts_with($path, $prefix)) {
            Storage::disk(\App\Support\UploadsDisk::name())->delete($path);
        }
    }
}
