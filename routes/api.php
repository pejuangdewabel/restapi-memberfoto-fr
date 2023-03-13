<?php

use App\Model\MemberFoto;
use Facade\FlareClient\Http\Response;
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

Route::resource('member-foto', 'Api\MemberFotoController');
Route::resource('member-data', 'Api\MemberDataController');
Route::resource('member-document', 'Api\MemberDocumentController');
Route::get('get-foto/{authorization}/{id}', 'Api\MemberFotoController@getFoto')->name('api-getFoto');
