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


    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');



    //start video like submit
    $("#like-video-submit").submit(function(e){
        e.preventDefault();

            $.post('{{route("likeVideo", $video->slug )}}',
                {_token: CSRF_TOKEN},
                function (data) {
                    $('#like-video-submit span').text(data.videoLikeCount);
                    $('#dislike-video-submit span').text(data.videoDislikeCount);
                    $('#like-video-submit button').addClass('liked')
                    $('#dislike-video-submit button').removeClass('liked')
                },
                'JSON'
                 )

    }); //end video like  submit

    //start video dislike submit
    $("#dislike-video-submit").submit(function(e){
        e.preventDefault();
        $.post(
            '{{route("dislikeVideo", $video->slug)}}',
            {_token: CSRF_TOKEN},
            function (data){
                $('#like-video-submit span').text(data.videoLikeCount)
                $('#dislike-video-submit span').text(data.videoDislikeCount)
                $('#dislike-video-submit button').addClass('liked')
                $('#like-video-submit button').removeClass('liked')
            },
            'JSON'
        )



    }); //end video dislike  submit


    // start video subscripe submit
    $('#subscribe-btn').submit(function (e) {

        e.preventDefault();
        $.post(
            '{{route("subscribe", $video->user->username)}}',
            {_token: CSRF_TOKEN},
            function(data){
                $('#unsubscribe-btn').addClass('show-btn').removeClass('hide-btn');
                $('#subscribe-btn').addClass('hide-btn');
                $('.subscribe-btn button span').text(data.subcount)
            },
            'JSON'
        )
    });
    //end video subscribe submit

    // start video unsubscripe submit
    $('#unsubscribe-btn').submit(function (e) {
        e.preventDefault();
        $.post(
            '{{route("unsubscribe", $video->user->username)}}',
            {_token: CSRF_TOKEN},
            function(data){
                $('#unsubscribe-btn').addClass('hide-btn');
                $('#subscribe-btn').removeClass('hide-btn').addClass('show-btn');
                $('.subscribe-btn button span').text(data.subcount)
            },
            'JSON'
        )
    });
    //end video unsubscribe submit


    // start add comment
    $('#comment-text').keyup(()=>{

        if($('#comment-text').val() !== ''){

            $('#submit-comment-button').css({background: '#065FD4'});
        }else{
            $('#submit-comment-button').css({background: '#cccccc'});
        }
    })

    // start submit comment
    $('#submit-comment').submit(e =>{
        e.preventDefault()

        $.post(
            '{{route("videoComment", $video->slug)}}',
            {
                _token: CSRF_TOKEN,
                comment_text: $('#comment-text').val()
            },
            function(data){
                alert(data)
            },
            'JSON'
        )
    })
    // end submit comment
    // end add comment


    // start replies
    $('#reply-text').keyup(()=>{
        if($('#reply-text').val() !== ''){
            $('#submit-reply-button').css({background: '#065FD4'});
        }else{
            $('#submit-reply-button').css({background: '#cccccc'});
        }
    })
    // show replies
    $('.show-replies').click(()=>{
        $('.view-comment-card.reply').addClass('hide');
        $('.show-replies').hide()
        $('.hide-replies').show()
    })
    $('.hide-replies').click(() => {
        $('.view-comment-card.reply').removeClass('hide');
        $('.hide-replies').hide()
        $('.show-replies').show()
    })
    // end show rpelies

})
</script>
@endsection
