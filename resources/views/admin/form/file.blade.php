<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-8">

        @include('admin::form.error')
        <div class="input-group file-caption-main">
            <input class="form-control" id="{{$id}}" name="{{$name}}" {!! $attributes !!} placeholder="{{$placeholder}}"
                   value="{{ old($column, $value) }}">
            <div class="input-group-btn input-group-append lfm-btn"
                 data-input="{{$id}}"
                 data-is_multiple=false
                 data-type="{{$type}}"
                 data-preview="preview_{{$id}}">
                <div tabindex="500" class="btn btn-primary btn-file"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;
                    <span>Chọn</span></div>
            </div>
        </div>
        <div id="preview_{{$id}}">
                @include('admin.form.multiple.item',['item'=> old($column, $value),'name'=>$name])
        </div>

        @include('admin::form.help-block')

    </div>
</div>
