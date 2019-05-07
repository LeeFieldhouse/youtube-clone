@extends('layouts.layout')
@section('title')
    {{$video->title}}
@endsection
@section('content')
    <video controls autoplay src="{{asset($video->video_url)}}"></video>
@endsection
