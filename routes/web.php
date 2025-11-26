<?php

use App\Http\Controllers\PlacesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlacePublicController;
use App\Http\Controllers\HighchartsController;


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
    return view('welcome');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});







Route::middleware(['auth'])->group(function () {
    Route::resource('places', PlacesController::class);
});



Route::get('/locais', [PlacePublicController::class, 'index'])->name('places.public.index');
Route::get('/locais/{place}', [PlacePublicController::class, 'show'])->name('places.public.show');
Route::post('/locais/{place}/comentar', [PlacePublicController::class, 'comentar'])
    ->middleware('auth')
    ->name('places.public.comentar');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('highcharts')->group(function () {
    Route::get('/top-rated', [HighchartsController::class, 'topRated']);
    Route::get('/most-commented', [HighchartsController::class, 'mostCommented']);
    Route::get('/category-average', [HighchartsController::class, 'categoryAverage']);
    Route::get('/category-total', [HighchartsController::class, 'categoryTotal']);
});








require __DIR__ . '/auth.php';
