<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'categories'], function() {
        Route::view('/', 'categories.index')->name('categories.index');
        Volt::route('/{category}/edit', 'categories.create')->name('categories.edit');
        Volt::route('/create', 'categories.create')->name('categories.create');
    });
    Route::group(['prefix' => 'Expense'], function() {
        Route::view('/', 'expense.index')->name('expense.index');
        Volt::route('/{expense}/edit', 'expense.create')->name('expense.edit');
        Volt::route('/create', 'expense.create')->name('expense.create');
    });
});
require __DIR__.'/auth.php';
