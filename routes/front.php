<?php
use Illuminate\Support\Facades\Route;

if(config('platform.enable_front')) {
    Route::get('/', QuickPanel\Platform\Livewire\Front\Home\Index::class)->name('home');
}
