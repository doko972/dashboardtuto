<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function(){

    //Get Videos datas
    Route::get('/videos', 'App\Http\Controllers\VideoController@index')->name('video.index');

    //Show Video by Id
    Route::get('/videos/show/{id}', 'App\Http\Controllers\VideoController@show')->name('video.show');

    //Get Videos by Id
    Route::get('/videos/create', 'App\Http\Controllers\VideoController@create')->name('video.create');

    //Edit Video by Id
    Route::get('/videos/edit/{id}', 'App\Http\Controllers\VideoController@edit')->name('video.edit');

    //Save new Video
    Route::post('/videos/store', 'App\Http\Controllers\VideoController@store')->name('video.store');

    //Update One Video
    Route::put('/videos/update/{video}', 'App\Http\Controllers\VideoController@update')->name('video.update');

    //Update One Video Speedly
    Route::put('/videos/speed/{video}', 'App\Http\Controllers\VideoController@updateSpeed')->name('video.update.speed');

    //Delete Video
    Route::delete('/videos/delete/{video}', 'App\Http\Controllers\VideoController@delete')->name('video.delete');

});