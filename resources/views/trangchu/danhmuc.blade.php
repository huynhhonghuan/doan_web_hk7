@extends('layouts.trangchu')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">{{ $cate_slug->ten }}</a> »
                                    <span class="breadcrumb_last" aria-current="page">{{ date('Y') }}</span></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section>
                <div class="section-bar clearfix">
                    <h1 class="section-title"><span>{{ $cate_slug->ten }}</span></h1>
                </div>
                <div class="section-bar clearfix">
                    <div class="row">
                        @include('layouts.trangchu.filter')
                    </div>
                </div>

                <div class="halim_box">
                    @foreach ($movie as $key => $mov)
                        <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                            <div class="halim-item">
                                <a class="halim-thumb" href="{{ route('movie', $mov->slug) }}">
                                    <figure><img class="lazy img-responsive"
                                            src="{{ asset('public/image/phim') }}/{{ $mov->hinhanh }}"
                                            title="{{ $mov->ten }}"></figure>
                                    <span class="status">
                                        @if ($mov->chatluong == 0)
                                            SD
                                        @elseif($mov->chatluong == 1)
                                            HD
                                        @elseif($mov->chatluong == 2)
                                            Trailer
                                        @endif
                                    </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                        @if ($mov->sotap == 0)
                                            {{ $mov->tapphim_count }}/?? tập
                                        @elseif($mov->sotap == $mov->tapphim_count)
                                            Full-{{ $mov->tapphim_count }}/{{ $mov->sotap }} tập
                                        @else
                                            {{ $mov->tapphim_count }}/{{ $mov->sotap }} tập
                                        @endif
                                        |
                                        @if ($mov->phude == 0)
                                            Thuyết minh
                                        @else
                                            Phụ đề
                                        @endif
                                    </span>
                                    <div class="icon_overlay"></div>
                                    <div class="halim-post-title-box">
                                        <div class="halim-post-title ">
                                            <p class="entry-title">{{ $mov->ten }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="clearfix"></div>
                <div class="text-center">
                    {{-- <ul class='page-numbers'>
                        <li><span aria-current="page" class="page-numbers current">1</span></li>
                        <li><a class="page-numbers" href="">2</a></li>
                        <li><a class="page-numbers" href="">3</a></li>
                        <li><span class="page-numbers dots">&hellip;</span></li>
                        <li><a class="page-numbers" href="">55</a></li>
                        <li><a class="next page-numbers" href=""><i class="hl-down-open rotate-right"></i></a></li>
                    </ul> --}}
                    {{-- {!! $movie->links('pagination::bootstrap-4') !!} --}}
                </div>
            </section>
        </main>
        @include('layouts.trangchu.sidebar')
    </div>
@endsection
