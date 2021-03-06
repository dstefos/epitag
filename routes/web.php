<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/bundles');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/bundles', App\Http\Livewire\Bundle\Index::class)->name('bundles');
Route::middleware(['auth:sanctum', 'verified'])->get('/cards', App\Http\Livewire\Card\Index::class)->name('cards');
Route::middleware(['auth:sanctum', 'verified'])->get('/marketplace', App\Http\Livewire\Marketplace::class)->name('marketplace');
Route::middleware(['auth:sanctum', 'verified'])->get('/users', App\Http\Livewire\UsersIndex::class)->name('users');
Route::middleware(['auth:sanctum', 'verified'])->get('/usercards/{user}', App\Http\Livewire\UserCards::class)->name('user-cards');