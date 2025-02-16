<?php

use App\Policies\VideoPolicy;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

if (! function_exists('create_roles')) {
    /**
     * Create the default roles if they don't exist.
     *
     * @return void
     */
    function create_roles()
    {
        $roles = ['admin', 'teacher', 'student'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}

if (! function_exists('define_gates')) {
    /**
     * Define the gates.
     *
     * @return void
     */
    function define_gates()
    {
        Gate::define('view-video', [VideoPolicy::class, 'view']);
        Gate::define('create-videos', [VideoPolicy::class, 'create']);
        Gate::define('edit-videos', [VideoPolicy::class, 'update']);
        Gate::define('delete-videos', [VideoPolicy::class, 'delete']);
    }
}

if (! function_exists('define_permissions')) {
    /**
     * Define the permissions.
     *
     * @return void
     */
    function define_permissions()
    {
        $permissions = ['view videos', 'create videos', 'edit videos', 'delete videos'];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $role = Role::findByName('admin');
        $role->syncPermissions($permissions);

        $role = Role::findByName('teacher');
        $role->syncPermissions(['view videos', 'create videos']);

        $role = Role::findByName('student');
        $role->syncPermissions(['view videos']);
    }
}
