<?php
use Illuminate\Support\Facades\Route;

if(config('platform.enable_front')) {
    Route::middleware('web')->group(function () {
        Route::get('/', QuickPanel\Platform\Livewire\Front\Home\Index::class)->name('home');
    });
}
