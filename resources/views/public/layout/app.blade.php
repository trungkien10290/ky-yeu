<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{url('/')}}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ | </title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content=""/>
    <meta name="copyright" content=""/>
    <meta property="og:image" content="">
    <!--link css-->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="frontend/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/styles.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/custom.css">
    <script type="text/javascript" src="frontend/js/jquery.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
</head>
<body>

@include('public.layout.header')
<main>
    @yield('content')

</main>
@include('public.layout.footer')


<!--Link js-->
<script type="text/javascript" src="frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="frontend/js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="frontend/js/private.js"></script>

@stack('js')
</body>
</html>
