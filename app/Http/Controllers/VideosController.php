<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideosController extends Controller
{
    /**
     * Return the tester's name.
     *
     * @param  string  $tester
     * @return string
     */
    public function testedBy($tester)
    {
        return "The tester is $tester";
    }

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
}
