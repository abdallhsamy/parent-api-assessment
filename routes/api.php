<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ParentApiController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::as('api.v1.')->prefix('v1')->group(function () {
    Route::get('users', [ParentApiController::class, 'index'])->name('users');
});
