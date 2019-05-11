@extends('layouts.layout')
@section('title')
    {{$video->title}}
@endsection
@section('content')
<!-- start video page body -->
<div class="video-page-body">
        {{-- start video & video description section --}}
        @include('includes.showvideo.videosection')
        {{-- end video & video description section --}}
        <br>
        {{-- start video comment section --}}
        @include('includes.showvideo.commentsection')
        {{-- end video comment section --}}

    </div><!-- end video page main column in videosection -->




    {{-- start side col --}}
    <div class="video-page-side-col">
        <div class="section-title">
            {{$video->title}}
        </div>
    </div>
    {{-- end side col --}}
</div>
{{-- end flex col wrapper --}}

</div><!-- end video page body -->


@endsection

@section('script')
<script>
$(document).ready(()=> {

    // add comment js
    $('#comment-text').keyup(()=>{

        if($('#comment-text').val() !== ''){
            $('#submit-comment-button').css({background: '#065FD4'});
        }else{
            $('#submit-comment-button').css({background: '#cccccc'});
        }
    })
    //


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

    // expand comment text

    // end expand comment text

})
</script>
@endsection
