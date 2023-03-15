<?php

use App\Http\Controllers\ProjectController;
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
    return view('dashboard');
});

// Route::get('/project/list', [ProjectController::class, 'index'])->name('project.index');
// Route::get('/project/new', [ProjectController::class, 'form'])->name('project.create');
// Route::post('/project/update', [ProjectController::class, 'update'])->name('project.update');

Route::resource('project', ProjectController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
