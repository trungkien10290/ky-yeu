<div class="view_item">
    <span><img src="{{$comment->user->avatar ?? 'frontend/images/Avt.png'}}" alt=""> </span>
    <div class="view_text">
        <p>{{$comment['content']}}</p>
        <div class="er-gallery">
            <div class="er-images">
                @if (isset($comment['images']))
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