<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ServiceLogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['auth', 'verified'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // Users
    Route::controller(UserController::class)->prefix('users')->name('users.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::get('delete/{id}', 'delete')->name('delete');
    });

    //clients
    Route::controller(ClientController::class)->prefix('clients')->name('clients.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::get('delete/{id}', 'delete')->name('delete');
    });

    //Service Logs
    Route::controller(ServiceLogController::class)->prefix('service-logs')->name('service-logs.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::get('delete/{id}', 'delete')->name('delete');
    });

    //Service Logs
    Route::controller(AuditLogController::class)->prefix('audit-logs')->name('audit-logs.')->group(function(){
        Route::get('/', 'index')->name('index');
    });

    // Profile
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function() {
        Route::get('/edit', 'edit')->name('edit');
        Route::put('/update', 'update')->name('update');
    });

});

require __DIR__.'/auth.php';
