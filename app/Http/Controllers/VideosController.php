<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideosController extends Controller
{
    /**
     * Show the video by ID.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $video = Video::findOrFail($id);
        $embedUrl = str_replace('watch?v=', 'embed/', $video->url);

        return view('video.show', compact('video', 'embedUrl'));
    }

    /**
     * Return the class of the test that tests this controller.
     *
     * @return \Tests\Unit\VideoTest
     */
    public function testedBy()
    {
        return \Tests\Unit\VideosTest::class;
    }
}
