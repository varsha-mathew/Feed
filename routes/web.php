<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('Feeds', [AuthController::class, 'Feeds'])->name('Feeds');
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'Login'])->name('login.custom'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'register'])->name('register.custom'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');