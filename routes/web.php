<?php

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

// Testing Error Validation Request web http dan api http
Route::post("/form/login", [\App\Http\Controllers\FormController::class, "login"]);

// Testing Error Page Validation
Route::get("/form", [\App\Http\Controllers\FormController::class, "form"]);
Route::post("/form", [\App\Http\Controllers\FormController::class, "submitForm"]);
Route::get("/form/request", [\App\Http\Controllers\FormController::class, "formWithFormRequest"]);
Route::post("/form/request", [\App\Http\Controllers\FormController::class, "submitFormWithFormRequest"]);
