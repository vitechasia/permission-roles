<?php

namespace Vdes\PermisionRoles;

use Vdes\PermisionRoles\Models\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PermisionsRoles::class,function(){
            return new PermisionsRoles;
        });
        app('router')->aliasMiddleware('permission', \Vdes\PermisionRoles\Middleware\PermissionMiddleware::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->slug, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        } catch (\Exception $e) {
            report($e);
            return false;
        }
        Blade::directive('role', function ($role) {
             return "<?php if(auth()->check() && auth()->user()->can({$role})) :?>";
        });

        Blade::directive('endrole', function ($role) {
             return "<?php endif; ?>";
        });
    }
}
