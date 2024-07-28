<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\IpAddress\CreateIpAddressController;
use App\Http\Controllers\API\IpAddress\GetIpAddressController;
use App\Http\Controllers\API\IpAddress\UpdateIpAddressController;
use App\Http\Controllers\API\IpAddress\ListIpAddressController;
use App\Http\Controllers\API\AuditLog\ListAuditLogController;
use App\Http\Controllers\API\Authentication\LoginController;
use App\Http\Controllers\API\Authentication\LogoutController;

Route::post('/authenticate', [
    'uses' => LoginController::class,
])->name('authenticate');

Route::post('/logout', [
    'as' => 'logout',
    'uses' => LogoutController::class,
]);

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


Route::group([
    'middleware' => ['auth.api'],
    'as' => 'auditLogs.',
    'prefix' => 'audit-logs',
], function (): void {

    Route::get('/', [
        'as' => 'list',
        'uses' => ListAuditLogController::class,
    ]);
});
