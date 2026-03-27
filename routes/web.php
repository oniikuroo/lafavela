<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $lang = app()->getLocale();

    if (!in_array($lang, ['es', 'en', 'pt'], true)) {
        $lang = 'es';
    }

    return redirect()->route('home', ['lang' => $lang]);
});

Route::get('/{lang}/admin', function (string $lang) {
    return redirect()->route('admin.index', ['lang' => $lang]);
})->where(['lang' => 'es|en|pt'])->name('admin.localized.index');

Route::get('/{lang}/admin/menu', function (Request $request, string $lang) {
    return redirect()->route('admin.menu', [
        'locale' => $lang,
        'page' => $request->query('page', 'menu'),
    ]);
})->where(['lang' => 'es|en|pt'])->name('admin.localized.menu');

Route::prefix('{lang}')
    ->where(['lang' => 'es|en|pt'])
    ->group(function () {
        Route::get('/', [PageController::class, 'home'])->name('home');
        Route::get('/menu', [PageController::class, 'menu'])->name('menu');
        Route::get('/cocktails', [PageController::class, 'cocktails'])->name('cocktails');
        Route::get('/chupitos', [PageController::class, 'shots'])->name('shots');
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/settings', [AdminController::class, 'saveSettings'])->name('admin.settings');
    Route::post('/notices', [AdminController::class, 'storeNotice'])->name('admin.notices.store');
    Route::delete('/notices/{notice}', [AdminController::class, 'deleteNotice'])->name('admin.notices.delete');
    Route::get('/menu', [AdminMenuController::class, 'index'])->name('admin.menu');
    Route::post('/menu/page', [AdminMenuController::class, 'updatePage'])->name('admin.menu.page.update');
    Route::post('/menu/sections', [AdminMenuController::class, 'storeSection'])->name('admin.menu.sections.store');
    Route::post('/menu/sections/update', [AdminMenuController::class, 'updateSection'])->name('admin.menu.sections.update');
    Route::delete('/menu/sections', [AdminMenuController::class, 'deleteSection'])->name('admin.menu.sections.delete');
    Route::post('/menu/items', [AdminMenuController::class, 'storeItem'])->name('admin.menu.items.store');
    Route::post('/menu/items/update', [AdminMenuController::class, 'updateItem'])->name('admin.menu.items.update');
    Route::delete('/menu/items', [AdminMenuController::class, 'deleteItem'])->name('admin.menu.items.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
