<?php

namespace App\Providers;

use App\Models\Posts;
use App\Policies\PostsPolicy;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Modules;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Posts::class => PostsPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // lay toan bo modules
        $modules = Modules::all();
        if ($modules->count() > 0) {
            foreach ($modules as $module) {
                Gate::define($module->name, function (User $user) use ($module) {

                    $roleJson = $user->group->permissions;

                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);

                        if (isRole($roleArr, $module->name)) {
                            return true;
                        }
                    }

                    return false;
                });

                Gate::define($module->name . '.edit', function (User $user) use ($module) {

                    $roleJson = $user->group->permissions;

                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);

                        if (isRole($roleArr, $module->name, 'edit')) {
                            return true;
                        }
                    }

                    return false;
                });

                Gate::define($module->name . '.delete', function (User $user) use ($module) {

                    $roleJson = $user->group->permissions;

                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);

                        if (isRole($roleArr, $module->name, 'delete')) {
                            return true;
                        }
                    }

                    return false;
                });
            }
        }
    }
}
