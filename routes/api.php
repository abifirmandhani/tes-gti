<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    "prefix"    => "v1",
    "namespace" => "App\Http\Controllers"
], function(){
    Route::resource('daycares', DaycareController::class);
    Route::post('import', "DaycareController@import");
    Route::get('export', "DaycareController@export");
    Route::get("jobStatus", "DaycareController@getJobStatus");
});
