<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:13 PM
 */

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

/*
|--------------------------------------------------------------------------
| Backend routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:api')->prefix('{api_version}/authors')->as('api.backend.authors.')->where(['api_version' => get_api_versions()])->group(static function () {
    Route::apiResource('', 'Api\Backend\V1\AuthorController', ['parameters' => ['' => 'id']]);
});

Route::middleware('auth:api')->prefix('{api_version}/books')->as('api.backend.books.')->where(['api_version' => get_api_versions()])->group(static function () {
    Route::apiResource('', 'Api\Backend\V1\BookController', ['parameters' => ['' => 'id']]);
    Route::delete('/un-publish/{id}', 'Api\Backend\V1\BookController@unPublish')->name('un_publish');
});





/*
|--------------------------------------------------------------------------
| Frontend routes
|--------------------------------------------------------------------------
*/
