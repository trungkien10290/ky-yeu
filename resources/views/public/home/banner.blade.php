@if(!empty($banners) && $banners->count() > 0)
    <section class="banner relative">
        @include('public._block.banner_social')
        <div class="banner-slider swiper">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="banner-item swiper-slide">
                        @if(!empty($banner->video))
                            <video src="{{$banner->video}}">
                                <source src="{{$banner->video}}" type="video/mp4">
                            </video>
                        @else
                            <img src="{{image($banner->thumbnail)}}"
                                 alt="{{$banner->thumbnail}}">
                        @endif

                    </div>
                @endforeach
            </div>
        </div>
        @if($banners->count() > 1)
            <div class="swiper-button swiper-button-prev"><i class="fal fa-arrow-left"></i> prev</div>
            <div class="swiper-button swiper-button-next"> NEXT<i class="fal fa-arrow-right"></i></div>
            <div class="swiper-pagination"></div>
        @endif
    </section>
@endif
