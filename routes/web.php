<?php

use App\Http\Controllers\Controller;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/test',function (){

    dd(\M\Coupon\Coupon::test());
});

Route::get('/invoiceForm','Controller@invoiceForm');

Route::post('/invoice/post','Controller@invoiceFormPost');
Route::get('/invoice/delete/{id}','Controller@invoiceFormDelete');
Route::get('/invoice/edit/{id}','Controller@invoiceFormEdit');

Route::get('/invoiceList','Controller@invoiceFormList');
Route::get('/invoiceList/data','Controller@invoiceListData');

Route::get('/index', 'Controller@index')->name('index');
Route::post('/index_post', 'Controller@index_post')->name('index_post');
Route::get('/view', 'Controller@view')->name('view');

Route::get('delete/{id}', 'Controller@delete')->name('delete');

Route::get('edit/{id}', 'Controller@edit')->name('edit');

Route::prefix('chess')->group(function () {
        Route::get('user/{userId}','ChessController@userPage' );

        Route::get('user/{userId}/game/host','ChessController@hostGame');
        Route::get('user/{userId}/game/join/{matchId}','ChessController@joinGame');
        Route::post('user/{userId}/game/move/{matchId}','ChessController@moveGame');

        Route::get('user/{userId}/game/start/{matchId}','ChessController@startGame');

        Route::get('user/game/end/{matchId}','ChessController@endGame');




});
