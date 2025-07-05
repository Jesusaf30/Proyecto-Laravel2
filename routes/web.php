<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\StockEntryController;
use App\Http\Controllers\StockExitController;

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
    return redirect()->route('medicines.index');
});

Route::resource('medicines', MedicineController::class);
Route::resource('stock-entries', StockEntryController::class);
Route::resource('stock-exits', StockExitController::class);
