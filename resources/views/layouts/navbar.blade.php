<nav class="top-nav">
    <div class="top-nav-left-side">
        <i class="fas fa-bars top-nav-menu" id="top-nav-menu-btn"></i>
        <a href="{{route('index')}}"><img src="{{asset('img/logo.png')}}" alt="" class="top-nav-logo"></a>
    </div>
    <form method="GET" class="top-nav-search-container">
        <input type="text" placeholder="Search">
        <button type="submit"><i class="fas fa-search "></i></button>
    </form>
    <div class="top-nav-right-side">
        @guest
        <a class="btn" href="{{route('login')}}">
            <i class="fas fa-user"></i>
            SIGN IN
        </a>
        <a class="btn" href="{{route('register')}}">
            <i class="fas fa-user"></i>
            REGISTER
        </a>

        @endguest


        {{-- start logged in section --}}
        @auth
        <i class="fas fa-camera top-nav-right-icon" id="upload-icon-btn"></i>
        <i class="fas fa-bell top-nav-right-icon"></i>
        <img src="{{asset('img/default_avatar.png')}}" alt="" class="top-nav-avatar" id="top-nav-avatar">
        {{-- avatar pop up --}}
        <div class="menu-pop">
            <div class="menu-pops">
                <a href="#" class="sidebar-item active">
                        <div class="sidebar-item-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="sidebar-item-title">Home</div>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-item-icon">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div class="sidebar-item-title">Trending</div>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-item-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>Subscriptions</div>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-item-icon">
                            <i class="fas fa-thumbs-up"></i>
                        </div>
                        <div class="sidebar-item-title">Liked Videos</div>
                    </a>

                    <div class="line-break"></div>

                    <div class="sidebar-heading">
                        SUBSCRIPTIONS
                    </div>

                    <a href="#" class="sidebar-item">
                        <div class="sidebar-item-icon">
                            <img src="{{asset('img/default_avatar.png')}}" alt="" class="sidebar-item-avatar">
                        </div>
                        <div class="sidebar-item-title">Grant Cardone</div>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-item-icon">
                            <img src="{{asset('img/default_avatar.png')}}" alt="" class="sidebar-item-avatar">
                        </div>
                        <div class="sidebar-item-title">ProducerMichael</div>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-item-icon">
                            <img src="{{asset('img/default_avatar.png')}}" alt="" class="sidebar-item-avatar">
                        </div>
                        <div class="sidebar-item-title">Subscriptions</div>
                    </a>
                </div>
            </div>
            {{-- end avatar pop --}}
        </div>
        @endauth

</nav>
