<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        /**
         * NOTE!!
         * First time migration will fails, because permissions table doesn't exists.
         */
        foreach($this->getPermissions() as $permission) {
            $gate->define($permission->name, function($user) use ($permission) {
                return $user->hasRole($permission->roles);
            });
        }
    }

    private function getPermissions()
    {
        return Permission::all();
    }
}
