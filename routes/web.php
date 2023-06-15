<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BansController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CasinoController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\WorkersController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\ProfitrangeController;

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
    Route::get('/', 'OverviewController@index')->name('overview.index');
    // Route::get('/', 'HomeController@index')->name('overview.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');
        Route::get('/userlists', 'RegisterController@index')->name('register.userlists');
        Route::get('/user/{id}/edit', 'RegisterController@edit')->name('register.edit');
        Route::patch('/user/{id}/update', 'RegisterController@update')->name('register.update');
        Route::delete('/user/{id}/destroy', 'RegisterController@destroy')->name('register.destroy');


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
        Route::get('casinos-done/{type}/lists', 'PlayersController@index')->name('casinos-done-lists');
        Route::get('casinos-summary', 'PlayersController@summary')->name('casinos-summary');
        Route::get('new-casino-done', 'PlayersController@create')->name('new-casino-done');
        Route::post('players.store', 'PlayersController@store')->name('players.store');
        Route::patch('players/{id}/update', 'PlayersController@update')->name('players.update');
        Route::patch('players/{id}/ajaxupdate', 'PlayersController@ajaxupdate')->name('players.ajaxupdate');
        Route::get('players/{id}/edit', 'PlayersController@edit')->name('players.edit');
        Route::delete('players/{id}/destroy', 'PlayersController@destroy')->name('players.destroy');
        Route::post('players.ajaxstore', 'PlayersController@ajaxstore')->name('players.ajaxstore');

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
        Route::resource('profit', ProfitrangeController::class);
        
        Route::post('overview', 'OverviewController@index');
        Route::resource('overview', OverviewController::class, ['except' => ['store']]);
    });
    
});