<?php
$data = old($column, $value);
$data = is_array($data) ? $data : [];
?>
<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-8">

        @include('admin::form.error')
        <div class="input-group file-caption-main {{$btn_class}}"
             data-input="{{$id}}"
             data-is_multiple=true
             data-type="{{$type}}"
             data-preview="preview_{{$id}}"
        >
            <input readonly class="form-control" id="{{$id}}" name="{{$name}}"
                   {!! $attributes !!} placeholder="{{$placeholder}}">
            <div class="input-group-btn input-group-append">
                <div tabindex="500" class="btn btn-primary btn-file"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;
                    <span>Chọn</span></div>
            </div>
        </div>
        <div id="preview_{{$id}}" class="preview_multiple_file">
            <?php if (!empty($data)) foreach ($data as $key => $item): ?>
            @include('admin.form.multiple.item',['item'=>$item,'name' => $name.'[]'])
            <?php endforeach; ?>
        </div>

        @include('admin::form.help-block')

    </div>
</div>
