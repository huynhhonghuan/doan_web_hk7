@section('style')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('owl-carousel/css/owl.theme.default.min.css') }}"> --}}
@endsection
@extends('layouts.trangchu')
@section('content')
    <div id="halim_related_movies-2xx" class="wrap-slider">
        <div class="section-bar clearfix">
            <h3 class="section-title"><span>TRUYỆN HOT</span></h3>
        </div>
        <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
            @foreach ($truyen_head as $key => $hot)
                <article class="thumb grid-item post-38498">
                    <div class="halim-item">
                        <a class="halim-thumb" href="{{ route('truyen_id', $hot->id) }}" title="{{ $hot->tentruyen }}">
                            <figure><img class="lazy img-responsive"
                                    src="{{ asset('public/image/truyen') }}/{{ $hot->slug }}/{{ $hot->hinhanh }}"
                                    alt="Bành Dân" title="Bành Dân"></figure>
                            <div class="icon_overlay"></div>
                            <div class="halim-post-title-box">
                                <div class="halim-post-title ">
                                    <p class="entry-title">{{ $hot->tentruyen }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
        <script>
            jQuery(document).ready(function($) {
                var owl = $('#halim_related_movies-2');
                owl.owlCarousel({
                    loop: true,
                    margin: 5,
                    autoplay: true,
                    autoplayTimeout: 4000,
                    autoplayHoverPause: true,
                    nav: true,
                    navText: ['<i class="hl-down-open rotate-left"></i>',
                        '<i class="hl-down-open rotate-right"></i>'
                    ],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        480: {
                            items: 3
                        },
                        600: {
                            items: 5
                        },
                        1000: {
                            items: 5
                        }
                    }
                })
            });
        </script>
    </div>
    <div class="container overflow-hidden">
        <div class="section-bar clearfix">
            <h3 class="section-title"><span>TRUYỆN MỚI CẬP NHẬT</span></h3>
        </div>
        <div class="row">
            <div class="col-md-7 me-5">
                <div class="row">
                    @foreach ($truyenmoinhat as $item)
                        <div class="col-md-6 my-5 pb-5 border-bottom border-secondary">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('truyen_id', ['id' => $item->id]) }}"
                                        class="text-decoration-none text-white fs-3">
                                        <img src="{{ asset('public/image/truyen/' . $item->slug . '/' . $item->hinhanh) }}"
                                            class="card-img-top" alt="..." style="width: 120px; height: 150px;"> </a>
                                </div>
                                <div class="col-md-8">
                                    <a href="{{ route('truyen_id', ['id' => $item->id]) }}"
                                        class="text-decoration-none text-white fs-3">
                                        {{ $item->tentruyen }}
                                    </a>
                                    <h5 class="text-white mt-3">Tác giả: {{ $item->TacGia->tentacgia }}</h5>
                                    <!-- truyen reviews-->
                                    <div class="d-flex justify-content-start small text-warning my-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <div class="bi-star"></div>
                                    </div>
                                    <h5 class="mb-auto">{{ $item->updated_at }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- <div class="col-md-4 border border-secondary rounded-2 ms-2">
                <div class="section-bar clearfix">
                    <h3 class="section-title"><span>ĐỌC NHIỀU TRONG NGÀY</span></h3>
                </div>
                @foreach ($truyenmoinhat as $item)
                    <div class="col-12 my-5 pb-5 border-bottom border-secondary">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ route('truyen_id', ['id' => $item->id]) }}"
                                    class="text-decoration-none text-white fs-3">
                                    <img src="{{ asset('public/image/truyen/' . $item->slug . '/' . $item->hinhanh) }}"
                                        class="card-img-top" alt="..." style="width: 100px; height: 130px;">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <a href="{{ route('truyen_id', ['id' => $item->id]) }}"
                                    class="text-decoration-none text-white fs-3">
                                    {{ $item->tentruyen }}
                                </a>
                                <h5 class="text-white mt-3">Tác giả: {{ $item->TacGia->tentacgia }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}
            <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
                <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
                    <div class="section-bar clearfix">
                        <div class="section-title">
                            <span>Truyện đọc nhiều</span>
                        </div>
                    </div>
                    <section class="tab-content">
                        <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                            <div class="halim-ajax-popular-post-loading hidden"></div>
                            <div id="halim-ajax-popular-post" class="popular-post">
                                @foreach ($truyenmoinhat as $key => $traler_sidebar)
                                    <div class="item post-37176">
                                        <a href="{{ route('truyen_id', $traler_sidebar->id) }}"
                                            title="{{ $traler_sidebar->tentruyen }}">
                                            <div class="item-link">
                                                <img src="{{ asset('public/image/truyen') }}/{{ $traler_sidebar->slug }}/{{ $traler_sidebar->hinhanh }}"
                                                    class="lazy post-thumb" alt="{{ $traler_sidebar->tentruyen }}"
                                                    title="{{ $traler_sidebar->ten }}" />
                                                {{-- <span class="is_trailer">
                                                    @if ($traler_sidebar->chatluong == 0)
                                                        SD
                                                    @elseif($traler_sidebar->chatluong == 1)
                                                        HD
                                                    @elseif($traler_sidebar->chatluong == 2)
                                                        Trailer
                                                    @endif
                                                </span> --}}
                                            </div>
                                            <p class="title">{{ $traler_sidebar->tentruyen }}</p>
                                        </a>
                                        <div class="viewsCount" style="color: #9d9d9d;">{{ $traler_sidebar->luotxem }} lượt
                                            quan tâm
                                        </div>
                                        {{-- <div class="viewsCount" style="color: #9d9d9d;">{{ $traler_sidebar->nam }}</div>
                                        <div style="float: left;">
                                            <ul class="list-inline rating" title="Average Rating">
                                                @for ($count = 1; $count <= 5; $count++)
                                                    <li title="star_rating"
                                                        style="cursor:pointer; color:#ffcc00; font-size:20px; padding:0;">
                                                        &#9733;
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div> --}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    <div class="clearfix"></div>
                </div>
            </aside>
        </div>
    </div>
    <div class="container my-5">
        <div class="section-bar clearfix">
            <h3 class="section-title"><span>REVIEW MỚI NHẤT</span></h3>
        </div>
        <div class="row mt-5">
            @foreach ($truyenmoinhat as $item)
                <div class="col-md-2">
                    <a href="{{ route('truyen_id', ['id' => $item->id]) }}" class="text-decoration-none text-white fs-3">
                        <img src="{{ asset('public/image/truyen/' . $item->slug . '/' . $item->hinhanh) }}"
                            class="card-img-top" alt="..." style="width: 200px; height: 230px;">
                    </a>
                    <a href="{{ route('truyen_id', ['id' => $item->id]) }}" class="text-decoration-none text-white fs-3">
                        {{ $item->tentruyen }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
@endsection
