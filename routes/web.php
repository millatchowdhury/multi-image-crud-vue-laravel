<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get("/image-create", [ImageController::class, 'index'])->name('image.index');
Route::post("/image-store", [ImageController::class, 'store'])->name('image.store');
Route::get("/image-list",   [ImageController::class, 'list'])->name('image.list');
Route::get("/image-show/{id}", [ImageController::class, 'show'])->name('image.show');
Route::get("/image-edit-show/{id}", [ImageController::class, 'editShow'])->name('image.edit.show');
Route::get("/image-update/{id}", [ImageController::class, 'updateImage'])->name('image.update');
//Route::post("/image-update-insert", [ImageController::class, 'updateImageInsert'])->name('image.update.store'); // another way
Route::post("/image-update-insert/{id}", [ImageController::class, 'updateImageInsert'])->name('image.update.store'); // right way

Route::get('/image-delete/{id}', [ImageController::class, 'imageDelte'])->name('image.delete');


require __DIR__.'/auth.php';
