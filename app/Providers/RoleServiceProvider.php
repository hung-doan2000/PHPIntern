<?php

namespace App\Providers;

use App\Repositories\Admin\Role\RoleRepository;
use App\Repositories\Admin\Role\RoleRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleRepositoryInterface::class,RoleRepository::class);
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
