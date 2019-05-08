<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoLike;
use App\Video;

class VideoLikeController extends Controller
{
    public function like($video) {

        $video = Video::where('slug', $video)->first();
        $like = new VideoLike;
        $like->user_id = auth()->id();
        $like->video_id = $video->id;
        $like->save();

        return VideoLike::where('video_id', $video->id)->count();

    }
}
