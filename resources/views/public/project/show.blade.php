@extends('public.layout.app')
@section('content')

    <section class="banner relative">
        @include('public._block.banner_social')
        <div class="banner-i relative">
            <img src="{{image($project->thumbnail)}}" alt="{{$project->thumbnail}}">
            <div class="banner-page">
                <div class="container">
                    <h1 class="text-right">{{__('public.project introduction')}}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="pj-intro">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="pj-content">
                        <h1>{{$project->trans('title')}}</h1>
                        <div class="flex-center-between mgb-30">
                            <div class="date"><i class="fal fa-calendar"></i> {{$project->created_at->format('d.m.Y')}}
                            </div>
                            <div class="share flex-center-end">
                                <span>{{__('public.share this post')}}</span>
                                <a target="_blank" href="https://www.instagram.com/?url={{url()->current()}}" title="Instagram" class="fab fa-instagram"></a>
                                <a target="_blank"
                                   href="http://twitter.com/share?text={{$project->trans('title')}}&amp;url={{url()->current()}}"
                                   title="Twitter" class="fab fa-twitter"></a>
                                <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{url()->current()}}" title="Linkedin" class="fab fa-linkedin-in"></a>
                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" title="Facebook" class="fab fa-facebook-f"></a>
                            </div>
                        </div>
                        <div class="pj-article">
                            {!! $project->trans('content') !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sticky-top">
                        <div class="pj-related">
                            <h3>{{__('public.other projects')}}</h3>
                            @if(!empty($otherProjects) && $otherProjects->count() > 0)
                                @foreach($otherProjects as $otherProject)
                                    <div class="related-item">
                                        <a href="{{$otherProject->slugLink}}" title="{{$otherProject->trans('title')}}"
                                           class="zoom">
                                            <img src="{{image($otherProject->thumbnail)}}"
                                                 alt="$otherProject->thumbnail)">
                                        </a>
                                        <h4><a href="{{$otherProject->slugLink}}"
                                               title="{{$otherProject->trans('title')}}">{{$otherProject->trans('title')}}</a>
                                        </h4>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
