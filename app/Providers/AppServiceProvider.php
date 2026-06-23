<?php

namespace App\Providers;

use App\Repositories\Branch\BranchRepositoryInterface;
use App\Repositories\Branch\BranchRepository;

use App\Repositories\RolePermission\RolePermissionRepositoryInterface;
use App\Repositories\RolePermission\RolePermissionRepository;

use App\Repositories\PermissionGroup\PermissionGroupRepositoryInterface;
use App\Repositories\PermissionGroup\PermissionGroupRepository;

use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Role\RoleRepository;


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
    public function register(): void {
//
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);
        $this->app->bind(FeaturePackageRepositoryInterface::class, FeaturePackageRepository::class);
        $this->app->bind(UserPackageRepositoryInterface::class, UserPackageRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionGroupRepositoryInterface::class, PermissionGroupRepository::class);
        $this->app->bind(RolePermissionRepositoryInterface::class, RolePermissionRepository::class);
        $this->app->bind(BranchRepositoryInterface::class, BranchRepository::class);
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }
}
