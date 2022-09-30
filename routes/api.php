<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
Route::group(['prefix'=>'tes'],function(){
    Route::get('/sort/{string}',[TestController::class,'sortString']);
    Route::get('/place/{num}',[TestController::class,'placeValue']);
    Route::get('/binary/{sentence}',[TestController::class,'toBinary']);
    Route::get('/operation/{expression}',[TestController::class,'calculate']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});
