<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_have_role()
    {
        create_roles();
        define_permissions();
        create_user('Admin User', 'admin@example.com', '123456789', 'admin');
        create_user('Student User', 'student@example.com', '123456789', 'student');
        $admin = User::where('email', 'admin@example.com')->first();
        $student = User::where('email', 'student@example.com')->first();
        $this->assertTrue($this->isAdministrator($admin));
        $this->assertFalse($this->isAdministrator($student));
    }

    public function isAdministrator(User $user)
    {
        return $user->getRole() === 'admin';
    }
}
