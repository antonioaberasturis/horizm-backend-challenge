<?php

use App\Http\Controllers\PostsApiController;
use Application\Api\Post\PostGetController;
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

Route::prefix('posts')->group(function(){
    Route::get('/{id}', [PostGetController::class, '__invoke'])->whereUuid('id');
});
