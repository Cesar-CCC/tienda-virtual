<?php

use App\Http\Controllers\Admin\PlansController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\FaceBookController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [PlanController::class, 'index']);
Route::get('plans/{plan}', [PlanController::class, 'show'])->name("plans.show");
Route::post('subscription', [PlanController::class, 'subscription'])->name("subscription.create");

// Facebook Login URL
Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/plans',[PlansController::class,'index'])->name('plans');
    Route::post('/dashboard/plans/create', [PlansController::class, 'create'])->name("plans.create");

});


