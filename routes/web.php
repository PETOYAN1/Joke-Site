<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ThemeController;
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
Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/dashboard', [ThemeController::class, "createDarkMode"])->name('create-darkMode');
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('dashboard.create');
    Route::post('/posts/create', [PostController::class, 'store'])->name('dashboard.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('dashboard.edit');
    Route::put('/posts/{id}/update', [PostController::class, 'update'])->name('dashboard.update');
    Route::delete('/profile/{id}', [PostController::class, 'destroy'])->name('dashboard.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/{user}/follow', [FollowerController::class, 'follow'])->name('profile.follow');
    Route::post('/profile/{user}/unFollow', [FollowerController::class, 'unFollow'])->name('profile.unFollow');
    Route::post('/profile/{user}/like', [FollowerController::class, 'like'])->name('profile.like');
    Route::post('/profile/{user}/unlike', [FollowerController::class, 'unlike'])->name('profile.unlike');
});

require __DIR__.'/auth.php';
