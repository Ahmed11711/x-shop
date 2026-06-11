<?php

namespace App\Providers;

use App\Repositories\UserPackage\UserPackageRepositoryInterface;
use App\Repositories\UserPackage\UserPackageRepository;

use App\Repositories\FeaturePackage\FeaturePackageRepositoryInterface;
use App\Repositories\FeaturePackage\FeaturePackageRepository;

use App\Repositories\Package\PackageRepositoryInterface;
use App\Repositories\Package\PackageRepository;


use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);
        $this->app->bind(FeaturePackageRepositoryInterface::class, FeaturePackageRepository::class);
        $this->app->bind(UserPackageRepositoryInterface::class, UserPackageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }
}
