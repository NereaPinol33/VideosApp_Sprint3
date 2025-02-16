<?php

namespace Tests\Feature\Videos;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_users_can_manage_videos()
    {
        create_roles();
        define_permissions();
        define_gates();

        $this->loginAsTeacher();
        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('create-videos'));

        $video = \App\Models\Video::factory()->create(); 

        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('view-video'));
        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('create-videos'));

        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('edit-videos', $video));
        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('delete-videos', $video));
    }

    public function test_student_users_cannot_manage_videos()
    {
        create_roles();
        define_permissions();
        define_gates();

        $this->loginAsStudent();

        $video = \App\Models\Video::factory()->create();

        $this->assertFalse(\Illuminate\Support\Facades\Gate::allows('create-videos'));
        $this->assertFalse(\Illuminate\Support\Facades\Gate::allows('delete-videos', $video));
    }

    public function test_guest_users_cannot_manage_videos()
    {
        create_roles();
        define_permissions();
        define_gates();

        $video = \App\Models\Video::factory()->create();

        $this->assertFalse(\Illuminate\Support\Facades\Gate::allows('view-video', $video));
        $this->assertFalse(\Illuminate\Support\Facades\Gate::allows('create-videos'));
        $this->assertFalse(\Illuminate\Support\Facades\Gate::allows('delete-videos', $video));
    }

    public function test_admins_can_manage_videos()
    {
        create_roles();
        define_permissions();
        define_gates();
        $this->loginAsAdmin();

        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('create-videos'));

        $video = \App\Models\Video::factory()->create([]);

        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('view-video'));
        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('edit-videos', $video));
        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('delete-videos', $video));
    }

    private function loginAsAdmin()
    {
        create_user('Administrator', 'admin@example.com', 'secret', 'admin');
        $admin = \App\Models\User::where('email', 'admin@example.com')->first();
        $this->actingAs($admin);

        return $admin;
    }

    private function loginAsTeacher()
    {
        create_user('Teacher', 'teacher@example.com', 'secret', 'teacher');
        $teacher = \App\Models\User::where('email', 'teacher@example.com')->first();
        $this->actingAs($teacher);

        return $teacher;
    }

    private function loginAsStudent()
    {
        create_user('Student', 'student@example.com', 'secret', 'student');
        $studentUser = \App\Models\User::where('email', 'student@example.com')->first();
        $this->actingAs($studentUser);

        return $studentUser;
    }
}
