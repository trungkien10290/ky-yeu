<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">
    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-8">

        @include('admin::form.error')
        <table class="table">
            <thead>
            <tr>
                <td>Id</td>
                <td>Tên dự án</td>
                <td>Quyền</td>
                <td>Thêm</td>
                <td>Sửa</td>
                <td>Xóa</td>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{$project->id}}</td>
                    <td>{{$project->trans('title')}}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
</div>
