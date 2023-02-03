<?php

    use App\Http\Controllers\Auth\AuthenticatedSessionController;
    use App\Http\Controllers\Auth\NewPasswordController;
    use App\Http\Controllers\Auth\PasswordResetLinkController;
    use App\Http\Controllers\Auth\RegisteredUserController;
    use App\Http\Controllers\UserController;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    //Protected Routes
    Route::middleware(['auth:sanctum'])->group(function () {

        Route::post('/add-user-preference', [UserController::class, 'addUserPreference'])->name('add-user-preference');
        Route::post('/get-user-preference', [UserController::class, 'getUserPreference'])->name('get-user-preference');
        Route::post('/get-user-preferences', [UserController::class, 'getUserPreferences'])->name('get-user-preferences');
        Route::post('/change-password',[UserController::class,'changePassword'])->name('change-password');



        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->middleware('auth')
            ->name('logout');

    });

    //Public Routes

    Route::get('get-articles', [\App\Http\Controllers\NewsController::class, 'getArticles'])->name('get-articles');
    Route::get('get-sources', [\App\Http\Controllers\NewsController::class, 'getSources'])->name('get-sources');
    Route::get('get-top-headlines', [\App\Http\Controllers\NewsController::class, 'getTopHeadLines'])->name('get-top-headlines');
    Route::get('search', [\App\Http\Controllers\NewsController::class, 'search'])->name('search');
    Route::get('get-categories', [\App\Http\Controllers\NewsController::class, 'getCategories'])->name('get-categories');


    //Auth
    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest')
        ->name('register');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest')
        ->name('login');

    //Password reset
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('guest')
        ->name('password.email');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest')
        ->name('password.store');




