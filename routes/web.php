<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CallendarController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('comment', CommentController::class);

    Route::get('fullcalender', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('fullcalenderAjax', [CalendarController::class, 'ajax']);

    Route::get('/message', [CalendarController::class, 'showAlert']);
    Route::get('/seen', [CalendarController::class, 'seen']);

    Route::get('chart', [HomeController::class, 'chart'])->name('chart');
    Route::get('download-pdf/{id}', [HomeController::class,'generatePdf'])->name('pdf');
    Route::get('filter', [CustomerController::class, 'filter'])->name('filter');
    // Route::get('add-new-brand', [HomeController::class, 'add_new_brand'])->name('add_new_brand');
    // Route::post('insert-brand', [HomeController::class, 'insert_brand'])->name('insert_brand');
    // Route::get('edit-brand/{id}', [HomeController::class, 'edit_brand'])->name('edit_brand');
    // Route::post('update-brand', [HomeController::class, 'update_brand'])->name('update_brand');
    // Route::get('delete-brand/{id}', [HomeController::class, 'delete_brand'])->name('delete_brand');
});
