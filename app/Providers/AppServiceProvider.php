<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use App\Services\IpAddress\Factories\CreateIpAddressFactory;
use App\Services\IpAddress\Interfaces\CreateIpAddressFactoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\IpAddressRepository;
use App\Repositories\Interfaces\IpAddressRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

     protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
     ];

    public function register(): void
    {
       $this->app->bind(CreateIpAddressFactoryInterface::class, CreateIpAddressFactory::class);
       $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
       $this->app->bind(IpAddressRepositoryInterface::class, IpAddressRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Passport::tokensExpireIn(now()->addDays(7));
        Passport::personalAccessTokensExpireIn(now()->addDays(7));
        Passport::refreshTokensExpireIn(now()->addDays(25));
        Passport::enablePasswordGrant();
    }
}
