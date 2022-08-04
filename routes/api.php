<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

/* The specified routes below have "/api" added before since the api route file is used */
Route::get("/", [EmployeeController::class, "index"]);
Route::post("/add", [EmployeeController::class, "add"]);
Route::post("/edit", [EmployeeController::class, "edit"]);
Route::post("/delete", [EmployeeController::class, "delete"]);