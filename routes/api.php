<?php

use App\Models\Itineraire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItineraireController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('/itinéraires', function () {
//     return "products";
// });

Route::post('/register', [AuthController::class, 'register']);
Route::get('/Itinéraires', [ItineraireController::class, 'index']);
Route::middleware('auth:sanctum')->post('/Itinéraires', [ItineraireController::class, 'store']);
Route::middleware('auth:sanctum')->get('/Itinéraires/{id}', [ItineraireController::class, 'show']);
Route::middleware('auth:sanctum')->put('/Itinéraires/{id}', [ItineraireController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/Itinéraires/{id}', [ItineraireController::class, 'destroy']);
Route::get('/Itinéraires/search/{title}', [ItineraireController::class, 'search']);
Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/Itinéraires/{id}/add-to-list', [ItineraireController::class, 'addToListToVisit']);
Route::middleware('auth:sanctum')->post('/Itinéraires/{id}/remove-from-list', [ItineraireController::class, 'removeFromListToVisit']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
