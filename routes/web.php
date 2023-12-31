<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/entities/import-from-api', [EntityController::class, 'importEntitiesFromApi']);
Route::get('/api/{codeCategory}', [EntityController::class, 'getEntitiesByCategory']);
