<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Groups\GroupDetails;
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/guid', function () {
        return view('guid');
    })->name('guid');

    // Route::get('/groups/{groupId}', function () {
    //     return view('group');
    // })->name('groups.show');

    Route::get('/groups/{groupId}', GroupDetails::class)->name('groups.show');

//    Route::get('/groups/{id}', GroupDetails::class)->name('groups.show');

});
