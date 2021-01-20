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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Countries */
Route::apiResource('countries','App\Http\Controllers\CountryController');

/* Countries */
Route::apiResource('companies','App\Http\Controllers\CompanyController');

/* Countries */
Route::apiResource('users','App\Http\Controllers\UserController');

Route::get('country/{name}', 'App\Http\Controllers\CountryController@getByName');
Route::post('pdf', 'App\Http\Controllers\PdfController@fileUpload');