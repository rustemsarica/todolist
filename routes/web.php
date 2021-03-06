<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ToDoListController;
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

Route::get('/', [ToDoListController::class, 'index'])->name('index');
Route::post('task-post', [ToDoListController::class, 'taskPost'])->name('task.store');
Route::post('ajaxRequest', [ToDoListController::class, 'ajaxRequestDelete'])->name('ajaxRequest.delete');
Route::post('ajaxRequestStatus', [ToDoListController::class, 'ajaxRequestStatus'])->name('ajaxRequest.status');
Route::post('ajaxRequestSearch', [ToDoListController::class, 'ajaxRequestSearch'])->name('ajaxRequest.search');