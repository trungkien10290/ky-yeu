<header>
    <div class="logo"><a href="{{base_url_lang()}}" title="{{setting()->trans('seo_title')}}">
            <img src="{{public_logo()}}"
                 alt="{{setting()->trans('seo_title')}}">
        </a></div>
    <div class="header_main">
        <div class="container">
            <div class="flex-center-end">
                <div class="search-box">
                    <form class="se-frm" action="{{route('bug.index')}}">
                        <input name="search" value="{{request('search')}}" type="text"
                               placeholder="{{__('public.keyword')}}">
                    </form>
                    <button class="btn-search"><i class="fal fa-search"></i></button>
                </div>

                <a href="{{$urlLangChange ?? url_change_lang()}}" class="language text-uppercase"
                   title="{{lang_change()}}">{{lang_change()}}</a>
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
