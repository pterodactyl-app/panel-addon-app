<?php

/*
|--------------------------------------------------------------------------
| Console Controller Routes
|--------------------------------------------------------------------------
| 
*/
Route::group(['prefix' => '/console'], function () {
    Route::get('/{serverid}', function () {
       return 'test';
    })->name('api.app.admin.console');
});

