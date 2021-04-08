<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::prefix('admin')->name('admin.')->group(function () {

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::post('', [UserController::class, 'store'])->name('store');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('delete');
        Route::put('{user}', [UserController::class, 'update'])->name('update');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::post('', [CategoryController::class, 'store'])->name('store');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::delete('{category}', [CategoryController::class, 'destroy'])->name('delete');
        Route::put('{category}', [CategoryController::class, 'update'])->name('update');
    });

    Route::prefix('tables')->name('tables.')->group(function () {
        Route::get('', [TableController::class, 'index'])->name('index');
        Route::post('', [TableController::class, 'store'])->name('store');
        Route::get('create', [TableController::class, 'create'])->name('create');
        Route::get('{table}/edit', [TableController::class, 'edit'])->name('edit');
        Route::delete('{table}', [TableController::class, 'destroy'])->name('delete');
        Route::put('{table}', [TableController::class, 'update'])->name('update');
    });


});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
