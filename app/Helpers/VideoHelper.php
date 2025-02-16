<?php

use App\Models\Video;

if (! function_exists('create_video')) {
    /**
     * Create a video if it doesn't exist.
     *
     * @param  string  $title
     * @param  string  $description
     * @param  string  $url
     * @param  int  $author_id
     * @return void
     */
    function create_video($title, $description, $url, $author_id)
    {
        if (Video::where('title', $title)->exists()) {
            return;
        }

        $video = new Video;
        $video->title = $title;
        $video->description = $description;
        $video->url = $url;
        $video->published_at = now();
        $video->author_id = $author_id;
        $video->save();
    }
}
