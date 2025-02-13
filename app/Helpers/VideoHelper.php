<?php

use App\Models\Video;

if (! function_exists('create_default_teacher_video')) {
    /**
     * Create a default teacher video if it doesn't exist.
     *
     * @return void
     */
    function create_default_teacher_video()
    {
        if (Video::where('title', env('DEFAULT_TEACHER_VIDEO_TITLE'))->exists()) {
            return;
        }

        $video = new Video;
        $video->title = env('DEFAULT_TEACHER_VIDEO_TITLE');
        $video->description = env('DEFAULT_TEACHER_VIDEO_DESCRIPTION');
        $video->url = env('DEFAULT_TEACHER_VIDEO_URL');
        $video->published_at = now();
        $video->save();
    }
}
