<?php

namespace App\Providers;

use App\Interfaces\SendMailRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\SendMailRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SendMailRepositoryInterface::class, SendMailRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
