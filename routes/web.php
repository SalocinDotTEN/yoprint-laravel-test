<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProcessCSVController;
use App\Http\Controllers\CsvToDbController;
use App\Http\Controllers\ShowDatabaseController;

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
    return view('uploader');
});

Route::controller(ProcessCSVController::class)->group(function(){
    Route::post('/csv-uploader', 'storeCsv');
});

Route::controller(CsvToDbController::class)->group(function(){
    Route::post('/csv-to-db', 'updatedb');
});

Route::controller(ShowDatabaseController::class)->group(function(){
    Route::get('/dbviewer', 'index');
});
