<?php

use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\IssueController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/', function () {
    return 'Welcome to the API';
});
Route::prefix('issue')->group(function () {
    //Route::resource(IssueController::class);
});
Route::resource('departaments', DepartamentController::class);
