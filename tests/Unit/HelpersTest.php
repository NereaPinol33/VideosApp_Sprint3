<?php

namespace Tests\Unit;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_default_user_teacher_team()
    {
        create_default_user_teacher_team();
        $this->assertDatabaseHas('users', [
            'name' => env('DEFAULT_TEACHER_NAME'),
            'email' => env('DEFAULT_TEACHER_EMAIL'),
        ]);

        $this->assertDatabaseHas('teams', [
            'name' => 'Teacher',
        ]);

        $user = User::where('email', env('DEFAULT_TEACHER_EMAIL'))->first();
        $this->assertTrue(Hash::check(env('DEFAULT_TEACHER_PASSWORD'), $user->password));

        $team = Team::where('name', 'Teacher')->first();
        $this->assertEquals($team->id, $user->currentTeam->id);
    }

    public function test_create_default_user_student_team()
    {
        create_default_user_student_team();
        $this->assertDatabaseHas('users', [
            'name' => env('DEFAULT_STUDENT_NAME'),
            'email' => env('DEFAULT_STUDENT_EMAIL'),
        ]);

        $this->assertDatabaseHas('teams', [
            'name' => 'Student',
        ]);

        $user = User::where('email', env('DEFAULT_STUDENT_EMAIL'))->first();
        $this->assertTrue(Hash::check(env('DEFAULT_STUDENT_PASSWORD'), $user->password));

        $team = Team::where('name', 'Student')->first();
        $this->assertEquals($team->id, $user->currentTeam->id);
    }

    public function test_create_default_teacher_video()
    {
        create_default_teacher_video();
        $this->assertDatabaseHas('videos', [
            'title' => env('DEFAULT_TEACHER_VIDEO_TITLE'),
            'description' => env('DEFAULT_TEACHER_VIDEO_DESCRIPTION'),
            'url' => env('DEFAULT_TEACHER_VIDEO_URL'),
        ]);
    }
}
