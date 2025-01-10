<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FaqController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/faq', [FaqController::class, 'index'])->name('faqs.index'); // Lista FAQ
Route::get('/faq/{faq}', [FaqController::class, 'show'])->name('faqs.show'); // Szczegóły FAQ
Route::get('/faq/export/pdf', [FaqController::class, 'exportToPdf'])->name('faqs.export.pdf'); // Eksport do PDF



use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');


// Formularz kontaktowy (opcjonalne)
Route::get('/kontakt', function () {
    return view('contact');
})->name('contact');

require __DIR__.'/auth.php';
use App\Http\Controllers\AdminFaqController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminTagController;

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.index'); // Strona główna panelu admina

    // Zarządzanie FAQ
    // Route::resource('admin/faqs', AdminFaqController::class)->names([
    //     'index' => 'admin.faqs.index',
    //     'create' => 'admin.faqs.create',
    //     'store' => 'admin.faqs.store',
    //     'show' => 'admin.faqs.show',
    //     'edit' => 'admin.faqs.edit',
    //     'update' => 'admin.faqs.update',
    //     'destroy' => 'admin.faqs.destroy',
    // ]);

    // Zarządzanie kategoriami
    // Route::resource('admin/categories', AdminCategoryController::class)->names([
    //     'index' => 'admin.categories.index',
    //     'create' => 'admin.categories.create',
    //     'store' => 'admin.categories.store',
    //     'edit' => 'admin.categories.edit',
    //     'update' => 'admin.categories.update',
    //     'destroy' => 'admin.categories.destroy',
    // ]);

    // Zarządzanie tagami
    // Route::resource('admin/tags', AdminTagController::class)->names([
    //     'index' => 'admin.tags.index',
    //     'create' => 'admin.tags.create',
    //     'store' => 'admin.tags.store',
    //     'edit' => 'admin.tags.edit',
    //     'update' => 'admin.tags.update',
    //     'destroy' => 'admin.tags.destroy',
    // ]);
});
