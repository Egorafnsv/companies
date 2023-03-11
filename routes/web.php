<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MainPageController;
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

Route::get('/', [MainPageController::class, 'getIndexPage'])->name('home');
Route::get('/company/{id}', [CompanyController::class, 'getCompanyPage'])->name('company');
Route::post('/add-company', [CompanyController::class, 'addCompany'])->name('addCompany');
Route::post('/del-company', [CompanyController::class, 'delCompany'])->name('delCompany');
Route::post('/get-comments', [CommentController::class, 'getComments'])->name('getComments');
Route::post('/send-comment', [CommentController::class, 'insertComment'])->name('sendComment');
Auth::routes();
