<?php

namespace App\Providers;

use App\Repositories\Purchase\PurchaseRepositoryInterface;
use App\Repositories\Purchase\PurchaseRepository;

use App\Repositories\suppliers\suppliersRepositoryInterface;
use App\Repositories\suppliers\suppliersRepository;

use App\Models\Product;
use App\Observers\ProductObserver;
use App\Observers\WooCommerceProductObserver;
use App\Repositories\Branch\BranchRepository;

use App\Repositories\Branch\BranchRepositoryInterface;
use App\Repositories\Brand\BrandRepository;

use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\CategoryProduct\CategoryProductRepository;

use App\Repositories\CategoryProduct\CategoryProductRepositoryInterface;
use App\Repositories\Contact\ContactRepository;

use App\Repositories\Contact\ContactRepositoryInterface;
use App\Repositories\CustomerGroup\CustomerGroupRepository;

use App\Repositories\CustomerGroup\CustomerGroupRepositoryInterface;
use App\Repositories\FeaturePackage\FeaturePackageRepository;


use App\Repositories\FeaturePackage\FeaturePackageRepositoryInterface;
use App\Repositories\Package\PackageRepository;

use App\Repositories\Package\PackageRepositoryInterface;
use App\Repositories\PermissionGroup\PermissionGroupRepository;

use App\Repositories\PermissionGroup\PermissionGroupRepositoryInterface;
use App\Repositories\Product\ProductRepository;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductUnit\ProductUnitRepository;

use App\Repositories\ProductUnit\ProductUnitRepositoryInterface;
use App\Repositories\Role\RoleRepository;

use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\RolePermission\RolePermissionRepository;

use App\Repositories\RolePermission\RolePermissionRepositoryInterface;
use App\Repositories\SellingPriceGroup\SellingPriceGroupRepository;


use App\Repositories\SellingPriceGroup\SellingPriceGroupRepositoryInterface;
use App\Repositories\User\UserRepository;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserPackage\UserPackageRepository;

use App\Repositories\UserPackage\UserPackageRepositoryInterface;
use App\Repositories\UserRole\UserRoleRepository;


use App\Repositories\UserRole\UserRoleRepositoryInterface;
use App\Repositories\Warranty\WarrantyRepository;
use App\Repositories\Warranty\WarrantyRepositoryInterface;
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
        $this->app->bind(UserRoleRepositoryInterface::class, UserRoleRepository::class);
        $this->app->bind(CustomerGroupRepositoryInterface::class, CustomerGroupRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(CategoryProductRepositoryInterface::class, CategoryProductRepository::class);
        $this->app->bind(ProductUnitRepositoryInterface::class, ProductUnitRepository::class);
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(WarrantyRepositoryInterface::class, WarrantyRepository::class);
        $this->app->bind(SellingPriceGroupRepositoryInterface::class, SellingPriceGroupRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(suppliersRepositoryInterface::class, suppliersRepository::class);
        $this->app->bind(PurchaseRepositoryInterface::class, PurchaseRepository::class);
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Product::observe(ProductObserver::class);
        // Product::observe(WooCommerceProductObserver::class);
        Model::unguard();
    }
}
