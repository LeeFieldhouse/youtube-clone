        {{-- start add comment section --}}
        <div class="comment-count">1,376 Comments</div>
        <br>
        @auth
        <div class="add-comment-section">
            <img src="{{auth()->user()->avatar}}" alt="" class="comment-avatar">
            <form class="submit-comment" id="submit-comment">
                <textarea name="comment-text" id="comment-text" class="comment-text" placeholder="Add a public comment..."></textarea>
                <button class="submit-comment-button" id="submit-comment-button" type="submit" class="">COMMENT</button>


            </form>
        </div>
        @endauth
        {{-- end add comment section --}}



        {{-- start comment section --}}
        {{-- FOREACH COMMENT --}}
            <div class="view-comment-card">
                <img src="{{auth()->user()->avatar}}" class="comment-avatar" alt="" class="view-comment-avatar">
                <div class="view-comment">
                    <div class="view-comment-user">
                        Caroline
                    </div>
                    <div class="view-comment-comment">
                        Hello sir dear me Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus magnam possimus vel excepturi, harum ipsam nostrum vitae quasi, unde cum est. Corrupti expedita dicta numquam consequuntur veniam porro optio recusandae?
                    </div>
                    <div class="video-comment-date">
                        1 month ago
                    </div>
                    <br>
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
        {{-- END FOREACH COMMENT --}}
        {{-- end comment section --}}

