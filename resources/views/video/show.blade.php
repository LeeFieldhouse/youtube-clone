@extends('layouts.layout')
@section('title')
    {{$video->title}}
@endsection
@section('content')
{{-- start main video --}}
<video

    controls
    autoplay
>
    <source
        src="{{asset($video->video_url)}}"
        type="video/{{$video->file_type}}"
    />
    Your browser does not support the video tag.
</video>
{{-- end main video --}}
{{-- start flex col wrapper --}}
<div class="video-page-wrapper">
    {{-- start main col --}}
    <div class="video-page-main-col">
        {{-- start video page title --}}
        <div class="section-title">
            {{$video->title}}
        </div>
        {{-- end video page title --}}
        {{-- start view count & likes section --}}
        <div class="video-page-view-likes-section">
            <div class="video-page-view-count">
                {{$video->view_count}} views
            </div>
            <div class="video-page-like-dislike">
                <form id="like-video-submit" class="like-video-form">
                    <button type="submit"
                    class="
                    @auth
                    @if($video->likes()->where(['user_id' => Auth::user()->id, 'video_id' => $video->id])->first())
                    liked
                    @endif
                    @endauth
                    like-video-button">
                        <i class="fas fa-thumbs-up"></i>
                        <span id="video-like-count">
                            {{$video->likes()->count()}}
                        </span>
                    </button>
                </form>
            <form id="dislike-video-submit"  method="POST" class="like-video-form">
                @csrf
                    <button type="submit" class="
                    like-video-button
                    @auth
                    @if($video->dislikes()->where(['user_id' => Auth::user()->id, 'video_id' => $video->id])->first())
                    liked
                    @endif
                    @endauth
                    ">
                        <i class="fas fa-thumbs-down"></i>
                        <span id="video-dislike-count">
                            {{$video->dislikes()->count()}}
                        </span>
                    </button>
                </form>
            </div>
        </div>
        {{-- end view count & likes section --}}
    </div>
    {{-- end main col --}}
    {{-- start side col --}}
    <div class="video-page-side-col">
        <div class="section-title">
            {{$video->title}}
        </div>
    </div>
    {{-- end side col --}}
</div>
{{-- end flex col wrapper --}}


@endsection

@section('script')
<script>
$(document).ready(()=> {

    // Like Video
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


    //start video like submit
    $("#like-video-submit").submit(function(e){
        e.preventDefault();
            $.ajax({
                /* the route pointing to the post function */
                url: '{{route("likeVideo", $video->slug )}}',
                type: 'POST',

                data: {_token: CSRF_TOKEN},
                dataType: 'JSON',

                success: function (data) {
                    $('#like-video-submit span').text(data.videoLikeCount);
                    $('#dislike-video-submit span').text(data.videoDislikeCount);
                    $('#like-video-submit button').addClass('liked')
                    $('#dislike-video-submit button').removeClass('liked')
                }
            });
    }); //end video like  submit

    //start video like submit
    $("#dislike-video-submit").submit(function(e){
        e.preventDefault();
            $.ajax({
                /* the route pointing to the post function */
                url: '{{route("dislikeVideo", $video->slug )}}',
                type: 'POST',

                data: {_token: CSRF_TOKEN},
                dataType: 'JSON',

                success: function (data) {
                    $('#like-video-submit span').text(data.videoLikeCount);
                    $('#dislike-video-submit span').text(data.videoDislikeCount);
                    $('#dislike-video-submit button').addClass('liked')
                    $('#like-video-submit button').removeClass('liked')
                }
            });
    }); //end video like  submit




})
</script>
@endsection
