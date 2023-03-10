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

    Route::get('plans', [PlanController::class, 'index'])->name("plans");
    Route::get('plans/{plan}', [PlanController::class, 'show'])->name("plans.show");
    Route::post('subscription', [PlanController::class, 'subscription'])->name("subscription.create");

    Route::get('adminplans', [PlansController::class, 'index'])->name("adminplans");
    Route::get('/certificados/create', function () {
        return view('admin.createPlans');
    })->name('vistacrearplan');
    Route::post('adminplans/create', [PlansController::class, 'create'])->name("adminplans.create");
    Route::get('adminplans/edit/{id}', [PlansController::class, 'edit'])->name("adminplans.edit");
    Route::put('adminplans/edit/{id}', [PlansController::class, 'update'])->name("adminplans.update");
    Route::delete('adminplans/delete/{id}', [PlansController::class, 'delete'])->name("adminplans.delete");
});


