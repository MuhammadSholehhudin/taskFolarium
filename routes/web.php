<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\PegawaiController;
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

// Route::get('/', function () {
//     return view('index');
// });

Route::resource('/employee', EmployeeController::class);
//Route get => employee => index
//Route get => employee/create => create
//Route post => employee => store
//Route get => employee/{id} => show
//Route put => employee/{id} => update
//Route delete => employee/{id} => delete
//Route get => employee/{id}/edit => edit

Route::get('/pegawai', [PegawaiController::class, 'indexView'])->name('pegawai.index');
Route::get('/kontrak', [KontrakController::class, 'indexView'])->name('kontrak.index');


