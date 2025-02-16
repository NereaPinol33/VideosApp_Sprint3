<?php

namespace Tests\Feature\Videos;

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    public function user_with_permissions_can_manage_videos()
    {
        create_roles();
        define_permissions();
        define_gates();
        $this->loginAsTeacher();

        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('create-videos'));

        $video = \App\Models\Video::factory()->create([]);

        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('view-video'));
        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('edit-videos', $video));
        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('delete-videos', $video));
    }

    public function regular_users_cannot_manage_videos()
    {
        create_roles();
        define_permissions();
        define_gates();
        $this->loginAsStudent();

        $video = \App\Models\Video::factory()->create();

        $this->assertFalse(\Illuminate\Support\Facades\Gate::allows('create-videos'));
        $this->assertFalse(\Illuminate\Support\Facades\Gate::allows('delete-videos', $video));
    }

    public function guest_users_cannot_manage_videos()
    {
        $video = \App\Models\Video::factory()->create();

        $this->assertFalse(\Illuminate\Support\Facades\Gate::allows('view-video', $video));
        $this->assertFalse(\Illuminate\Support\Facades\Gate::allows('create-videos'));
        $this->assertFalse(\Illuminate\Support\Facades\Gate::allows('delete-videos', $video));
    }

    public function admins_can_manage_videos()
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
        create_user('Administrator', 'superadmin@example.com', 'secret', 'admin');
        $superAdmin = \App\Models\User::where('email', 'superadmin@example.com')->first();
        $this->actingAs($superAdmin);
        return $superAdmin;
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
        create_user('Student', 'student@example.com', 'secret', 'user');
        $studentUser = \App\Models\User::where('email', 'student@example.com')->first();
        $this->actingAs($studentUser);
        return $studentUser;
    }
}