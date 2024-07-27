<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\IpAddress\Factories\CreateIpAddressFactory;
use App\Services\IpAddress\Interfaces\CreateIpAddressFactoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       $this->app->bind(CreateIpAddressFactoryInterface::class, CreateIpAddressFactory::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
