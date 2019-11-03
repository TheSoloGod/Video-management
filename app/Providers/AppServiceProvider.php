<?php

namespace App\Providers;

use App\Http\Controllers\Repositories\AdminRepository\AdminRepository;
use App\Http\Controllers\Repositories\AdminRepository\AdminRepositoryInterface;
use App\Http\Controllers\Repositories\CategoryRepository\CategoryRepository;
use App\Http\Controllers\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Http\Controllers\Repositories\CategoryVideoRepository\CategoryVideoRepository;
use App\Http\Controllers\Repositories\CategoryVideoRepository\CategoryVideoRepositoryInterface;
use App\Http\Controllers\Repositories\DateVideoRepository\DateVideoRepository;
use App\Http\Controllers\Repositories\DateVideoRepository\DateVideoRepositoryInterface;
use App\Http\Controllers\Repositories\GroupRepository\GroupRepository;
use App\Http\Controllers\Repositories\GroupRepository\GroupRepositoryInterface;
use App\Http\Controllers\Repositories\GroupUserRepository\GroupUserRepository;
use App\Http\Controllers\Repositories\GroupUserRepository\GroupUserRepositoryInterface;
use App\Http\Controllers\Repositories\GroupVideoRepository\GroupVideoRepository;
use App\Http\Controllers\Repositories\GroupVideoRepository\GroupVideoRepositoryInterface;
use App\Http\Controllers\Repositories\UserRepository\UserRepository;
use App\Http\Controllers\Repositories\UserRepository\UserRepositoryInterface;
use App\Http\Controllers\Repositories\UserVideoRepository\UserVideoRepository;
use App\Http\Controllers\Repositories\UserVideoRepository\UserVideoRepositoryInterface;
use App\Http\Controllers\Repositories\VideoRepository\VideoRepository;
use App\Http\Controllers\Repositories\VideoRepository\VideoRepositoryInterface;
use App\Http\Controllers\Services\AdminService\AdminService;
use App\Http\Controllers\Services\AdminService\AdminServiceInterface;
use App\Http\Controllers\Services\CategoryService\CategoryService;
use App\Http\Controllers\Services\CategoryService\CategoryServiceInterface;
use App\Http\Controllers\Services\CategoryVideoService\CategoryVideoService;
use App\Http\Controllers\Services\CategoryVideoService\CategoryVideoServiceInterface;
use App\Http\Controllers\Services\DateVideoService\DateVideoService;
use App\Http\Controllers\Services\DateVideoService\DateVideoServiceInterface;
use App\Http\Controllers\Services\GroupService\GroupService;
use App\Http\Controllers\Services\GroupService\GroupServiceInterface;
use App\Http\Controllers\Services\GroupUserService\GroupUserService;
use App\Http\Controllers\Services\GroupUserService\GroupUserServiceInterface;
use App\Http\Controllers\Services\GroupVideoService\GroupVideoService;
use App\Http\Controllers\Services\GroupVideoService\GroupVideoServiceInterface;
use App\Http\Controllers\Services\UserService\UserService;
use App\Http\Controllers\Services\UserService\UserServiceInterface;
use App\Http\Controllers\Services\UserVideoService\UserVideoService;
use App\Http\Controllers\Services\UserVideoService\UserVideoServiceInterface;
use App\Http\Controllers\Services\VideoService\VideoService;
use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            AdminRepositoryInterface::class,
            AdminRepository::class
        );

        $this->app->singleton(
            AdminServiceInterface::class,
            AdminService::class
        );

        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
        );

        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->singleton(
            CategoryServiceInterface::class,
            CategoryService::class
        );

        $this->app->singleton(
            GroupRepositoryInterface::class,
            GroupRepository::class
        );

        $this->app->singleton(
            GroupServiceInterface::class,
            GroupService::class
        );

        $this->app->singleton(
            VideoRepositoryInterface::class,
            VideoRepository::class
        );

        $this->app->singleton(
            VideoServiceInterface::class,
            VideoService::class
        );

        $this->app->singleton(
            GroupUserRepositoryInterface::class,
            GroupUserRepository::class
        );

        $this->app->singleton(
            GroupUserServiceInterface::class,
            GroupUserService::class
        );

        $this->app->singleton(
            GroupVideoRepositoryInterface::class,
            GroupVideoRepository::class
        );

        $this->app->singleton(
            GroupVideoServiceInterface::class,
            GroupVideoService::class
        );

        $this->app->singleton(
            UserVideoRepositoryInterface::class,
            UserVideoRepository::class
        );

        $this->app->singleton(
            UserVideoServiceInterface::class,
            UserVideoService::class
        );

        $this->app->singleton(
            CategoryVideoRepositoryInterface::class,
            CategoryVideoRepository::class
        );

        $this->app->singleton(
            CategoryVideoServiceInterface::class,
            CategoryVideoService::class
        );

        $this->app->singleton(
            DateVideoRepositoryInterface::class,
            DateVideoRepository::class
        );

        $this->app->singleton(
            DateVideoServiceInterface::class,
            DateVideoService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
