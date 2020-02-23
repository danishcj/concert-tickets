<?php

use Illuminate\Http\Request;

// Endpoints without Token
Route::post('login', 'CredsController@login');
Route::post('register', 'CredsController@register');
Route::get('events', 'ApiController@getAllEvents');

// Endpoints with Token
Route::group(['middleware' => 'auth:api'], function(){
Route::get('all_bookings', 'ApiController@getAllBooking');
Route::post('new_booking', 'ApiController@createBooking');
Route::put('booking/{id}', 'ApiController@updateBooking');
Route::delete('booking/delete/{id}','ApiController@deleteBooking');
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});