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
            @php
                $files = is_array($comment->files) ? $comment->files : [];
            @endphp
            @if(!empty($files))
                <div class="er-doc">
                    <h4>{{__('public.attach files')}}:</h4>
                    <ul>
                        @foreach($files as $file)
                            <li><a href="{{$file}}" title="{{$file}}" target="_blank"><i
                                        class="fal fa-file"></i>{{show_file_name($file)}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
