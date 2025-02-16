<?php

namespace Tests\Feature\Videos;

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_view_videos()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@iesebre.com',
            'password' => bcrypt('password'),
        ]);

        $team = $user->ownedTeams()->create([
            'name' => 'Teachers',
            'personal_team' => false,
        ]);

        $user->switchTeam($team);

        $this->actingAs($user);

        $video = Video::create([
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/watch?v=video-id',
            'published_at' => now(),
            'author_id' => $user->id,
        ]);

        $response = $this->get(route('videos.show', ['id' => $video->id]));

        $response->assertStatus(200);
        $response->assertViewIs('video.show');
        $response->assertViewHas('video', $video);
    }

    public function test_users_cannot_view_not_existing_videos()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('videos.show', ['id' => 1]));

        $response->assertStatus(404);
    }
}
