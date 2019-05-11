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
                {{$video->description}}
                </div>
                <div id="show-more-btn" class="show-more-btn">SHOW MORE</div>
            </div>

        </div>
{{-- end video description section --}}
