<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoLike;
use App\Video;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\VideoDislike;

class VideoLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function like($video) {


        $video = Video::where('slug', $video)->first();
        $videoLikeCount = VideoLike::where('video_id', $video->id)->count();
        $videoDislikeCount = VideoDislike::where('video_id', $video->id)->count();

        $likedAlready = $video->likes()->where('user_id', auth()->id())->first();
        $dislikedAlready = $video->dislikes()->where('user_id', auth()->id())->first();



        // if liked already then just return the count
        if($likedAlready){
            return response()->json(array(
                'videoLikeCount'=> $videoLikeCount,
                'videoDislikeCount' => $videoDislikeCount
            ));
        }

        // check if disliked, if so delete dislike
        elseif($dislikedAlready){
            $dislikedAlready->delete();
            $videoDislikeCount = VideoDislike::where('video_id', $video->id)->count();

        }

        // continue and create like
        $like = new VideoLike;
        $like->user_id = auth()->id();
        $like->video_id = $video->id;
        $like->save();
        $videoLikeCount = VideoLike::where('video_id', $video->id)->count();

        return response()->json(array(
            'videoLikeCount'=> $videoLikeCount,
            'videoDislikeCount' => $videoDislikeCount
        ));


    }


    public function dislike($video) {

        if(auth()){
            $video = Video::where('slug', $video)->first();

            $videoLikeCount = VideoLike::where('video_id', $video->id)->count();
            $videoDislikeCount = VideoDislike::where('video_id', $video->id)->count();

            $likedAlready = $video->likes()->where('user_id', auth()->id())->first();
            $dislikedAlready = $video->dislikes()->where('user_id', auth()->id())->first();

            // if disliked already just return current count
            if($dislikedAlready){
                return response()->json(array(
                    'videoLikeCount'=> $videoLikeCount,
                    'videoDislikeCount' => $videoDislikeCount
                ));
            }
            // check if liked, if so delete like
            elseif($likedAlready){
                $likedAlready->delete();
            }

            // carry on and create dislike
            $like = new VideoDislike;
            $like->user_id = auth()->id();
            $like->video_id = $video->id;
            $like->save();
            $videoLikeCount = VideoLike::where('video_id', $video->id)->count();
            $videoDislikeCount = VideoDislike::where('video_id', $video->id)->count();


            return response()->json(array(
                'videoLikeCount'=> $videoLikeCount,
                'videoDislikeCount' => $videoDislikeCount
            ));
        }

    }
}
