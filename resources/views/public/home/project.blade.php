<section class="projects">
    <div class="container">
        <div class="text-center projects-title" data-aos="fade-up" data-aos-duration="2000">
            <span>giới thiệu <span>dự án</span></span></div>
    </div>
    <div class="pj-slider swiper" data-aos="fade-up" data-aos-duration="3000">
        <div class="swiper-wrapper">
            @foreach($projects as $project)
                <div class="pj-item relative swiper-slide">
                    <a href="<?= route('bug.index',['project_id' => $project->id]) ?>" title="" class="zoom zoom-img"><span><img
                                src="{{image($project->thumbnail)}}"
                                alt="{{$project->trans('title')}}"> </span></a>
                    <div class="pj-abs">
                        <div class="pj-text flex-center-center">
                            <h4><a href="<?= route('bug.index',['project_id' => $project->id]) ?>" title="{{$project->trans('title')}}">{{$project->trans('title')}}</a></h4>
                            <a href="<?= route('bug.index',['project_id' => $project->id]) ?>" title="{{$project->trans('title')}}" class="btn-dt inflex-center-center"><i
                                    class="fal fa-search-plus"></i> </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-button swiper-button-prev swiper-button-prev-1"><i class="fal fa-arrow-left"></i>
            prev
        </div>
        <div class="swiper-button swiper-button-next swiper-button-next-1"> NEXT<i
                class="fal fa-arrow-right"></i></div>
    </div>
</section>
