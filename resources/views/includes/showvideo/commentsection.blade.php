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

        {{-- end comment section --}}

