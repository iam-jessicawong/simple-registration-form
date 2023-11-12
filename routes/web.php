<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

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

Route::get('/', [RegistrationController::class, 'index'])->name('index');
Route::get('/all', [RegistrationController::class, 'all'])->name('all');
Route::post('/store', [RegistrationController::class, 'store'])->name('store');
Route::put('/update/{id}', [RegistrationController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [RegistrationController::class, 'destroy'])->name('destroy');
