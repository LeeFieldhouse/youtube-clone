@extends('layouts.layout')
@section('title')
    {{$video->title}}
@endsection
@section('content')
<div class="main-video">
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
</div>
    {{-- <div class="wrapper">
        <div class="video-page-wrapper">
        <div class="video-page-main-col">
            <div class="section-title">
                {{$video->title}}
            </div>
        </div>
        <div class="video-page-side-col">
            <div class="section-title">
                {{$video->title}}
            </div>
        </div>
        </div>
    </div> --}}
@endsection
