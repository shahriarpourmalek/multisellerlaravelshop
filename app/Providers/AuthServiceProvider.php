<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Seller;
use App\Policies\sellers\SellersOrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
//        'App\Models\Order' => 'App\Policies\sellers\SellersOrderPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (!$this->app->runningInConsole() && application_installed()) {
            foreach ($this->getPermissions() as $permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->level == 'creator' or ($user->isAdmin() && $user->hasRole($permission->roles));
                });
            }
        }
        if (!$this->app->runningInConsole() && application_installed()) {
            foreach ($this->getPermissions() as $permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return true;
                });
            }
        }
    }
    protected function getSellersPermissions()
    {
        return Permission::where('active', true)
            ->where('name', 'like', 'seller_%')
            ->get();
    }
    protected function getPermissions()
    {
        return Permission::where('active', true)->with('roles')->get();
    }
}
