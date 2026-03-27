<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(Request $request): View
    {
        $lang = $request->query('lang', app()->getLocale());
        $supported = ['es', 'en', 'pt'];
        if (!in_array($lang, $supported, true)) {
            $lang = 'es';
        }

        $settings = SiteSetting::query()
            ->where('lang', $lang)
            ->pluck('value', 'key');

        $notices = Notice::query()
            ->orderByDesc('created_at')
            ->limit(20)
            ->get();

        return view('admin.index', [
            'lang' => $lang,
            'settings' => $settings,
            'notices' => $notices,
            'supported' => $supported,
        ]);
    }

    public function saveSettings(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'lang' => 'required|in:es,en,pt',
            'subtitle' => 'nullable|string|max:255',
            'hours' => 'nullable|string|max:255',
            'visit_intro' => 'nullable|string|max:500',
            'home_ad' => 'nullable|string|max:255',
        ]);

        $lang = $data['lang'];
        $pairs = [
            'subtitle' => $data['subtitle'] ?? '',
            'hours' => $data['hours'] ?? '',
            'visit_intro' => $data['visit_intro'] ?? '',
            'home_ad' => $data['home_ad'] ?? '',
        ];

        foreach ($pairs as $key => $value) {
            SiteSetting::query()->updateOrCreate(
                ['lang' => $lang, 'key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('status', 'Ajustes guardados.');
    }

    public function storeNotice(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'lang' => 'nullable|in:es,en,pt',
            'title' => 'required|string|max:160',
            'body' => 'nullable|string|max:500',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'is_active' => 'nullable|boolean',
        ]);

        Notice::query()->create([
            'lang' => $data['lang'] ?? null,
            'title' => $data['title'],
            'body' => $data['body'] ?? null,
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
            'is_active' => (bool)($data['is_active'] ?? true),
        ]);

        return back()->with('status', 'Aviso creado.');
    }

    public function deleteNotice(Notice $notice): RedirectResponse
    {
        $notice->delete();

        return back()->with('status', 'Aviso eliminado.');
    }
}
