<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\AuthController;

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

//API route for register new user
Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);

    // API route for covid patients 
    Route::get('/patients', [PatientsController::class, 'index']);
    Route::post('/patient', [PatientsController::class, 'store']);
    Route::get('/patient/{id}', [PatientsController::class, 'show']);
    Route::put('/patients/{id}', [PatientsController::class, 'update']);
    Route::delete('/patients/{id}', [PatientsController::class, 'destroy']);
    Route::get('/patients/search/{name}', [PatientsController::class, 'search']);
    Route::get('/patients/status/positive', [PatientsController::class, 'positive']);
    Route::get('/patients/status/recovered', [PatientsController::class, 'recovered']);
    Route::get('/patients/status/dead', [PatientsController::class, 'dead']);
});
