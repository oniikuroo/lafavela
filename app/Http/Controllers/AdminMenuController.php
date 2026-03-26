<?php

namespace App\Http\Controllers;

use App\Models\MenuPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminMenuController extends Controller
{
    private array $supportedLocales = ['es', 'en', 'pt'];
    private array $supportedPages = ['menu', 'cocktails', 'shots'];

    public function index(Request $request): View
    {
        $locale = $request->query('locale', 'es');
        $page = $request->query('page', 'menu');

        if (!in_array($locale, $this->supportedLocales, true)) {
            $locale = 'es';
        }

        if (!in_array($page, $this->supportedPages, true)) {
            $page = 'menu';
        }

        $menuPage = $this->getOrCreatePage($locale, $page);

        return view('admin.menu', [
            'locale' => $locale,
            'page' => $page,
            'payload' => $this->normalizePayload($menuPage->payload),
            'supportedLocales' => $this->supportedLocales,
            'supportedPages' => $this->supportedPages,
        ]);
    }

    public function updatePage(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locale' => 'required|in:es,en,pt',
            'page' => 'required|in:menu,cocktails,shots',
            'heading' => 'required|string|max:160',
            'subtitle' => 'nullable|string|max:255',
            'hours' => 'nullable|string|max:255',
            'ad' => 'nullable|string|max:255',
        ]);

        $menuPage = $this->getOrCreatePage($data['locale'], $data['page']);
        $payload = $this->normalizePayload($menuPage->payload);
        $payload['heading'] = $data['heading'];
        $payload['subtitle'] = $data['subtitle'] ?? '';
        $payload['hours'] = $data['hours'] ?? '';
        $payload['ad'] = $data['ad'] ?? '';
        $this->savePayload($menuPage, $payload);

        return $this->redirectToPage($data['locale'], $data['page'], 'Página actualizada.');
    }

    public function storeSection(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locale' => 'required|in:es,en,pt',
            'page' => 'required|in:menu,cocktails,shots',
            'title' => 'required|string|max:160',
            'position' => 'nullable|integer|min:0',
        ]);

        $menuPage = $this->getOrCreatePage($data['locale'], $data['page']);
        $payload = $this->normalizePayload($menuPage->payload);
        $sections = $payload['sections'];
        $position = min($data['position'] ?? count($sections), count($sections));

        array_splice($sections, $position, 0, [[
            'title' => $data['title'],
            'items' => [],
        ]]);

        $payload['sections'] = array_values($sections);
        $this->savePayload($menuPage, $payload);

        return $this->redirectToPage($data['locale'], $data['page'], 'Sección creada.');
    }

    public function updateSection(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locale' => 'required|in:es,en,pt',
            'page' => 'required|in:menu,cocktails,shots',
            'section_index' => 'required|integer|min:0',
            'title' => 'required|string|max:160',
            'position' => 'nullable|integer|min:0',
        ]);

        $menuPage = $this->getOrCreatePage($data['locale'], $data['page']);
        $payload = $this->normalizePayload($menuPage->payload);
        $sections = $payload['sections'];

        abort_unless(isset($sections[$data['section_index']]), 404);

        $section = $sections[$data['section_index']];
        $section['title'] = $data['title'];
        unset($sections[$data['section_index']]);
        $sections = array_values($sections);

        $position = min($data['position'] ?? $data['section_index'], count($sections));
        array_splice($sections, $position, 0, [$section]);

        $payload['sections'] = array_values($sections);
        $this->savePayload($menuPage, $payload);

        return $this->redirectToPage($data['locale'], $data['page'], 'Sección actualizada.');
    }

    public function deleteSection(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locale' => 'required|in:es,en,pt',
            'page' => 'required|in:menu,cocktails,shots',
            'section_index' => 'required|integer|min:0',
        ]);

        $menuPage = $this->getOrCreatePage($data['locale'], $data['page']);
        $payload = $this->normalizePayload($menuPage->payload);
        $sections = $payload['sections'];

        abort_unless(isset($sections[$data['section_index']]), 404);

        unset($sections[$data['section_index']]);
        $payload['sections'] = array_values($sections);
        $this->savePayload($menuPage, $payload);

        return $this->redirectToPage($data['locale'], $data['page'], 'Sección eliminada.');
    }

    public function storeItem(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locale' => 'required|in:es,en,pt',
            'page' => 'required|in:menu,cocktails,shots',
            'section_index' => 'required|integer|min:0',
            'name' => 'required|string|max:160',
            'description' => 'nullable|string|max:255',
            'price' => 'nullable|string|max:50',
            'position' => 'nullable|integer|min:0',
        ]);

        $menuPage = $this->getOrCreatePage($data['locale'], $data['page']);
        $payload = $this->normalizePayload($menuPage->payload);

        abort_unless(isset($payload['sections'][$data['section_index']]), 404);

        $items = $payload['sections'][$data['section_index']]['items'] ?? [];
        $position = min($data['position'] ?? count($items), count($items));

        array_splice($items, $position, 0, [[
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'] ?? null,
        ]]);

        $payload['sections'][$data['section_index']]['items'] = array_values($items);
        $this->savePayload($menuPage, $payload);

        return $this->redirectToPage($data['locale'], $data['page'], 'Ítem creado.');
    }

    public function updateItem(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locale' => 'required|in:es,en,pt',
            'page' => 'required|in:menu,cocktails,shots',
            'section_index' => 'required|integer|min:0',
            'item_index' => 'required|integer|min:0',
            'name' => 'required|string|max:160',
            'description' => 'nullable|string|max:255',
            'price' => 'nullable|string|max:50',
            'position' => 'nullable|integer|min:0',
        ]);

        $menuPage = $this->getOrCreatePage($data['locale'], $data['page']);
        $payload = $this->normalizePayload($menuPage->payload);

        abort_unless(isset($payload['sections'][$data['section_index']]), 404);

        $items = $payload['sections'][$data['section_index']]['items'] ?? [];
        abort_unless(isset($items[$data['item_index']]), 404);

        $item = [
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'] ?? null,
        ];

        unset($items[$data['item_index']]);
        $items = array_values($items);

        $position = min($data['position'] ?? $data['item_index'], count($items));
        array_splice($items, $position, 0, [$item]);

        $payload['sections'][$data['section_index']]['items'] = array_values($items);
        $this->savePayload($menuPage, $payload);

        return $this->redirectToPage($data['locale'], $data['page'], 'Ítem actualizado.');
    }

    public function deleteItem(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locale' => 'required|in:es,en,pt',
            'page' => 'required|in:menu,cocktails,shots',
            'section_index' => 'required|integer|min:0',
            'item_index' => 'required|integer|min:0',
        ]);

        $menuPage = $this->getOrCreatePage($data['locale'], $data['page']);
        $payload = $this->normalizePayload($menuPage->payload);

        abort_unless(isset($payload['sections'][$data['section_index']]), 404);

        $items = $payload['sections'][$data['section_index']]['items'] ?? [];
        abort_unless(isset($items[$data['item_index']]), 404);

        unset($items[$data['item_index']]);
        $payload['sections'][$data['section_index']]['items'] = array_values($items);
        $this->savePayload($menuPage, $payload);

        return $this->redirectToPage($data['locale'], $data['page'], 'Ítem eliminado.');
    }

    private function getOrCreatePage(string $locale, string $page): MenuPage
    {
        return MenuPage::query()->firstOrCreate(
            ['locale' => $locale, 'page' => $page],
            ['payload' => json_encode($this->emptyPayload(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)]
        );
    }

    private function normalizePayload(string $payload): array
    {
        $decoded = json_decode($payload, true);
        $base = $this->emptyPayload();

        if (!is_array($decoded)) {
            return $base;
        }

        $base['heading'] = (string) ($decoded['heading'] ?? '');
        $base['subtitle'] = (string) ($decoded['subtitle'] ?? '');
        $base['hours'] = (string) ($decoded['hours'] ?? '');
        $base['ad'] = (string) ($decoded['ad'] ?? '');
        $base['sections'] = collect($decoded['sections'] ?? [])
            ->map(function ($section) {
                return [
                    'title' => (string) ($section['title'] ?? ''),
                    'items' => collect($section['items'] ?? [])
                        ->map(function ($item) {
                            return [
                                'name' => (string) ($item['name'] ?? ''),
                                'description' => $item['description'] ?? null,
                                'price' => $item['price'] ?? null,
                            ];
                        })
                        ->values()
                        ->all(),
                ];
            })
            ->values()
            ->all();

        return $base;
    }

    private function savePayload(MenuPage $menuPage, array $payload): void
    {
        $menuPage->update([
            'payload' => json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ]);
    }

    private function redirectToPage(string $locale, string $page, string $status): RedirectResponse
    {
        return redirect()
            ->route('admin.menu', ['locale' => $locale, 'page' => $page])
            ->with('status', $status);
    }

    private function emptyPayload(): array
    {
        return [
            'heading' => '',
            'subtitle' => '',
            'hours' => '',
            'ad' => '',
            'sections' => [],
        ];
    }
}
