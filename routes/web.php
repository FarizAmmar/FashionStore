<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// ------ NEW SCHEMA -------

// Index
Route::get('/', [UserController::class, 'index'])->name('userLogin')->middleware('guest');
Route::post('/', [UserController::class, 'authenticate'])->name('userLogin.auth');

// Store
Route::get('/store', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Show By Details Product
Route::get('/details/{product:short_name}', [HomeController::class, 'show'])->middleware('auth');

// Show By List Category
Route::get('/category/{category:short_name}', [CategoryController::class, 'show'])->name('category')->middleware('auth');

// Order Product
Route::post('/details/order', [HomeController::class, 'store'])->middleware('auth');
Route::get('/myorders/{username}', [OrderController::class, 'show'])->middleware('auth')->name('myorder');
Route::put('/myorders/{id}', [OrderController::class, 'update'])->middleware('auth')->name('myorder.update');
Route::delete('/myorders/{id}', [OrderController::class, 'destroy'])->middleware('auth')->name('myorder.delete');

// Contact Page
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact/send', [ContactController::class, 'store'])->name('contact.send');

// FAQ Page
Route::get('/faq', [FAQController::class, 'index']);



// Login Admin
Route::get('/admin/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// Admin
Route::middleware(['admin.access'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

    // Admin Product Index
    Route::get('/dashboard/product', [ProductController::class, 'index'])->name('product.index')->middleware('auth');
    Route::get('/product/new', [ProductController::class, 'create'])->name('product.create')->middleware('auth');
    Route::post('/product/stored', [ProductController::class, 'store'])->name('product.stored')->middleware('auth');
    Route::post('/product/{product:short_name}', [ProductController::class, 'edit'])->name('product.edit')->middleware('auth');
    Route::put('/product/update/{product:short_name}', [ProductController::class, 'update'])->name('product.update')->middleware('auth');
    Route::delete('/product/{product:short_name}', [ProductController::class, 'destroy'])->name('product.delete')->middleware('auth');

    // Admin Category
    Route::get('/dashboard/category', [CategoryController::class, 'index'])->name('category.index')->middleware('auth');
    Route::post('/category/stored', [CategoryController::class, 'store'])->name('category.stored')->middleware('auth');
    Route::put('/category/update/{category:short_name}', [CategoryController::class, 'update'])->name('category.update')->middleware('auth');
    Route::delete('/category/{category:short_name}', [CategoryController::class, 'destroy'])->name('category.delete')->middleware('auth');

    // Admin Order
    Route::get('/dashboard/order', [OrderController::class, 'index'])->name('order.index')->middleware('auth');
});


// // Login or Logout
// Route::get('/', [LoginController::class, 'show'])->name('login')->middleware('guest');
// Route::post('/', [LoginController::class, 'authenticate']);
// Route::post('/logout', [LoginController::class, 'logout']);

// // Home or Dashboard
// Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

// // Employee
// Route::get('/employee', [EmployeeController::class, 'index']);
// Route::delete('/employee/{username}', [EmployeeController::class, 'destroy']);

// // New Employee
// Route::get('/new-employee', [EmployeeController::class, 'create']);
// Route::post('/new-employee', [EmployeeController::class, 'store']);

// // Edit
// Route::get('/edit-employee/{user:username}/edit', [EmployeeController::class, 'edit']);
// Route::put('/employee/{user:username}', [EmployeeController::class, 'update']);

// // Salary
// Route::get('/salary', [SalaryController::class, 'show']);

// Route::get('/absensi', [AbsensiController::class, 'show']);
// Route::get('/new-absensi', [AbsensiController::class, 'new']);
// Route::get('/edit-absensi', [AbsensiController::class, 'edit']);
// Route::get('/potongan', [PotonganController::class, 'index']);
// Route::get('/new-potongan', [PotonganController::class, 'new']);
// Route::get('/edit-potongan', [PotonganController::class, 'edit']);
// Route::get('/report', [ReportController::class, 'show']);
// Route::get('/report-view', [ReportController::class, 'view']);
