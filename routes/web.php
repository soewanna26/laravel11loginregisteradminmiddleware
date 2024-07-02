<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AccountController::class, 'login'])->name('login');
        Route::post('/authenticate', [AccountController::class, 'authenticate'])->name('authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        //Admin Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [AccountController::class, 'logout'])->name('logout');

        //Profile
        Route::get('/profile', [AdminProfileController::class, 'profile'])->name('profile');
        Route::get('/profile-create', [AdminProfileController::class, 'profileCreate'])->name('profileCreate');
        Route::post('/profile-store', [AdminProfileController::class, 'profileStore'])->name('profileStore');
        Route::get('/profile-edit/{id}', [AdminProfileController::class, 'profileEdit'])->name('profileEdit');
        Route::post('/profile-update/{id}', [AdminProfileController::class, 'profileUpdate'])->name('profileUpdate');
        Route::get('/profile-delete/{id}', [AdminProfileController::class, 'profileDelete'])->name('profileDelete');

        //User
        Route::get('/user', [AdminUserController::class, 'user'])->name('user');
        Route::get('/user-create', [AdminUserController::class, 'userCreate'])->name('userCreate');
        Route::post('/user-store', [AdminUserController::class, 'userStore'])->name('userStore');
        Route::get('/user-edit/{id}', [AdminUserController::class, 'userEdit'])->name('userEdit');
        Route::post('/user-update/{id}', [AdminUserController::class, 'userUpdate'])->name('userUpdate');
        Route::get('/user-delete/{id}', [AdminUserController::class, 'userDelete'])->name('userDelete');
    });
});

Route::get('/register', [AccountController::class, 'register'])->name('register');
Route::post('/process-registration', [AccountController::class, 'processRegistration'])->name('processRegistration');
Route::get('/forgot-password', [AccountController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/process-forgot-password', [AccountController::class, 'processForgotPassword'])->name('processForgotPassword');
Route::get('/rest-password/{token}', [AccountController::class, 'restPassword'])->name('restPassword');
Route::post('/process-reset-password', [AccountController::class, 'processResetPassword'])->name('processResetPassword');
