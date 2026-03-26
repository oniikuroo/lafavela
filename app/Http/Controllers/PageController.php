<?php

namespace App\Http\Controllers;

use App\Models\MenuPage;
use App\Models\Notice;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use stdClass;

class PageController extends Controller
{
    private function loadPageContent(string $lang, string $page): array
    {
        $record = MenuPage::query()
            ->where('locale', $lang)
            ->where('page', $page)
            ->first();

        if (!$record) {
            return [
                'content' => [],
                'sections' => [],
            ];
        }

        $payload = json_decode($record->payload, true);

        if (!is_array($payload)) {
            return [
                'content' => [],
                'sections' => [],
            ];
        }

        $sections = collect($payload['sections'] ?? [])
            ->map(function (array $section): stdClass {
                $sectionObject = new stdClass();
                $sectionObject->title = $section['title'] ?? '';
                $sectionObject->items = collect($section['items'] ?? [])
                    ->map(function (array $item): stdClass {
                        $itemObject = new stdClass();
                        $itemObject->name = $item['name'] ?? '';
                        $itemObject->description = $item['description'] ?? null;
                        $itemObject->price = $item['price'] ?? null;

                        return $itemObject;
                    });

                return $sectionObject;
            });

        unset($payload['sections']);

        return [
            'content' => $payload,
            'sections' => $sections,
        ];
    }

    public function home(Request $request)
    {
        $lang = app()->getLocale();

        $settings = SiteSetting::query()
            ->where('lang', $lang)
            ->pluck('value', 'key');

        $notice = Notice::query()
            ->active()
            ->where(function ($q) use ($lang) {
                $q->whereNull('lang')->orWhere('lang', $lang);
            })
            ->orderByDesc('created_at')
            ->first();

        return view('welcome', [
            'settings' => $settings,
            'notice' => $notice,
        ]);
    }

    public function menu(Request $request)
    {
        $lang = app()->getLocale();
        $pageData = $this->loadPageContent($lang, 'menu');

        return view('menu', [
            'menuContent' => $pageData['content'],
            'menuSections' => $pageData['sections'],
        ]);
    }

    public function cocktails(Request $request)
    {
        $lang = app()->getLocale();
        $pageData = $this->loadPageContent($lang, 'cocktails');

        return view('cocktails', [
            'menuContent' => $pageData['content'],
            'menuSections' => $pageData['sections'],
        ]);
    }

    public function shots(Request $request)
    {
        $lang = app()->getLocale();
        $pageData = $this->loadPageContent($lang, 'shots');

        return view('shots', [
            'menuContent' => $pageData['content'],
            'menuSections' => $pageData['sections'],
        ]);
    }
}
