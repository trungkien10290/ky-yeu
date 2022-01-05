<div class="modal-content relative">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i>
    </button>
    <h2 class="text-center">{{__('public.bug detail')}}</h2>
    <div class="er-tq mgb-20 flex-center-between">
        <div class="er-p"><span>{{__('public.unit')}}: </span>{{$bug->project->title_vi ?? ''}}</div>
        <div class="er-p"><span>{{__('public.category')}}:</span>{{$bug->category->title_vi ?? ''}}</div>
        <div class="er-p"><span>{{__('public.code')}}:</span>{{$bug->id}}</div>
        <div class="er-p"><span>{{__('public.created date')}}</span>:</span>{{date('d/m/Y',strtotime($bug->date))}}
        </div>
    </div>
    <div class="er-p mgb-10"><span>{{__('public.desc bug')}}:</span>{{$bug->trans('desc')}}
    </div>
    <div class="er-gallery">
        <div class="er-images">
            <?php $bugImages = is_array($bug->bug_images) ? $bug->bug_images : []?>
            @foreach($bugImages as $image)
                <span><img src="{{image($image)}}" alt="{{$image}}"> </span>
            @endforeach
        </div>
        <div class="er-doc">
            <h4>{{__('public.attach files')}}:</h4>
            <ul>
                <?php $bugFiles = is_array($bug->bug_files) ? $bug->bug_files : []?>
                @foreach($bugFiles as $file)
                    <li><a href="{{image($file)}}" title="" target="_blank"><i class="fal fa-file"></i>{{$file}} </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="er-box_1">
        <div class="row">
            <div class="col-md-6">
                <div class="box_item">
                    <div class="er-p"><span>{{__('public.reason')}}:</span></div>
                    @php
                        $reasons = string_break_line_to_array($bug->trans('reason'));
                    @endphp
                    <ul class="er-ul">
                        @foreach($reasons as $reason)
                            <li>{{$reason}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box_item">
                    <div class="er-p"><span>{{__('public.consequence')}}:</span></div>
                    @php
                        $consequences = string_break_line_to_array($bug->trans('consequence'));
                    @endphp
                    <ul class="er-ul">
                        @foreach($consequences as $consequence)
                            <li>{{$consequence}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="er-box_2">
        <div class="head">{{__('public.solution')}}</div>
        <div class="r-body">
            @php
                $solutions = string_break_line_to_array($bug->trans('solution'));
            @endphp
            <ul class="er-ul">
                @foreach($solutions as $solution)
                    <li>{{$solution}}</li>
                @endforeach
            </ul>
            <div class="er-gallery">

                <div class="er-images">
                    <?php $solutionImages = is_array($bug->solution_images) ? $bug->solution_images : []?>
                    @foreach($solutionImages as $image)
                        <span><img src="{{image($image)}}" alt="{{$image}}"> </span>
                    @endforeach
                </div>
                <div class="er-doc">
                    <h4>{{__('public.attach files')}}:</h4>
                    <ul>
                        <?php $solutionFiles = is_array($bug->solution_files) ? $bug->solution_files : []?>
                        @foreach($solutionFiles as $file)
                            <li><a href="{{image($file)}}" title="" target="_blank"><i class="fal fa-file"></i>{{$file}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="er-gy">
        <h3>{{__('public.feedback')}}</h3>
        <div class="box_view">
            @foreach($bug->comments as $comment)

                <div class="view_item">
                    <span><img src="{{$comment->user->avatar ?? 'frontend/images/Avt.png'}}" alt="avatar"> </span>
                    <div class="view_text">
                        <p>{{$comment->content}}</p>
                        <div class="er-gallery">
                            <div class="er-images">
                                @php
                                    $images = is_array($comment->images) ? $comment->images : [];
                                @endphp
                                @foreach ($images as $image)
                                    <span><img src="{{image($image)}}" alt="{{$image}}"> </span>
                                @endforeach
                            </div>
                            <div class="er-doc">
                                <h4>{{__('public.attach files')}}:</h4>
                                <ul>
                                    @php
                                        $files = is_array($comment->files) ? $comment->files : [];
                                    @endphp
                                    @foreach($files as $file)
                                        <li><a href="" title="{{$file}}" target="_blank"><i
                                                    class="fal fa-file"></i>{{$file}}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <div class="view_item">
            <span><img src="frontend/images/Avt.png" alt=""> </span>
            <div class="view_cmt">
                <form method="POST" action="<?= route('comment.create')?>" class="form_modal"
                      enctype="multipart/form-data" data-bug-id="{{$bug->id}}">
                    @csrf
                    <textarea placeholder="Gửi góp ý của bạn" name="content"></textarea>
                    <div class="flex-end-between">
                        <div class="file-fake">
                            <label class="relative">
                                <input type="file" multiple name="files[]" id="files">
                                <span class="flex-center-center"><i class="fal fa-camera"></i> </span>
                            </label>
                        </div>
                        <button type="submit" class="btn-submit">Send <i
                                class="fal fa-long-arrow-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
