<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RefreshController;
use App\Http\Controllers\VideoController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'overview')->name('home');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy-policy');

Route::middleware(['auth'])->group(function (){
    Route::get('video/id/{id}', [VideoController::class, 'getVideoMetaDataById']);
    Route::get('refresh', [RefreshController::class, 'refreshAll'])->name('refresh');
    Route::resource('videos', VideoController::class)->except('edit','update');

    Route::resource('events', EventController::class);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__ . '/auth.php';
