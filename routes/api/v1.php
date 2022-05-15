<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1 as ApiControllers;

Route::middleware('private')->prefix('api')->group(function () {
    Route::post('client/{client_uuid}/roles')->uses('Api\ClientRolesController@store')->name('store-client-roles');
    Route::delete('client/{client_uuid}/roles')->uses('Api\ClientRolesController@destroy')->name('delete-client-roles');

    Route::get('client/{client_uuid}/tokens')->uses('Api\ClientTokenController@index')->name('index-client-tokens');
    Route::post('client/{client_uuid}/token')->uses('Api\ClientTokenController@store')->name('store-client-token');
    Route::delete('token/{token_id}')->uses('Api\TokenController@destroy')->name('delete-token');

    Route::get('clients')->uses('Api\ClientController@index')->name('index-client');
    Route::post('clients')->uses('Api\ClientController@store')->name('store-client');
    Route::get('clients/{client_uuid}')->uses('Api\ClientController@show')->name('show-client');
    Route::post('clients/{client_uuid}')->uses('Api\ClientController@update')->name('update-client');
    Route::delete('clients/{client_uuid}')->uses('Api\ClientController@destroy')->name('delete-client');

    Route::post('role/{role_id}/permissions')->uses('Api\RolePermissionsController@store')->name('store-role-permissions');
    Route::delete('role/{role_id}/permissions')->uses('Api\RolePermissionsController@destroy')->name('delete-role-permissions');

    Route::get('roles')->uses('Api\RoleController@index')->name('index-role');
    Route::post('roles')->uses('Api\RoleController@store')->name('store-role');
    Route::get('roles/{roles_id}')->uses('Api\RoleController@show')->name('show-role');
    Route::post('roles/{roles_id}')->uses('Api\RoleController@update')->name('update-role');
    Route::delete('roles/{roles_id}')->uses('Api\RoleController@destroy')->name('delete-role');

    Route::get('permissions')->uses('Api\PermissionController@index')->name('index-permission');
    Route::post('permissions')->uses('Api\PermissionController@store')->name('store-permission');
    Route::get('permissions/{permissions_id}')->uses('Api\PermissionController@show')->name('show-permission');
    Route::post('permissions/{permissions_id}')->uses('Api\PermissionController@update')->name('update-permission');
    Route::delete('permissions/{permissions_id}')->uses('Api\PermissionController@destroy')->name('delete-permission');
});

Route::middleware(['auth:sanctum', 'request.logging'])->group(function () {
    Route::prefix('air')->name('air.')->group(function () {
        Route::prefix('flight-offers')->name('flight-offers.')->group(function () {
            Route::post('search', [ApiControllers\Air\FlightOfferController::class, 'search'])->name('search');
        });
    });
});

if (app()->environment('local')) {
    Route::get('test', 'TestController');
}
