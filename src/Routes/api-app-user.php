<?php

use Pterodactyl\Http\Middleware\Api\Client\AuthenticateClientAccess as PterodactylAccess;

/*
|--------------------------------------------------------------------------
| Console Controller Routes
|--------------------------------------------------------------------------
| 
*/
Route::group(['prefix' => '/console', 'middleware' => [PterodactylAccess::class]], function () {
    Route::get('/{server}', 'ConsoleController@show')->name('api.app.user.console');
});

