<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\BlogRepository;
use App\Repositories\UserRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $bindings = [
            BlogRepositoryInterface::class => BlogRepository::class,
            AuthRepositoryInterface::class => AuthRepository::class,
            UserRepositoryInterface::class => UserRepository::class,
        ];

        foreach ($bindings as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }

        // $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
