<?php

/*
|--------------------------------------------------------------------------
| Console Controller Routes
|--------------------------------------------------------------------------
| 
*/
Route::group(['prefix' => '/console'], function () {
    Route::get('/{serverid}')->name('api.app.admin.console');
});

