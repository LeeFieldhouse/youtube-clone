<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoLike;
use App\Video;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class VideoLikeController extends Controller
{
    public function like($video) {

        $video = Video::where('slug', $video)->first();
        $videoLikeCount = VideoLike::where('video_id', $video->id)->count();
        $videoDislikeCount = 1;
        // check if liked already
        if($video->likes()->where('video_id', $video->id)->where('user_id', auth()->id())){
            return response()->json(array(
                'videoLikeCount'=> $videoLikeCount,
                'videoDislikeCount' => $videoDislikeCount
            ));
        }

        // check if disliked, if so delete TODO DISLIKE MODEL
        elseif($video->likes()->where('video_id', $video->id)->where('user_id', auth()->id())){

        }



        $like = new VideoLike;
        $like->user_id = auth()->id();
        $like->video_id = $video->id;
        $like->save();
        $videoLikeCount = VideoLike::where('video_id', $video->id)->count();
        $videoDislikeCount = 1;


        return response()->json(array(
            'videoLikeCount'=> $videoLikeCount,
            'videoDislikeCount' => $videoDislikeCount
        ));

    }
}
