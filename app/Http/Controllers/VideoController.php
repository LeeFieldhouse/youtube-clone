<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'video_video' => 'mimetypes:video/avi,video/mpeg,video/mp4|required'
        ]);
        if(Auth::user()){
            $file = $request->video_video;
            $filename = uniqid(Auth::user()->id."_"). '.'.$file->getClientOriginalExtension();
            $path = public_path().'/videos/'. auth()->user()->username. '/';
            $file->move($path, $filename);

            $upload = new Video;
            $upload->title = $request->video_title;
            $upload->video_url = '/videos/' . auth()->user()->username. '/' .$filename;
            $upload->description = $request->video_description;
            $upload->file_type = $file->getClientOriginalExtension();
            $upload->video_thumb = 'nothing';
            $upload->slug = str_replace('.'.$file->getClientOriginalExtension(), '', $filename);
            $upload->user_id = auth()->user()->id;
            if($upload->save()) {
                return redirect()->route('video.show', str_replace('.'.$file->getClientOriginalExtension(), '', $filename));
            }
        }else {
            return redirect()->route('index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */

    public function show(Video $video)
    {
        // subscriber count
            $subcount = $video->user->subscribers->count();
        // end subscriber count

        // add view to view count
            $video->view_count = $video->view_count + 1;
            $video->save();
        // end add view to view count



        if(auth()->user()){
         // check if subscribed to channel
            $subscribed = Auth::user()->subscriptions()->where('channel_id', $video->user->id)->first();
        // end check if subscribed to channel

        // check if liked video
            $liked = $video->likes()->where(['user_id' => Auth::user()->id, 'video_id' => $video->id])->first();
        // end check if liked video

        //  check if disliked video
            $disliked = $video->dislikes()->where(['user_id' => Auth::user()->id, 'video_id' => $video->id])->first();
        // check if disliked video



        return view('video.show')->with([
            'video' => $video,
            'subscribed' => $subscribed,
            'liked' => $liked,
            'disliked' => $disliked,
            'subcount' => $subcount,
        ]);
        }else{
            return view('video.show')->with([
            'video' => $video,
            'subcount' => $subcount,


            ]);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
