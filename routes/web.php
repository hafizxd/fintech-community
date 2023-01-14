<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Courses\CourseList;
use App\Http\Livewire\Courses\CourseCreate;
use App\Http\Livewire\Threads\ThreadList;
use App\Http\Livewire\Threads\ThreadDetail;

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
    return view('welcome');
});

Route::group(['prefix' => '/threads', 'as' => 'thread.'], function () {
    Route::get('/', ThreadList::class)->name('index');
    Route::get('/details/{thread:slug}', ThreadDetail::class)->name('detail');
});

Route::group(['prefix' => '/classes', 'as' => 'class.'], function () {
    Route::get('/', CourseList::class)->name('index');
    Route::get('/create', CourseCreate::class)->name('create');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
