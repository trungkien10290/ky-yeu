<div class="modal-content relative">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i>
    </button>
    <h2 class="text-center">Chi tiết lỗi</h2>
    <div class="er-tq mgb-20 flex-center-between">
        <div class="er-p"><span>Đơn vị: </span>{{$bug->project->title_vi ?? ''}}</div>
        <div class="er-p"><span>Danh mục:</span>{{$bug->category->title_vi ?? ''}}</div>
        <div class="er-p"><span>Mã:</span>{{$bug->id}}</div>
        <div class="er-p"><span>Ngày tạo:</span>{{date('d/m/Y',strtotime($bug->date))}}</div>
    </div>
    <div class="er-p mgb-10"><span>Mô tả lỗi:</span>{{$bug->trans('desc')}}
    </div>
    <div class="er-gallery">
        <div class="er-images">
            <?php $bugImages = is_array($bug->bug_images) ? $bug->bug_images : []?>
            @foreach($bugImages as $image)
                <span><img src="{{image($image)}}" alt="{{$image}}"> </span>
            @endforeach
        </div>
        <div class="er-doc">
            <h4>File đính kèm:</h4>
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
                    <div class="er-p"><span>Nguyên nhân:</span></div>
                    <ul class="er-ul">
                        <li>Do không duyệt kỹ bản shop của nhà thầu</li>
                        <li>Công nhân nhà thầu không thực hiện, giám sát
                            không lưu ý kiểm tra
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box_item">
                    <div class="er-p"><span>Hậu quả:</span></div>
                    <ul class="er-ul">
                        <li>Khả năng liên kết giữa khối xây và tường giảm yếu</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="er-box_2">
        <div class="head">Giải pháp</div>
        <div class="r-body">
            <ul class="er-ul">
                <li>CBGS kiểm tra chặt chiều dài toàn bộ của thanh thép trước khi cắm neo, chiều dài còn lại
                    sau khi đã cắm neo để xác định chiều sâu cắm vào lỗ khoan và chiều dài neo vào tường có
                    đúng theo bản shop không.
                </li>
            </ul>
            <div class="er-gallery">

                <div class="er-images">
                    <?php $solutionImages = is_array($bug->solution_images) ? $bug->solution_images : []?>
                    @foreach($solutionImages as $image)
                        <span><img src="{{image($image)}}" alt="{{$image}}"> </span>
                    @endforeach
                </div>
                <div class="er-doc">
                    <h4>File đính kèm:</h4>
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
        <h3>Góp ý</h3>
        <div class="box_view">
            @foreach($bug->comments as $comment)

                <div class="view_item">
                    <span><img src="{{$comment->user->avatar ?? 'frontend/images/Avt.png'}}" alt=""> </span>
                    <div class="view_text">
                        <p>{{$comment->content}}</p>
                        <div class="er-gallery">
                            <div class="er-images">
                                @if ($comment->images)
                                    @foreach ($comment->images as $image)
                                    <span><img src="frontend/images/image-.jpg" alt=""> </span>
                                    @endforeach
                                @endif
                                
                                
                            </div>
                            <div class="er-doc">
                                <h4>File đính kèm:</h4>
                                <ul>
                                    <li><a href="" title="" target="_blank"><i class="fal fa-file"></i>Giải pháp
                                            cho nhà thầu </a></li>
                                    <li><a href="" title="" target="_blank"><i class="fal fa-file"></i>Giải pháp
                                            cho nhà thầu </a></li>
                                    <li><a href="" title="" target="_blank"><i class="fal fa-file"></i>Giải pháp
                                            cho nhà thầu </a></li>
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
                    <form method="POST" action="<?= route('comment.create')?>" class="form_modal" enctype="multipart/form-data" data-bug-id="{{$bug->id}}">
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
