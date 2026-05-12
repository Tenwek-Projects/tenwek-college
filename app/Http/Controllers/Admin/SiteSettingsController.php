<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteAdminSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SiteSettingsController extends Controller
{
    public function edit(): View
    {
        $defaults = [
            'site_name' => '',
            'tagline' => '',
            'institution_legal' => '',
            'email_public' => '',
            'phone' => '',
        ];
        $general = array_merge($defaults, SiteAdminSetting::instance()->general ?? []);

        $heroDefaults = [
            'credibility' => '',
            'image' => '',
            'image_alt' => '',
        ];
        $hero = array_merge($heroDefaults, SiteAdminSetting::instance()->hero ?? []);

        return view('admin.settings.edit', compact('general', 'hero'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['nullable', 'string', 'max:160'],
            'tagline' => ['nullable', 'string', 'max:500'],
            'institution_legal' => ['nullable', 'string', 'max:200'],
            'email_public' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:80'],
            'hero_credibility' => ['nullable', 'string', 'max:160'],
            'hero_image' => ['nullable', 'string', 'max:512'],
            'hero_image_alt' => ['nullable', 'string', 'max:255'],
            'hero_image_upload' => ['nullable', 'image', 'max:8192', 'mimes:jpeg,jpg,png,webp,gif'],
            'clear_hero_image' => ['sometimes', 'boolean'],
        ]);

        $row = SiteAdminSetting::instance();

        $row->general = [
            'site_name' => $validated['site_name'] ?? null,
            'tagline' => $validated['tagline'] ?? null,
            'institution_legal' => $validated['institution_legal'] ?? null,
            'email_public' => $validated['email_public'] ?? null,
            'phone' => $validated['phone'] ?? null,
        ];

        $priorHero = is_array($row->hero) ? $row->hero : [];
        $priorImg = is_string($priorHero['image'] ?? null) ? (string) $priorHero['image'] : '';
        $hero = [
            'credibility' => $validated['hero_credibility'] ?? '',
            'image' => $validated['hero_image'] ?? '',
            'image_alt' => $validated['hero_image_alt'] ?? '',
        ];

        if ($request->hasFile('hero_image_upload')) {
            self::deleteStoredHeroIfManaged($priorImg);
            $path = $request->file('hero_image_upload')->store('hero', 'public');
            $hero['image'] = 'storage/'.$path;
        } elseif ($request->boolean('clear_hero_image')) {
            self::deleteStoredHeroIfManaged($priorImg);
            $hero['image'] = '';
        }

        $row->hero = $hero;
        $row->save();

        return redirect()->route('admin.settings.edit')->with('status', __('Institution settings saved. They apply site-wide on the next request.'));
    }

    private static function deleteStoredHeroIfManaged(?string $stored): void
    {
        if ($stored === null || $stored === '') {
            return;
        }
        if (! str_starts_with($stored, 'storage/hero/')) {
            return;
        }
        $relative = Str::after($stored, 'storage/');
        Storage::disk('public')->delete($relative);
    }
}
