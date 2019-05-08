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
                164,392 views
            </div>
            <div class="video-page-like-dislike">
                <form action="" class="like-video-form">
                    <button type="submit">
                        <i class="fas fa-thumbs-up"></i>
                        2.4k
                    </button>
                </form>
                <form action="" class="like-video-form">
                    <button type="submit">
                        <i class="fas fa-thumbs-down"></i>
                        2.8k
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
