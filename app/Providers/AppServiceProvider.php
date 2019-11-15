<?php

namespace App\Providers;

use App\Repositories\AdminRepository\AdminRepository;
use App\Repositories\AdminRepository\AdminRepositoryInterface;
use App\Repositories\CategoryRepository\CategoryRepository;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Repositories\CategoryVideoRepository\CategoryVideoRepository;
use App\Repositories\CategoryVideoRepository\CategoryVideoRepositoryInterface;
use App\Repositories\DateVideoRepository\DateVideoRepository;
use App\Repositories\DateVideoRepository\DateVideoRepositoryInterface;
use App\Repositories\GroupRepository\GroupRepository;
use App\Repositories\GroupRepository\GroupRepositoryInterface;
use App\Repositories\GroupUserRepository\GroupUserRepository;
use App\Repositories\GroupUserRepository\GroupUserRepositoryInterface;
use App\Repositories\GroupVideoRepository\GroupVideoRepository;
use App\Repositories\GroupVideoRepository\GroupVideoRepositoryInterface;
use App\Repositories\UserRepository\UserRepository;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Repositories\UserVideoRepository\UserVideoRepository;
use App\Repositories\UserVideoRepository\UserVideoRepositoryInterface;
use App\Repositories\VideoRepository\VideoRepository;
use App\Repositories\VideoRepository\VideoRepositoryInterface;
use App\Services\AdminService\AdminService;
use App\Services\AdminService\AdminServiceInterface;
use App\Services\CategoryService\CategoryService;
use App\Services\CategoryService\CategoryServiceInterface;
use App\Services\CategoryVideoService\CategoryVideoService;
use App\Services\CategoryVideoService\CategoryVideoServiceInterface;
use App\Services\DateVideoService\DateVideoService;
use App\Services\DateVideoService\DateVideoServiceInterface;
use App\Services\GroupService\GroupService;
use App\Services\GroupService\GroupServiceInterface;
use App\Services\GroupUserService\GroupUserService;
use App\Services\GroupUserService\GroupUserServiceInterface;
use App\Services\GroupVideoService\GroupVideoService;
use App\Services\GroupVideoService\GroupVideoServiceInterface;
use App\Services\UserService\UserService;
use App\Services\UserService\UserServiceInterface;
use App\Services\UserVideoService\UserVideoService;
use App\Services\UserVideoService\UserVideoServiceInterface;
use App\Services\VideoService\VideoService;
use App\Services\VideoService\VideoServiceInterface;
use App\Services\SubService\SessionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        if (env('APP_DEBUG')) {
            DB::listen(function ($query) {
               File::append(
                   storage_path('/logs/query.log'),
                   $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL
               );
            });
        }
    }
}
