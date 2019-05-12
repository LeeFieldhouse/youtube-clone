        {{-- start add comment section --}}
        <div class="comment-count">1,376 Comments</div>
        <br>
        @auth
        <div class="add-comment-section">
            <img src="{{auth()->user()->avatar}}" alt="" class="comment-avatar">
            <form class="submit-comment" id="submit-comment">
                <textarea name="comment_text" id="comment-text" class="comment-text" placeholder="Add a public comment..."></textarea>
                <button class="submit-comment-button" id="submit-comment-button" type="submit" class="">COMMENT</button>
            </form>
        </div>
        @endauth
        {{-- end add comment section --}}



        {{-- start comment section --}}
        {{$commentId = 0}}
        @foreach($video->comments->sortByDesc('created_at') as $comment)
            <div class="view-comment-card">
                <img src="{{auth()->user()->avatar}}" class="comment-avatar" alt="" class="view-comment-avatar">
                <div class="view-comment">
                    <div class="view-comment-user">
                        {{$comment->user->username}}
                    </div>
                    <div class="view-comment-comment">
                        {{$comment->comment}}
                    </div>
                    <div class="video-comment-date">
                        {{$comment->created_at->diffForHumans()}}
                    </div>

                    <div class="video-page-like-dislike ">
                        <form id="like-video-submit" class="like-video-form  ">
                            <button type="submit"
                            class="
                            @auth
                            @if($liked)
                            liked
                            @endif
                            @endauth
                            like-video-button
                            small-likes
                            ">
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
                            small-likes
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
                            @auth
        <div class="add-comment-section">
            <img src="{{auth()->user()->avatar}}" alt="" class="comment-avatar">
            <form class="submit-comment" id="submit-reply-{{$commentId}}">
                <textarea name="comment_text" id="reply-text-{{$commentId}}" class="comment-text" placeholder="Add a public comment..."></textarea>
                <button class="submit-comment-button" id="submit-reply-button" type="submit" class="">REPLY</button>
            </form>
        </div>
        @endauth
                </div>
                <div class="view-comment-settings">
                    <i class="fas fa-ellipsis-v"></i>
                </div>

            </div>




        {{-- end comment section --}}

        {{-- toggle reply section --}}
            @if($comment->replies->count() != 0)
            <div class="toggle-replies">
                <div id="show-replies" class="show-replies">
                    View {{$comment->replies->count()}} replies <i class="fas fa-arrow-down"></i>
                </div>
                <div id="hide-replies" class="hide-replies">
                    Hide replies <i class="fas fa-arrow-up"></i>
                </div>
            </div>
            @endif
        {{-- end toggle reply section --}}


        {{-- start reply section --}}
        @foreach($comment->replies as $reply)
            <div class="view-comment-card reply">
                <img src="{{$reply->user->avatar}}" class="reply-avatar" alt="" >
                <div class="view-comment">
                    <div class="view-comment-user">
                        {{$reply->user->username}}
                    </div>
                    <div class="view-comment-comment">
                        {{$reply->reply}}
                    </div>
                    <div class="video-comment-date">
                        {{$reply->created_at->diffForHumans()}}
                    </div>

                    <div class="video-page-like-dislike ">
                        <form id="like-video-submit" class="like-video-form  ">
                            <button type="submit"
                            class="
                            @auth
                            @if($liked)
                            liked
                            @endif
                            @endauth
                            like-video-button
                            small-likes
                            ">
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
                            small-likes
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
                <div class="view-comment-settings">
                    <i class="fas fa-ellipsis-v"></i>
                </div>
            </div>
            @endforeach
            {{$commentId++}}
        {{-- end reply section --}}
        @endforeach

