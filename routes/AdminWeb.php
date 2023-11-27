<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DownloadBookController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SaleController;

Route::get('admin', function () {
    return redirect()->route('admin.login');
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->middleware('guest:admin')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('adminLogin');
    });

    Route::middleware('AdminMiddleware')->group(function () {
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');



        Route::get('add-new-brand', [HomeController::class, 'add_new_brand'])->name('add_new_brand');
        Route::post('insert-brand', [HomeController::class, 'insert_brand'])->name('insert_brand');
        Route::get('edit-brand/{id}', [HomeController::class, 'edit_brand'])->name('edit_brand');
        Route::post('update-brand', [HomeController::class, 'update_brand'])->name('update_brand');
        Route::get('delete-brand/{id}', [HomeController::class, 'delete_brand'])->name('delete_brand');

        Route::get('add-new-user', [HomeController::class, 'add_new_user'])->name('add_new_user');
        Route::post('insert-new-user', [HomeController::class, 'insert_new_user'])->name('insert_new_user');
        Route::get('edit-user/{id}', [HomeController::class, 'edit_user'])->name('edit_user');
        Route::get('delete-user/{id}', [HomeController::class, 'delete_user'])->name('delete_user');
        Route::get('user-profile/{id}', [HomeController::class, 'user_profile'])->name('user_profile');
        Route::get('chart', [HomeController::class, 'chart'])->name('chart');

        Route::get('add-lead', [HomeController::class, 'add_lead'])->name('add_lead');

        Route::get('get-customers', [CustomerController::class, 'index'])->name('get_customers');
        Route::get('create-customers', [CustomerController::class, 'create'])->name('create_customers');
        Route::post('insert-customers', [CustomerController::class, 'insert_new_customer'])->name('insert_new_customer');
        Route::get('customer-edit/{id}', [CustomerController::class, 'customer_edit'])->name('customer.edit');
        Route::post('customer-update', [CustomerController::class, 'customer_update'])->name('customer.update');

        Route::get('sales', [SaleController::class, 'index'])->name('sales');
        Route::get('sales/{id}', [SaleController::class, 'show'])->name('sales.show');

        Route::get('filter', [CustomerController::class, 'filter'])->name('filter');

        Route::get('/generate-pdf/{id}', [HomeController::class, 'generatePdf'])->name('pdf');
    })->middleware('AdminMiddleware');
});

require __DIR__ . '/auth.php';
