<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user()
    {
        create_roles();
        create_user('Test User', 'test@example.com', 'secret', 'teacher');
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com'
        ]);
    }

    public function test_create_video()
    {
        create_roles();
        create_user('Video Author', 'videoauthor@example.com', 'secret', 'teacher');
        $author = \App\Models\User::where('email', 'videoauthor@example.com')->first();
        create_video('Test Video', 'Test Description', 'http://example.com/video', $author->id);
        $this->assertDatabaseHas('videos', [
            'title' => 'Test Video'
        ]);
    }

    public function test_create_roles()
    {
        create_roles();
        $this->assertDatabaseHas('roles', ['name' => 'admin']);
        $this->assertDatabaseHas('roles', ['name' => 'teacher']);
        $this->assertDatabaseHas('roles', ['name' => 'student']);
    }

    public function test_define_permissions()
    {
        create_roles();
        define_permissions();
        $this->assertDatabaseHas('permissions', ['name' => 'view videos']);
        $this->assertDatabaseHas('permissions', ['name' => 'create videos']);
        $this->assertDatabaseHas('permissions', ['name' => 'edit videos']);
        $this->assertDatabaseHas('permissions', ['name' => 'delete videos']);
    }
}
