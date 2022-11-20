<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TradeHistoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TradeController;
use App\Models\Client;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin','middleware' => 'auth'],function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); 

    Route::group(['prefix' => 'items'], function(){
        Route::get('/',[ItemController::class,'index'])->name('items.index');
        
        Route::get('/add',[ItemController::class,'add'])->name('items.add');

        Route::get('/edit/{item}',[ItemController::class,'edit'])->name('items.edit');
        Route::put('/edit/{item}',[ItemController::class,'update'])->name('items.update');

        Route::post('/',[ItemController::class,'save'])->name('items.save');

        Route::get('/show/{item}',[ItemController::class,'show'])->name('items.show');

        Route::delete('/delete/{item}',[ItemController::class,'delete'])->name('items.delete');

        Route::get('/search',[ItemController::class,'search'])->name('items.search');
    });  

    Route::group(['prefix' => 'trades'], function(){
        Route::get('/',[TradeController::class,'index'])->name('trades.index');

        Route::post('/',[TradeController::class,'save'])->name('trades.save');

        Route::delete('deleteAll',[TradeController::class,'deleteAll'])->name('trades.deleteAll');
        Route::delete('/delete/{trade}',[TradeController::class,'delete'])->name('trades.delete');

        Route::get('/edit/{trade}',[TradeController::class,'edit'])->name('trades.edit');
        Route::put('/edit/{trade}',[TradeController::class,'update'])->name('trades.update');

        
    });

    Route::group(['prefix' => 'tradeHistory'], function(){
        Route::get('/',[TradeHistoryController::class,'index'])->name('tradeHistory.index');

        Route::post('/',[TradeHistoryController::class,'save'])->name('tradeHistory.save');

        Route::delete('/delete/{tradeHistory}',[TradeHistoryController::class,'delete'])->name('tradeHistory.delete');

        Route::get('/show/{tradeHistory}',[TradeHistoryController::class,'show'])->name('tradeHistory.show');

        Route::get('/search',[TradeHistoryController::class,'search'])->name('tradeHistory.search');
    });
    
    Route::group(['prefix' => 'profile'], function(){
        Route::get('/',[ProfileController::class,'index'])->name('profile.index');    
        Route::put('/',[ProfileController::class,'update'])->name('profile.update');
    });

    Route::group(['prefix' => 'clients'], function(){
        Route::get('/',[ClientController::class,'index'])->name('clients.index');

        Route::post('/',[ClientController::class,'save'])->name('clients.save');
        
        Route::get('/show/{client}',[ClientController::class,'edit'])->name('clients.edit');
        Route::put('/show/{client}',[ClientController::class,'update'])->name('clients.update');

        Route::get('/search',[ClientController::class,'search'])->name('clients.search');

        Route::delete('delete/{client}',[ClientController::class,'delete'])->name('clients.delete');

        Route::get('/show/{client}',[ClientController::class,'show'])->name('clients.show');
    });

    Route::group(['prefix' => 'dashboard'], function(){
        Route::get('/',[DashboardController::class,'index'])->name('dashboard.index');
    });
});

