<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WizardController;
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
    return view('welcome');
});

Route::get('/wizard', [WizardController::class, 'index'])->name('wizard');
Route::post('/wizard', [WizardController::class, 'store'])->name('wizard.store');
// Route::get('/report/{id}', [WizardController::class, 'showReport'])->name('report.show');
Route::get('/report/{id}/download', [WizardController::class, 'downloadPdf'])->name('report.download');