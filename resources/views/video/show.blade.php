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
                    @if($liked)
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
                    @if($disliked)
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

        <div class="line-break"></div>

        {{-- start video description section --}}
        <div class="video-description-section">
            <div class="video-description-head-row">
                <div class="video-description-head-left">
                    <img src="{{$video->user->avatar}}" alt="" class="video-description-avatar">
                    <div class="video-description-head-left-info">
                        <div>{{$video->user->username}}</div>
                        <div>
                            Published on {{$video->created_at->format('j M Y')}}
                        </div>
                    </div>

                </div>

                {{-- sub buttons --}}
                @auth
                <div>

                        <form class="video-description-head-right
                        subscribe-btn
                        @if(!$subscribed)
                            show-btn
                        @endif
                        " id="subscribe-btn" method="POST">

                            <button type="submit">Subscribe <span>{{$subcount}}</span></button>
                        </form>

                        <form  id="unsubscribe-btn" method="POST" class="video-description-head-right
                        subscribe-btn
                        @if($subscribed)
                            show-btn
                        @endif
                        ">

                            <button class="unsub-btn" type="submit">Unsubscribe <span>{{$subcount}}</span></button>
                        </form>

                </div>
                @endauth

            </div>
            <div class="video-description-row">
                <div id="video-description" class="video-description-short video-description-full">
                ■ INDIA, AHMEDABAD: With the collapse of the 1st Indian front, fresh thinking was needed. I decided to venture down a completely new alley. To my great surprise the Daru man and all the hangers on immediately ceased to shadow me. Maybe they were not welcome in that street. Either way with now that I was finally alone I felt my chances of seeing the inside of an Indian home in this neighborhood were vastly inmproved.
                </div>
                <div id="show-more-btn" class="show-more-btn">SHOW MORE</div>
            </div>

        </div>
        {{-- end video description section --}}
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

    //start video dislike submit
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
    }); //end video dislike  submit


    // start video subscripe submit
    $('#subscribe-btn').click(function (e) {

        e.preventDefault();

        $.ajax({
            url: '{{route('subscribe', $video->user->username)}}',
            type: 'POST',
            data: {_token: CSRF_TOKEN},
            dataType: 'JSON',

            success: function (data){
                $('#unsubscribe-btn').addClass('show-btn').removeClass('hide-btn');
                $('#subscribe-btn').addClass('hide-btn');
                $('.subscribe-btn button span').text(data.subcount)
            }
        });
    });
    //end video subscribe submit

    // start video subscripe submit
    $('#unsubscribe-btn').click(function (e) {

        e.preventDefault();

        $.ajax({
            url: '{{route('unsubscribe', $video->user->username)}}',
            type: 'POST',
            data: {_token: CSRF_TOKEN},
            dataType: 'JSON',

            success: function (data){
                $('#unsubscribe-btn').addClass('hide-btn');
                $('#subscribe-btn').removeClass('hide-btn').addClass('show-btn');
                $('.subscribe-btn button span').text(data.subcount)
            }
        });
    });
    //end video subscribe submit



    // start show more description
    $('#show-more-btn').click(() => {
        $('#video-description').toggleClass('video-description-short')
        if($('#video-description').hasClass('video-description-short')){
            $('#show-more-btn').text('SHOW MORE');
        }else{
            $('#show-more-btn').text('SHOW LESS');
        }
    })
    // end show more description

})
</script>
@endsection
