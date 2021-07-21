<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('generateCode','Api\V1\User\AuthController@generateCode')->name('generateCode');
Route::post('loginBySMS','Api\V1\User\AuthController@loginBySMS')->name('loginBySMS');
Route::post('me','Api\V1\User\AuthController@me')->name('me');
Route::post('updateProfile','Api\V1\User\ProfileController@updateProfile')->name('user.update');
Route::post('updateReferralCode','Api\V1\User\ProfileController@updateReferralCode')->name('user.updateReferralCode');
