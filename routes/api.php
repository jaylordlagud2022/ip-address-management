<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\IpAddress\CreateIpAddressController;
use App\Http\Controllers\API\UpdateIpAddressController;
use App\Http\Controllers\API\AuditLogController;

Route::group([
    'middleware' => ['auth:api'],
    'as' => 'ipAddress.',
    'prefix' => 'ip-addresses',
], function (): void {
    Route::post('/', [
        'as' => 'create',
        'uses' => CreateIpAddressController::class,
    ]);
});
