<?php

namespace App\Providers;

use App\Repositories\Admin\Permission\PermissionRepository;
use App\Repositories\Admin\Permission\PermissionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PermissionRepositoryInterface::class,PermissionRepository::class);
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
