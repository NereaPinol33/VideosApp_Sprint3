<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        echo "Creating default roles...\n";
        create_roles();
        echo "Creating default permissions...\n";
        define_permissions();
        echo "Creating default regular user...\n";
        create_user('Regular User', 'regular@videosapp.com', '123456789', 'student', true, 'Students');
        echo "Creating default Teacher user...\n";
        create_user('Teacher User', 'teacher@videosapp.com', '123456789', 'teacher', true, 'Teachers');
        echo "Creating default admin user...\n";
        create_user('Admin User', 'admin@videosapp.com', '123456789', 'admin');
        echo "Creating example Teacher video...\n";
        create_video('Default Teacher Video', 'This is a default teacher video description.', 'http://example.com/default-teacher-video', 2);
    }
}
