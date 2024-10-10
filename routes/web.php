<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ScrapperController;
use App\Http\Controllers\TradeHistoryController;
use App\Http\Controllers\TradesController;
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
Route::get('/', IndexController::class);

Route::get('/note/{id}', [NotesController::class, 'show'])->name('getnote');
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'create'])->name('dashboard');
    Route::get('/dashboard/range/{range}', [DashboardController::class, 'create']);

    Route::get('/trades/{id}', [TradesController::class, 'trades'])->name('trades');
    
    Route::get('/trade/{trader}/{id}', [TradesController::class, 'show']);
    Route::delete('/trade/delete/{id}', [TradesController::class, 'destroy']);
    Route::put('/trade/update/{id}', [TradesController::class, 'update']);

    Route::post('/addRecord/{id}', [TradeHistoryController::class, 'store'])->name('addRecord');
    Route::delete('/tradehistory/{id}', [TradeHistoryController::class, 'destroy']);

    Route::post('/image', [ImageController::class, 'store']);
    Route::delete('image/{id}', [ImageController::class, 'destroy']);

    Route::get('/addtrade', [TradesController::class, 'create']);
    Route::post('/addtrade', [TradesController::class, 'store']);

    Route::get('/note/{id}', [NotesController::class, 'show']);
    Route::post('/note/{id}', [NotesController::class, 'store'])->name('storeNote');
    Route::delete('/note/delete/{id}', [NotesController::class, 'destroy']);

    Route::get('/reports', [ReportsController::class, 'create']);

    Route::get('/experts', [ExpertController::class, 'show'])->name('experts');
    Route::get('/experts/name', [ExpertController::class, 'withName'])->name('withname');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'create'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('profile/changepassword', [PasswordController::class, 'create'])->name('profile.changepassword');
    Route::patch('profile/changepassword', [PasswordController::class, 'update'])->name('profile.updatepassword');
});

Route::get('/setupstocks', [ScrapperController::class, 'setupStocks']);
Route::get('/scrape', [ScrapperController::class, 'scrape']);

require __DIR__.'/auth.php';
