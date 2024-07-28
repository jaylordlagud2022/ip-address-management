<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\IpAddress\CreateIpAddressController;
use App\Http\Controllers\API\IpAddress\GetIpAddressController;
use App\Http\Controllers\API\IpAddress\UpdateIpAddressController;
use App\Http\Controllers\API\IpAddress\ListIpAddressController;
use App\Http\Controllers\API\AuditLogController;
use App\Http\Controllers\API\Authentication\LoginController;

Route::post('/authenticate', [
    'uses' => LoginController::class,
])->name('authenticate');

Route::group([
    'middleware' => ['auth.api'],
    'as' => 'ipAddress.',
    'prefix' => 'ip-addresses',
], function (): void {
    Route::post('/', [
        'as' => 'create',
        'uses' => CreateIpAddressController::class,
    ]);
    Route::get('/get/{id}', [
        'as' => 'get',
        'uses' => GetIpAddressController::class,
    ]);

    Route::put('/get/{id}', [
        'as' => 'update',
        'uses' => UpdateIpAddressController::class,
    ]);

    Route::get('/list', [
        'as' => 'list',
        'uses' => ListIpAddressController::class,
    ]);
});

