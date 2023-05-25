<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BansController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CasinoController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\WorkersController;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        /**
         * Workers resource 
         */
        Route::resource('workers', WorkersController::class);

        /**
         * Casinos done resources
         */
        Route::get('casinos-done', 'PlayersController@index')->name('casinos-done');
        Route::get('new-casino-done', 'PlayersController@create')->name('new-casino-done');
        Route::post('players.store', 'PlayersController@store')->name('players.store');
        Route::patch('players/{id}/update', 'PlayersController@update')->name('players.update');
        Route::get('players/{id}/edit', 'PlayersController@edit')->name('players.edit');
        Route::post('players.destroy', 'PlayersController@edit')->name('players.destroy');

        /**
         * Slots Route
         */
        Route::resource('slot', SlotController::class);

        /**
         * Slots Route
         */
        Route::resource('gnomeinfo', GnomeinfoController::class);

        /**
         * Groups Route
         */
        Route::resource('groups', GroupController::class);
        /**
         * Casino Route
         */
        Route::resource('casinos', CasinoController::class);


        Route::resource('bonus', BonusController::class);

        Route::resource('bans', BansController::class);
    });
    
});