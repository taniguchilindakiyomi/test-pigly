<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PiglyController;


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

Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [PiglyController::class, 'index'])->name('weight_logs');

    Route::get('/weight_logs/goal_setting', [PiglyController::class, 'goalSetting'])->name('weight_logs.goal_setting');

    Route::get('/weight_logs/create', [PiglyController::class, 'create']);
    Route::post('/weight_logs/create', [PiglyController::class, 'store']);


    Route::post('/logout', [PiglyController::class, 'logout']);

    Route::get('/weight_logs/search', [PiglyController::class, 'search'])->name('weight_logs.search');

    Route::get('/weight_logs/{weightLogId}', [PiglyController::class, 'edit'])->name('weight_logs.edit');
    Route::patch('/weight_logs/{weightLogId}/update', [PiglyController::class, 'update'])->name('weight_logs.update');


    Route::delete('/weight_logs/{weightLogId}/delete', [PiglyController::class, 'destroy'])->name('weight_logs.destroy');

});


Route::middleware('guest')->group(function () {
    Route::get('/register/step1', [PiglyController::class, 'showStep1Form'])->name('register.step1');
    Route::post('/register/step1', [PiglyController::class, 'processStep1']);

    Route::get('/register/step2', [PiglyController::class, 'showStep2Form'])->name('register.step2');
    Route::post('/register/step2', [PiglyController::class, 'processStep2']);



});
