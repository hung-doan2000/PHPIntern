<?php

namespace App\Providers;

use App\Repositories\Admin\Permission\PermissionRepository;
use App\Repositories\Admin\Permission\PermissionRepositoryInterface;
use App\Repositories\Admin\Role\RoleRepository;
use App\Repositories\Admin\Role\RoleRepositoryInterface;
use App\Repositories\Admin\User\UserRepository;
use App\Repositories\Admin\User\UserRepositoryInterface;
use Illuminate\Support\Facades\URL;
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
        if (env('APP_ENV') == 'Production') {
            URL::forceScheme('https');
        }
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
