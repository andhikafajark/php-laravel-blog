<?php

namespace App\Providers;

use App\Models\User;
use App\Repositories\EloquentImpl\UserRepositoryImpl;
use App\Repositories\UserRepository;
use App\Services\EloquentImpl\UserServiceImpl;
use App\Services\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Singletons of Dependency Injection.
     *
     * @var array<class-string, class-string>
     */
    public array $singletons = [
        User::class => User::class,
        UserRepository::class => UserRepositoryImpl::class,
        UserService::class => UserServiceImpl::class,
    ];

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, class-string>
     */
    public function provides(): array
    {
        return [
            User::class,
            UserRepository::class,
            UserService::class
        ];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
