<?php

use App\Http\Controllers\GreetingController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 文字列を返すルート
Route::get('/hello', function () {
    return 'こんにちは！これは文字列を返すルートです。';
});

// ビューを返すルート
Route::get('/about', function () {
    return view('about');
});

// 人関連のルート
Route::get('/people', [PersonController::class, 'index'])->name('people.index');
Route::get('/people/create', [PersonController::class, 'create'])->name('people.create');
Route::post('/people', [PersonController::class, 'store'])->name('people.store');

// 挨拶関連のルート
Route::get('/greetings', [GreetingController::class, 'index'])->name('greetings.index');
Route::get('/greetings/create', [GreetingController::class, 'create'])->name('greetings.create');
Route::post('/greetings', [GreetingController::class, 'store'])->name('greetings.store');
Route::delete('/greetings/{greeting}', [GreetingController::class, 'destroy'])->name('greetings.destroy');
