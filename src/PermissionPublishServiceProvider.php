<?php

namespace Vdes\PermisionRoles;

use Illuminate\Support\ServiceProvider;

class PermissionPublishServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        require  __DIR__ . '/routes.php';
        $this->publishes([
            __DIR__ . '/Views'   => resource_path('views/template/dreams/modul'),
        ], 'view');
    }
}
