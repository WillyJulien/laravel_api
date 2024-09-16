<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdministratorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route group protected by 'auth:public' middleware for brute force attacks .
Route::middleware(['throttle:public'])->group(function () {
    // The route is used to control the form input data and grant or deny access to the user. 
    Route::post('admin/login', [AdministratorController::class, 'login'])->name('login.perform');
    // The route is public so that any user can see the list of active profiles.
    Route::get('profile', [ProfileController::class, 'index'])->name('profiles.index');
});


// Route group protected by 'auth:sanctum' middleware for API authentication.
// Route group protected by 'auth:api' middleware for brute force attacks .
Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
    // Generates RESTful routes (store, show, update, destroy) for the ProfileController.
    Route::apiResource('profile', ProfileController::class)->except('index');
    Route::post('admin/logout', [AdministratorController::class, 'logout'])->name('login.logout');
});



