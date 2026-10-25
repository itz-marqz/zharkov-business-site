<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::where('is_active', true)->latest()->paginate(9);

        return view('frontend.video', compact('videos'));
    }
}
