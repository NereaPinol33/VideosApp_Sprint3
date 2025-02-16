<?php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;

if (!function_exists('create_roles')) {
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

if (!function_exists('define_gates')) {
    /**
     * Define the gates.
     *
     * @return void
     */
    function define_gates()
    {
        Gate::define('view-video', function ($user) {
            return $user->hasPermissionTo('view videos');
        });

        Gate::define('create-videos', function ($user) {
            return $user->hasPermissionTo('create videos');
        });

        Gate::define('edit-videos', function ($user, $video) {
            return $user->hasPermissionTo('edit videos') && ($user->hasRole('admin') || $video->author_id == $user->id);
        });

        Gate::define('delete-videos', function ($user, $video) {
            return $user->hasPermissionTo('delete videos') && ($user->hasRole('admin') || $video->author_id == $user->id);
        });
    }
}

if (!function_exists('define_permissions')) {
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