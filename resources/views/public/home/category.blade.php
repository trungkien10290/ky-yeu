<section class="box-list">
    <div class="container">
        <div class="row">
            @foreach ($projects as $project)
            <div class="col-md-6 mgb-30" data-aos="fade-up" data-aos-duration="2000">
                <div class="list-item">
                    <a href="<?= route('bug.index',['project_id' => $project->id])?>" title="" class="zoom zoom-img"><span><img
                                src="{{$project->thumbnail}}"
                                alt=""> </span></a>
                    <div class="list-cache relative">
                        <h2><a href="<?= route('bug.index',['project_id' => $project->id]) ?>" title="">{{$project->trans('title')}}</a></h2>
                        <div class="list-ls">
                            <div class="row">
                                @foreach ($bugCates as $bugCate)
                                    <div class="col-md-6">
                                        <div class="ls-item flex">
                                            <a href="<?= route('bug.index',['project_id' => $project->id,'category_id' => $bugCate->id]) ?>" title="" class="zoom"><img
                                                    src="{{$bugCate->thumbnail}}"
                                                    alt=""> </a>
                                            <div>
                                                <h4><a href="<?= route('bug.index',['project_id' => $project->id,'category_id' => $bugCate->id]) ?>" title="">{{$bugCate->trans('title')}}</a></h4>
                                                <p><span>200</span> lỗi</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="ls-log flex-center-center"><a href="" title=""><img
                                    src="frontend/images/logo-sm.png"
                                    alt=""> </a></div>
                    </div>
                </div>
            </div>
            @endforeach
            
            
        </div>
        <div class="list-re">
            <h2 class="title-page" data-aos="fade-up" data-aos-duration="2000">danh mục khác</h2>
            <div class="row">
                @foreach ($otherCate as $othc)
                <div class="col-md-3" data-aos="fade-up" data-aos-duration="2000">
                    <div class="re-item flex">
                        <a href="<?= route('bug.index',['project_id' => $othc->id]) ?>" title="" class="zoom"><img src="{{$othc->thumbnail}}"
                                                                                       alt=""> </a>
                        <div class="re-text">
                            <h4><a href="<?= route('bug.index',['project_id' => $othc->id]) ?>" title="{{$othc['title']}}">{{ $othc->trans('title') }}</a></h4>
                            <p><span>200</span> lỗi</p>
                        </div>
                    </div>
                </div>
                @endforeach
                
                
            </div>
        </div>
    </div>
</section>
