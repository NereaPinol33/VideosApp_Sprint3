<?php

use App\Models\Team;
use App\Models\User;

if (! function_exists('create_default_user_teacher_team')) {
    /**
     * Create a default teacher user and team if they don't exist.
     *
     * @return void
     */
    function create_default_user_teacher_team()
    {
        if (User::where('email', env('DEFAULT_TEACHER_EMAIL'))->exists()) {
            return;
        }

        $user = new User;
        $user->name = env('DEFAULT_TEACHER_NAME', 'Teacher');
        $user->email = env('DEFAULT_TEACHER_EMAIL', 'a@gmail.com');
        $user->password = bcrypt(env('DEFAULT_TEACHER_PASSWORD'));
        $user->save();

        $team = new Team;
        $team->name = 'Teacher';
        $team->user_id = $user->id;
        $team->personal_team = false;
        $team->save();

        $user->switchTeam($team);

        $user->syncRoles('admin');
    }
}

if (! function_exists('create_default_user_student_team')) {
    /**
     * Create a default student user and team if they don't exist.
     *
     * @return void
     */
    function create_default_user_student_team()
    {
        if (User::where('email', env('DEFAULT_STUDENT_EMAIL'))->exists()) {
            return;
        }

        $user = new User;
        $user->name = env('DEFAULT_STUDENT_NAME');
        $user->email = env('DEFAULT_STUDENT_EMAIL');
        $user->password = bcrypt(env('DEFAULT_STUDENT_PASSWORD'));
        $user->save();

        $team = new Team;
        $team->name = 'Student';
        $team->user_id = $user->id;
        $team->personal_team = false;
        $team->save();

        $user->switchTeam($team);
    }
}

if (! function_exists('create_user')) {
    /**
     * Create a user, with team if needed.
     *
     * @param  string  $name
     * @param  string  $email
     * @param  string  $password
     * @param  string  $role
     * @param  bool  $team
     * @return void
     */
    function create_user($name, $email, $password, $role, $team = false, $teamName = null)
    {
        if (User::where('email', $email)->exists()) {
            return;
        }

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        if ($team) {
            add_personal_team($user, $teamName);
        }

        $user->syncRoles($role);
    }
}

if (! function_exists('add_personal_team')) {
    /**
     * Add a personal team to a user.
     *
     * @return void
     */
    function add_personal_team(User $user, $name = null)
    {
        $team = new Team;
        $team->name = $name ?? $user->name;
        $team->user_id = $user->id;
        $team->personal_team = true;
        $team->save();

        $user->switchTeam($team);
    }
}
