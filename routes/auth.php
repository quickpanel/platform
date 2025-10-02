<?php
use Illuminate\Support\Facades\Route;

if(config('platform.enable_user')) {
    Route::middleware('web')->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('/login', QuickPanel\Platform\Livewire\Auth\Login::class)->name('login');
            Route::get('/register', QuickPanel\Platform\Livewire\Auth\Register::class)->name('register');
            Route::get('/forget-password', QuickPanel\Platform\Livewire\Auth\ForgetPassword::class)->name('forget-password');

            Route::get('/auth/google/redirect', [\QuickPanel\Platform\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('auth.google.redirect');
            Route::any('/auth/google/callback', [\QuickPanel\Platform\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

            Route::get('/auth/github/redirect', [\QuickPanel\Platform\Http\Controllers\Auth\GithubController::class, 'redirectToGithub'])->name('auth.github.redirect');
            Route::any('/auth/github/callback', [\QuickPanel\Platform\Http\Controllers\Auth\GithubController::class, 'handleGithubCallback'])->name('auth.github.callback');
        });

        Route::middleware('auth')->group(function () {
            Route::get('/logout', QuickPanel\Platform\Livewire\Auth\Logout::class)->name('logout');
            Route::get('/change-password', QuickPanel\Platform\Livewire\Auth\ChangePassword::class)->name('change-password');
            Route::get('/verify-email', QuickPanel\Platform\Livewire\Auth\VerifyEmail::class)->name('verify-email');
        });
    });
}
