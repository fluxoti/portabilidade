<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'v1'], function()
{
    Route::group([], function() {
        Route::get('consult/{number}', 'Api\V1\ConsultController@number');
        Route::get('fullConsult/{number}', 'Api\V1\ConsultController@allData');
        Route::get('simpleConsult', 'Api\V1\ConsultController@simpleConsult');
        Route::post('multipleConsult', 'Api\V1\ConsultController@multipleNumber');
        Route::post('multipleFullConsult', 'Api\V1\ConsultController@multipleFullData');
    });
});