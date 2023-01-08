<?php

namespace App\Providers;

use App\Models\File;
use App\Repositories\EloquentImpl\FileRepositoryImpl;
use App\Repositories\FileRepository;
use App\Services\EloquentImpl\FileServiceImpl;
use App\Services\FileService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Singletons of Dependency Injection.
     *
     * @var array<class-string, class-string>
     */
    public array $singletons = [
        File::class => File::class,
        FileRepository::class => FileRepositoryImpl::class,
        FileService::class => FileServiceImpl::class,
    ];

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, class-string>
     */
    public function provides(): array
    {
        return [
            File::class,
            FileRepository::class,
            FileService::class
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
