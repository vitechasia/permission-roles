<?php

namespace Vdes\PermisionRoles\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

class PermissionMiddleware
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle(Request $request, Closure $next, $permission = null)
    {
        if($permission !== null && !$request->user()->can($permission) ) {
            abort(404,'Anda tidak memiliki akses ke halaman ini');
        }
        return $next($request);
    }
}
