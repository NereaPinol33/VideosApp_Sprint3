<?php

namespace Tests\Unit;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoDatesTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_formatted_published_at_date()
    {
        $video = Video::factory()->create([
            'published_at' => Carbon::create(2023, 10, 1, 12),
            'author_id' => 1,
        ]);

        $formattedDate = $video->formatted_published_at;

        $this->assertEquals('01 de October de 2023', $formattedDate);
    }

    public function test_can_get_formatted_published_at_date_when_not_published()
    {
        $video = Video::factory()->create([
            'published_at' => null,
            'author_id' => 1,
        ]);

        $formattedDate = $video->formatted_published_at;

        $this->assertEquals('No publicado', $formattedDate);
    }
}
