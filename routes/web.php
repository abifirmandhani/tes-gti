<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaycareController;

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
    return redirect("daycares");
});
Route::post('file-upload/upload-large-files', [DaycareController::class, 'uploadLargeFiles'])->name('files.upload.large');

Route::group([
    "namespace" => "App\Http\Controllers"
], function(){
    Route::resource('daycares', DaycareViewController::class);
    Route::get('upload', function(){
        return view("upload");
    });
});
