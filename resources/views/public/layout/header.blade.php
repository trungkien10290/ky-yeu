<header>
    <div class="logo"><a href="" title=""><img src="{{public_logo()}}" alt=""> </a></div>
    <div class="header_main">
        <div class="container">
            <div class="flex-center-end">
                <div class="search-box">
                    <form class="se-frm">
                        <input type="text" placeholder="{{__('public.keyword')}}">
                    </form>
                    <button class="btn-search"><i class="fal fa-search"></i></button>
                </div>

                <a href="{{url_change_lang()}}" class="language"
                   title="">{{get_lang()}}</a>
                <div class="user flex-center">
                    @if (auth()->check())

                        <div class="user flex-center mr-2">
                            <span><img src="{{auth()->user()->avatar}}" alt="Avatar"> </span>
                            {{auth()->user()->name}}
                        </div>
                        <a href="{{route('login.logOut')}}"
                           title="">{{__('public.logout')}}</a>
                    @else
                        <a href="{{route('login.index')}}"
                           title="">{{__('public.login')}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
