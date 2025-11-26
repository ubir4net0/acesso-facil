<?php

use App\Http\Controllers\PlacesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlacePublicController;
use App\Http\Controllers\Api\ChartController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//ROTAS DE ADMIN FICARAO ASSIM:
// Route::get('/teste',[gatescontroller::class,'teste'])
// ->name('teste teste')
// ->middleware('can:access');



Route::middleware(['auth'])->group(function () {
    Route::resource('places', PlacesController::class);
});



Route::get('/locais', [PlacePublicController::class, 'index'])->name('places.public.index');
Route::get('/locais/{place}', [PlacePublicController::class, 'show'])->name('places.public.show');
Route::post('/locais/{place}/comentar', [PlacePublicController::class, 'comentar'])
    ->middleware('auth')
    ->name('places.public.comentar');

Route::get('/charts/top-rated', [ChartController::class, 'topRatedPlaces']);
Route::get('/charts/most-commented', [ChartController::class, 'mostCommentedPlaces']);
Route::get('/charts/category-average', [ChartController::class, 'categoryAverageRatings']);
Route::get('/charts/category-total', [ChartController::class, 'categoryTotalRatings']);









require __DIR__ . '/auth.php';

