<header>
    <div class="logo"><a href="" title=""><img src="frontend/images/logo.png" alt=""> </a></div>
    <div class="header_main">
        <div class="container">
            <div class="flex-center-end">
                <button class="btn-search"><i class="fal fa-search"></i></button>
                <a href="{{route('set_lang',['lang'=>get_lang() === 'vi' ? 'vi' : 'en'])}}" class="language"
                   title="">{{get_lang()}}</a>
                <div class="user flex-center">
                    @if (Session::has('user'))
                        @php
                            $user = Session::get('user');
                        @endphp
                        <a href="{{route('login.logOut')}}" 
                        title="">Logout</a>
                        <div class="user flex-center">
                            <span><img src="{{$user['thumbnail']}}" alt=""> </span>
                            {{$user['name']}}
                        </div>
                    @else
                    <a href="{{route('login.index')}}" 
                        title="">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
