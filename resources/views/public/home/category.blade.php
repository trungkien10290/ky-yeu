<section class="box-list">
    <div class="container">
        <div class="row">
            @foreach ($projects as $project)
                <div class="col-md-6 mgb-30" data-aos="fade-up" data-aos-duration="2000">
                    <div class="list-item">
                        <a href="<?= route('bug.index', ['project_id' => $project->id])?>" title=""
                           class="zoom zoom-img"><span><img
                                    src="{{image($project->thumbnail)}}"
                                    alt="{{$project->thumbnail}}"> </span></a>
                        <div class="list-cache relative">
                            <h2><a href="<?= route('bug.index', ['project_id' => $project->id]) ?>"
                                   title="">{{$project->trans('title')}}</a></h2>
                            <div class="list-ls">
                                <div class="row">
                                    @foreach ($bugCates as $bugCate)
                                        <div class="col-md-6">
                                            <div class="ls-item flex">
                                                <a href="<?= route('bug.index', ['project_id' => $project->id, 'category_id' => $bugCate->id]) ?>"
                                                   title="" class="zoom"><img
                                                        src="{{image($bugCate->thumbnail)}}"
                                                        alt=""> </a>
                                                <div>
                                                    <h4>
                                                        <a href="<?= route('bug.index', ['project_id' => $project->id, 'category_id' => $bugCate->id]) ?>"
                                                           title="">{{$bugCate->trans('title')}}</a></h4>
                                                    <p>
                                                        <span>{{$projectCategoryStatistic->getBugsCountActive($project->id,$bugCate->id)}}</span> {{__('public.error')}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="ls-log flex-center-center">
                                <a href="{{$project->slugLink}}"
                                   title="{{$project->trans('title')}}">
                                    <img
                                        src="{{image($project->logo)}}"
                                        alt="{{$project->logo}}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="list-re">
            <h2 class="title-page" data-aos="fade-up" data-aos-duration="2000">{{__('public.other category')}}</h2>
            <div class="row">
                @foreach ($otherCate as $category)
                    <div class="col-md-3 mb-3" data-aos="fade-up" data-aos-duration="2000">
                        <div class="re-item flex">
                            <a href="<?= route('bug.index', ['category_id' => $category->id]) ?>" title=""
                               class="zoom"><img
                                    src="{{image($category->thumbnail)}}"
                                    alt="{{$category->thumbnail}}"> </a>
                            <div class="re-text">
                                <h4><a href="<?= route('bug.index', ['category_id' => $category->id]) ?>"
                                       title="{{$category->trans('title')}}">{{ $category->trans('title') }}</a></h4>
                                <p>
                                    <span>{{$projectCategoryStatistic->getBugsCountActive(null,$category->id)}}</span>
                                    lỗi</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
