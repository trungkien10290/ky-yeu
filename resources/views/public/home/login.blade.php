@extends('public.layout.app')
@section('content')
<main class="login">
    <section class="login-box">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="login-box">
                        <div class="login-inner">
                            <p><a href="" title=""><img src="images/logo.png" alt=""> </a> </p>
                            <h4>Đăng nhập Nhật ký lỗi</h4>
                            <form class="login-frm" method="POST" action="{{route('login.logIn')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="frm-input">
                                    <input type="email" name="email" placeholder="Địa chỉ email của bạn">
                                    <span><i class="fal fa-envelope"></i> </span>
                                </div>
                                <div class="frm-input">
                                    <input type="password" name="password" placeholder="Mật khẩu">
                                    <span><i class="fal fa-lock"></i></span>
                                </div>
                                <button type="submit">Đăng nhập</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection