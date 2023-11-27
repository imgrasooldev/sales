<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadAssignController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CustomerController;
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
Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['auth', 'user-access:2'])->group(function () {
    Route::get('/dashboard', function(){
        return 'You Are Fired!';
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('leads', [HomeController::class, 'add_lead'])->name('add_lead');
    Route::get('add-new-lead', [HomeController::class, 'add_new_lead'])->name('add_new_lead');
    Route::post('create-lead', [HomeController::class, 'create_lead'])->name('create_lead');
    Route::get('edit-lead/{id}', [HomeController::class, 'edit_lead'])->name('edit_lead');
    Route::post('update_lead', [HomeController::class, 'update_lead'])->name('update_lead');
    Route::post('add_comment', [HomeController::class, 'add_comment'])->name('add_comment');
    Route::get('comments', [HomeController::class, 'comments'])->name('comments');
    Route::post('assign_lead', [LeadAssignController::class, 'assign'])->name('assign_lead');
    Route::get('/generate-pdf/{id}', [HomeController::class, 'generatePdf'])->name('pdf');
    
    Route::get('get-customers', [CustomerController::class, 'index'])->name('get_customers');
    Route::get('create-customers', [CustomerController::class, 'create'])->name('create_customers');
    Route::post('insert-customers', [CustomerController::class, 'insert_new_customer'])->name('insert_new_customer');
    Route::get('customer-edit/{id}', [CustomerController::class, 'customer_edit'])->name('customer.edit');
    Route::post('customer-update', [CustomerController::class, 'customer_update'])->name('customer.update');

});
Route::middleware(['auth', 'user-access:0'])->group(function () {
    Route::get('dashboard', function(){
        return 'user';
    });
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});
Route::get('chart', [HomeController::class, 'chart'])->name('chart');
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:1'])->group(function () {
    Route::get('leadDashboard', [LeadController::class, 'index'])->name('lead');
    Route::get('user_profile/{id}', [LeadController::class, 'profile'])->name('user_profile');
    // Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});

