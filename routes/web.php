<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;



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

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');


use App\Http\Controllers\FaqController;

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index'); // Lista FAQ
Route::get('/faq/{faq}', [FaqController::class, 'show'])->name('faq.show'); // Szczegóły FAQ
Route::get('/faq/export/pdf', [FaqController::class, 'exportToPdf'])->name('faq.export.pdf'); // Eksport do PDF



use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('category.show');



use App\Http\Controllers\AdminFaqController ;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminDashboardController;

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class,'index'])->name('admin.dashboard');

    Route::resource('faqs', AdminFaqController::class)->names([
        'index' => 'admin.faqs.index',
        'create' => 'admin.faqs.create',
        'store' => 'admin.faqs.store',
        'edit' => 'admin.faqs.edit',
        'update' => 'admin.faqs.update',
        'destroy' => 'admin.faqs.destroy',
    ]);
    Route::resource('categories', AdminCategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);
    Route::get('categories/{category}/change-image', [AdminCategoryController::class, 'changeImage'])
        ->name('admin.categories.changeImage');
    Route::put('categories/{category}/update-image', [AdminCategoryController::class, 'updateImage'])
        ->name('admin.categories.updateImage');
});

use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



use App\Http\Controllers\Admin\SearchQueryController;

Route::get('/admin/search-queries', [SearchQueryController::class, 'index'])->name('admin.search-queries');
Route::post('/admin/search-queries', [SearchQueryController::class, 'index'])->name('admin.search-queries');

Route::patch('/admin/categories/{category}/update-order', [CategoryController::class, 'updateOrder'])->name('admin.categories.updateOrder');

Route::patch('/admin/categories/{category}/move-up', [AdminCategoryController::class, 'moveUp'])->name('admin.categories.moveUp');
Route::patch('/admin/categories/{category}/move-down', [AdminCategoryController::class, 'moveDown'])->name('admin.categories.moveDown');

use App\Http\Controllers\AdminSettingsController;

Route::post('/admin/settings/update', [AdminSettingsController::class, 'update'])->name('admin.settings.update');

