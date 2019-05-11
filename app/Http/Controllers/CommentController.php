<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Video;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    function addCommentToVideo($video, Request $request){



        $video = Video::where( 'slug', $video)->first();

        $comment = new Comment;

        $comment->user_id = auth()->id();

        $comment->comment = $request->comment_text;

        $comment->video_id = $video->id;

        $comment->save();

        return response()->json('Success');

    }
}
