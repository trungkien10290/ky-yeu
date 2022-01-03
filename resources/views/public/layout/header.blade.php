<header>
    <div class="logo"><a href="" title=""><img src="frontend/images/logo.png" alt=""> </a></div>
    <div class="header_main">
        <div class="container">
            <div class="flex-center-end">
                <button class="btn-search"><i class="fal fa-search"></i></button>
                <a href="{{url_change_lang()}}" class="language"
                   title="">{{get_lang()}}</a>
                <div class="user flex-center">
                    @if (auth()->check())

                        <div class="user flex-center mr-2">
                            <span><img src="{{auth()->user()->avatar}}" alt="Avatar"> </span>
                            {{auth()->user()->name}}
                        </div>
                        <a href="{{route('login.logOut')}}"
                           title="">Logout</a>
                    @else
                        <a href="{{route('login.index')}}"
                           title="">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
