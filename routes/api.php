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


// Route group protected by 'auth:sanctum' middleware for API authentication.
Route::middleware('auth:sanctum')->group(function () {
    // Generates RESTful routes (index, store, show, update, destroy) for the ProfileController.
    Route::apiResource('profile', ProfileController::class);
    Route::post('admin/logout', [AdministratorController::class, 'logout'])->name('login.logout');
});


// The route is used to control the form input data and grant or deny access to the user. 
Route::post('admin/login', [AdministratorController::class, 'login'])->name('login.perform');
