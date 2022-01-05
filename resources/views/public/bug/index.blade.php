@extends('public.layout.app')
@section('content')
    <section class="banner relative">
        @include('public._block.banner_social')
        <div class="banner-i relative">
            <img src="frontend/images/banner-page.jpg" alt="">
            <div class="banner-page">
                <div class="container">
                    <h1 class="text-right">{{__('public.bug list')}}</h1>
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
                                <option value="">{{__('public.all')}}</option>
                                @foreach($projects as $project)

                                    <option value="{{$project->id}}"
                                            @if(request('project_id') == $project->id) selected @endif
                                    >{{$project->trans('title')}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="category_id">
                                <option value="">{{__('public.all')}}</option>
                                @foreach($bugCategories as $category)
                                    <option value="{{$category->id}}"
                                            @if(request('category_id') == $category->id) selected @endif
                                    >{{$category->trans('title')}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-2">
                            <input name="dates" class="date-range-picker" autocomplete="off" type="text" readonly
                                   placeholder="{{__('public.choose date')}}" value="{{request('dates')}}">
                        </div>
                        <div class="col-md-4">
                            <div class="flex-center frm-flex">
                                <input name="search" value="{{request('search')}}" type="text"
                                       placeholder="{{__('public.search')}}">
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
                            <th>{{__('public.error code')}}</th>
                            <th>{{__('public.desc bug')}}</th>
                            <th>{{__('public.reason')}}</th>
                            <th>{{__('public.consequence')}}</th>
                            <th>{{__('public.solution')}}</th>
                            <th>{{__('public.document')}}</th>
                            <th>{{__('public.action')}}</th>

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
                                            <i class="fal fa-image"></i> {{count($bugImages)}}
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
                                        <p> {{$bug->trans('solution')}}</p>
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
                                            <i class="fal fa-image"></i> {{count($solutionImages)}}
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
                                        <button class="cmt-bn"
                                                onclick="errorModal('{{$bug->id}}')">{{__('public.feedback more')}}</button>
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
    </script>
@endpush
