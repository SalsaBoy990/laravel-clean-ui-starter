<?php

namespace App\Providers;

use App\Interface\Repository\CategoryRepositoryInterface;
use App\Interface\Repository\ModelRepositoryInterface;
use App\Interface\Repository\PostRepositoryInterface;
use App\Interface\Repository\TagRepositoryInterface;
use App\Interface\Repository\UserRepositoryInterface;
use App\Interface\Services\ArchiveEntityServiceInterface;
use App\Interface\Services\DateTimeServiceInterface;
use App\Interface\Services\ImageServiceInterface;
use App\Interface\Services\RolePermissionServiceInterface;

use App\Repository\CategoryRepository;
use App\Repository\ModelRepository;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use App\Repository\UserRepository;

use App\Services\ArchiveEntityService;
use App\Services\DateTimeService;
use App\Services\ImageService;
use App\Services\RolePermissionService;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(RolePermissionServiceInterface::class, RolePermissionService::class);
        $this->app->bind(ImageServiceInterface::class, ImageService::class);
        $this->app->bind(DateTimeServiceInterface::class, DateTimeService::class);
        $this->app->bind(ModelRepositoryInterface::class, ModelRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(ArchiveEntityServiceInterface::class, ArchiveEntityService::class);


        /* $this->app->when([LocationController::class])
            ->needs(ModelRepositoryInterface::class)
            ->give(LocationRepository::class);
        */
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
