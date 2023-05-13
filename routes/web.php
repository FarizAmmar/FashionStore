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

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Show By Details Product
Route::get('/details/{product:short_name}', [HomeController::class, 'show']);

// Show By List Category
Route::get('/category/{category:short_name}', [CategoryController::class, 'show'])->name('category');

// Order Product
Route::post('/details/order', [HomeController::class, 'store']);

// Contact Page
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact/send', [ContactController::class, 'store'])->name('contact.send');

// FAQ Page
Route::get('/faq', [FAQController::class, 'index']);


// Admin
// Login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

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
