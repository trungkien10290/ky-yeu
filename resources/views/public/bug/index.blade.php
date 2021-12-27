@extends('public.layout.app')
@section('content')
    <section class="banner relative">
        <div class="banner-social">
            <div class="social">
                <a href="" title="" class="fab fa-instagram"></a>
                <a href="" title="" class="fab fa-twitter"></a>
                <a href="" title="" class="fab fa-linkedin-in"></a>
                <a href="" title="" class="fab fa-facebook-f"></a>
            </div>
        </div>
        <div class="banner-i relative">
            <img src="frontend/images/banner-page.jpg" alt="">
            <div class="banner-page">
                <div class="container">
                    <h1 class="text-right">danh sách lỗi</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="list-error">
        <div class="container">
            <div class="error-find">
                <form id="form-search-bug" action="{{route('bug.index')}}">
                    <div class="row">
                        <div class="col-md-3">
                            <select name="project_id">
                                <option value="">Tất cả</option>
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}"
                                            @if(request('project') == $project->id) selected @endif
                                    >{{$project->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="category_id">
                                <option value="">Tất cả</option>
                                @foreach($bugCategories as $category)
                                    <option value="{{$category->id}}"
                                            @if(request('category_id') == $category->id) selected @endif
                                    >{{$category->title}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-2">
                            <select>
                                <option>Tháng này</option>
                                <option>Tháng này</option>
                                <option>Tháng này</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="flex-center frm-flex">
                                <input name="search" value="{{request('search')}}" type="text" placeholder="Tìm kiếm">
                                <button type="submit"><i class="fal fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="error-table">
                <div class="er-tbl table-responsive">
                    <table class="w-100">
                        <thead>
                        <tr>
                            <th>Mã lỗi</th>
                            <th>Mô tả lỗi</th>
                            <th>TÀI LIỆU</th>
                            <th>Nguyên nhân</th>
                            <th>Hậu quả</th>
                            <th>Giải pháp</th>
                            <th>TÀI LIỆU</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listBugs as $bug)
                            <tr>
                                <td><span class="number">{{$bug->id}}</span></td>
                                <td>
                                    <div class="desc">
                                        <p>{{$bug->trans('desc')}}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="tl">
                                        <?php $bugImages = is_array($bug->bug_images) ? $bug->bug_images : []; ?>
                                        <a href="{{image($bugImages[0] ?? '')}}" title="{{$bug->trans('title')}}"
                                           class="zoom"
                                           data-fancybox="images_{{$bug->id}}"><img
                                                src="{{image($bugImages[0] ?? '')}}" alt="Bug image"></a>
                                        <span>
                                            <i class="fal fa-file"></i> {{$bug->bugFilesCount}}
                                        </span>
                                    </div>
                                    <div class="gl-hidden">
                                        @foreach($bugImages as $image)
                                            <a href="{{image($image)}}" data-fancybox="images_{{$bug->id}}"></a>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="desc">
                                        <p>{{$bug->trans('reason')}}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="desc">
                                        <p>  {{$bug->trans('consequence')}}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="desc">
                                        <p> {{$bug->trans('solutions')}}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="tl">
                                        <?php $solutionImages = is_array($bug->solution_images) ? $bug->solution_images : []; ?>
                                        <a href="{{image($solutionImages[0] ?? '')}}" title="{{$bug->trans('title')}}"
                                           class="zoom"
                                           data-fancybox="images_solution_{{$bug->id}}"><img
                                                src="{{image($solutionImages[0] ?? '')}}" alt="Bug image"></a>
                                        <span>
                                            <i class="fal fa-file"></i> {{$bug->bugFilesCount}}
                                        </span>
                                    </div>
                                    <div class="gl-hidden">
                                        @foreach($solutionImages as $image)
                                            <a href="{{image($image)}}"
                                               data-fancybox="images_solution_{{$bug->id}}"></a>
                                        @endforeach
                                    </div>

                                </td>
                                <td>
                                    <div class="er-cmt">
                                    <span class="cmt-bn inflex-center-center">{{$bug->comments_count}} <i
                                            class="fal fa-comment-alt-lines"></i> </span>
                                        <button class="cmt-bn" onclick="errorModal('{{$bug->id}}')">góp ý thêm
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="table-pagi">
                    <div class="flex-center-between">
                        <div class="number-page">
                            <strong>{{($listBugs->currentPage() - 1) * $listBugs->perPage() + $listBugs->count()}}</strong>
                            <span>of {{$listBugs->total()}}</span>
                        </div>
                        <div class="pagi">
                            {!! $listBugs->links() !!}
                            {{--                            <ul class="flex-center-end">--}}
                            {{--                                <li><a href="" title=""><i class="fal fa-angle-left"></i> </a></li>--}}
                            {{--                                <li class="active"><a href="" title="">1</a></li>--}}
                            {{--                                <li><a href="" title="">2</a></li>--}}
                            {{--                                <li><a href="" title="">...</a></li>--}}
                            {{--                                <li><a href="" title="">4</a></li>--}}
                            {{--                                <li><a href="" title=""><i class="fal fa-angle-right"></i></a></li>--}}
                            {{--                            </ul>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <section class="modal modal-dt fade" id="modalError" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">

        </div>
    </section>
@endsection
@push('js')
    <script>
        function errorModal(bug_id) {
            let url = base_url + `bugs/${bug_id}/modal`
            $.ajax({
                url: url,
                success: function (html) {
                    $('#modalError .modal-dialog').html(html);
                    $('#modalError').modal('show');
                }
            })
        }

        $(function () {

        })
    </script>
@endpush
