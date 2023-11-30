<?php

use Illuminate\Support\Facades\Route;

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

//LoginController routes
Route::controller(App\Http\Controllers\Auth\LoginController::class)->group(function () 
{
    //login form
    Route::get('/login', 'loginForm')->name('login.form');
    Route::get('/', 'loginForm');

    //login
    Route::post('/login', 'login')->name('login');

    //logout
    Route::any('/logout', 'logout')->name('logout');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function()
{
    //TaskController routes
    Route::controller(App\Http\Controllers\TaskController::class)->group(function () 
    {
        Route::get('index-task', 'index')->name('task.index');
        Route::get('add-task', 'add')->name('task.add');
        Route::post('store-task', 'store')->name('task.store');
        Route::get('show-task/{id}', 'show')->name('task.show');
        Route::get('edit-task/{id}', 'edit')->name('task.edit');
        Route::post('update-task', 'update')->name('task.update');
        Route::get('delete-task/{id}', 'delete')->name('task.delete');
    });

});