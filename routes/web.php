<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScanController;

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

Route::view('/', 'index');
Route::view('/index', 'index')->name('home');




Route::get('/URL-option', [ScanController::class, 'showForm'])->name('URL-option');
Route::get('/domain-result', [ScanController::class, 'domain_result'])->name('domain-result');

//scan
Route::post('/scan', [ScanController::class, 'scan'])->name('scan');
Route::get('/download-report', [ScanController::class, 'downloadReport'])->name('downloadReport');

