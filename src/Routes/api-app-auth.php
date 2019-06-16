<?php

Route::group(['prefix' => '/auth', 'middleware' => []], function () {
    Route::post('/token', 'LoginController@login')->name('api.app.user.auth.token');
});
