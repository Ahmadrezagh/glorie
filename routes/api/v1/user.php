<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('generateCode','Api\V1\User\AuthController@generateCode')->name('generateCode');
Route::post('loginBySMS','Api\V1\User\AuthController@loginBySMS')->name('loginBySMS');
