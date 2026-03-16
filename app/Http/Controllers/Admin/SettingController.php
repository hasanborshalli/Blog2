<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingsRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(UpdateSettingsRequest $request)
    {
        $validated = $request->validated();

        $settings = Setting::pluck('value', 'key')->toArray();

        $siteLogo = $settings['site_logo'] ?? null;
        $siteFavicon = $settings['site_favicon'] ?? null;

        if (!empty($validated['remove_site_logo']) && $siteLogo) {
            Storage::disk('public')->delete($siteLogo);
            $siteLogo = null;
        }

        if ($request->hasFile('site_logo')) {
            if ($siteLogo) {
                Storage::disk('public')->delete($siteLogo);
            }

            $siteLogo = $request->file('site_logo')->store('settings', 'public');
        }

        if (!empty($validated['remove_site_favicon']) && $siteFavicon) {
            Storage::disk('public')->delete($siteFavicon);
            $siteFavicon = null;
        }

        if ($request->hasFile('site_favicon')) {
            if ($siteFavicon) {
                Storage::disk('public')->delete($siteFavicon);
            }

            $siteFavicon = $request->file('site_favicon')->store('settings', 'public');
        }

        $data = [
            'site_name' => $validated['site_name'],
            'site_tagline' => $validated['site_tagline'] ?? null,
            'site_logo' => $siteLogo,
            'site_favicon' => $siteFavicon,
            'contact_email' => $validated['contact_email'] ?? null,
            'posts_per_page' => (string) $validated['posts_per_page'],
            'seo_meta_title' => $validated['seo_meta_title'] ?? null,
            'seo_meta_description' => $validated['seo_meta_description'] ?? null,
            'footer_text' => $validated['footer_text'] ?? null,
        ];

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Settings updated successfully.');
    }
}