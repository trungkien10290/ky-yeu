<div class="modal-content relative">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i>
    </button>
    <h2 class="text-center">{{__('public.bug detail')}}</h2>
    <div class="er-tq mgb-20 flex-center-between">
        <div class="er-p"><span>{{__('public.unit')}}: </span>{{!empty($bug->project) ? $bug->project->trans('title') : ''}}</div>
        <div class="er-p"><span>{{__('public.category')}}:</span>{{!empty($bug->category) ? $bug->category->trans('title') : ''}}</div>
        <div class="er-p"><span>{{__('public.code')}}:</span>{{$bug->id}}</div>
        <div class="er-p"><span>{{__('public.created date')}}</span>: </span>{{date('d/m/Y',strtotime($bug->date))}}
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
        <?php $bugFiles = is_array($bug->bug_files) ? $bug->bug_files : []?>
        @if(!empty($bugFiles))
            <div class="er-doc">
                <h4>{{__('public.attach files')}}:</h4>
                <ul>
                    @foreach($bugFiles as $file)
                        <li><a href="{{image($file)}}" title="" target="_blank"><i class="fal fa-file"></i>{{$file}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
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
                <?php $solutionFiles = is_array($bug->solution_files) ? $bug->solution_files : []?>
                @if(!empty($solutionFiles))
                    <div class="er-doc">
                        <h4>{{__('public.attach files')}}:</h4>
                        <ul>
                            @foreach($solutionFiles as $file)
                                <li><a href="{{image($file)}}" title="" target="_blank"><i
                                            class="fal fa-file"></i>{{$file}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="er-gy">
        <h3>{{__('public.feedback')}}</h3>
        <div class="box_view">
            @foreach($bug->comments as $comment)
                @include('public.bug.comment',['comment' => $comment])
            @endforeach

        </div>
        @if(auth()->check())
            <div class="view_item">
                <span><img src="{{auth()->user()->avatar}}" alt=""> </span>
                <div class="view_cmt">
                    <form method="POST" action="<?= route('comment.create')?>" class="form_modal"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="bug_id" value="{{$bug->id}}">
                        <textarea placeholder="{{__('public.send your feedback')}}" name="content"></textarea>
                        <div class="text-danger mb-3" id="comment-errors"></div>
                        <div class="text-info d-none" id="file-count-text">{{__('public.selected')}}<span
                                id="file-count"> </span> file
                        </div>
                        <div class="flex-end-between">
                            <div class="file-fake">
                                <label class="relative">
                                    <input type="file" multiple name="files[]" id="files">
                                    <span class="flex-center-center"><i class="fal fa-camera"></i> </span>
                                </label>
                            </div>
                            <button type="submit" class="btn-submit">{{__('public.send')}} <i
                                    class="fal fa-long-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
