<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
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
    return redirect()->route('login');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/chart-pie', [HomeController::class, 'getPieChart'])->middleware(['auth', 'verified'])->name('chart-pie');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('', [AdminController::class, 'index'])->name('index');
        Route::post('store', [AdminController::class, 'store'])->name('store');
        Route::put('update', [AdminController::class, 'update'])->name('update');
        Route::get('delete/{id}', [AdminController::class, 'delete'])->name('delete');
    });
    
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::delete('delete/{id}', [UserController::class, 'delete'])->name('delete');
    });
    
    Route::prefix('recipe')->name('recipe.')->group(function () {
        Route::get('', [RecipeController::class, 'index'])->name('index');
        Route::post('store', [RecipeController::class, 'store'])->name('store');
        Route::put('update', [RecipeController::class, 'update'])->name('update');
        Route::get('delete/{id}', [RecipeController::class, 'delete'])->name('delete');
    });
});

require __DIR__.'/auth.php';
