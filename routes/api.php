<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'tes'],function(){
    Route::get('/sort/{string}',[controller1::class,'sortString']);
    Route::get('/place/{num}',[controller1::class,'placeValue']);
    Route::get('/binary/{sentence}',[controller1::class,'toBinary']);
}

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
