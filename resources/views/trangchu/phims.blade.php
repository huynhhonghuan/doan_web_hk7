@extends('layouts.trangchu')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        {{-- <div class="col-xs-12 carausel-sliderWidget">
       <section id="halim-advanced-widget-4">
          <div class="section-heading">
             <a href="danhmuc.php" title="Phim Chiếu Rạp">
             <span class="h-text">Phim Chiếu Rạp</span>
             </a>
             <ul class="heading-nav pull-right hidden-xs">
                <li class="section-btn halim_ajax_get_post" data-catid="4" data-showpost="12" data-widgetid="halim-advanced-widget-4" data-layout="6col"><span data-text="Chiếu Rạp"></span></li>
             </ul>
          </div>
          <div id="halim-advanced-widget-4-ajax-box" class="halim_box">
             <article class="col-md-2 col-sm-4 col-xs-6 thumb grid-item post-38424">
                <div class="halim-item">
                   <a class="halim-thumb" href="{{route('movie')}}" title="GÓA PHỤ ĐEN">
                      <figure><img class="lazy img-responsive" src="https://lumiere-a.akamaihd.net/v1/images/p_blackwidow_disneyplus_21043-1_63f71aa0.jpeg" alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN"></figure>
                      <span class="status">HD</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span>
                      <div class="icon_overlay"></div>
                      <div class="halim-post-title-box">
                         <div class="halim-post-title ">
                            <p class="entry-title">GÓA PHỤ ĐEN</p>
                            <p class="original_title">Black Widow</p>
                         </div>
                      </div>
                   </a>
                </div>
             </article>


          </div>
       </section>
       <div class="clearfix"></div>
    </div> --}}
        <div id="halim_related_movies-2xx" class="wrap-slider">
            <div class="section-bar clearfix">
                <h3 class="section-title"><span>PHIM HOT</span></h3>
            </div>
            <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                @foreach ($movie_hot as $key => $hot)
                    <article class="thumb grid-item post-38498">
                        <div class="halim-item">
                            <a class="halim-thumb" href="{{ route('movie', $hot->slug) }}" title="{{ $hot->ten }}">
                                <figure><img class="lazy img-responsive"
                                        src="{{ asset('public/image/phim') }}/{{ $hot->hinhanh }}" alt="Đại Thánh Vô Song"
                                        title="Đại Thánh Vô Song"></figure>
                                <span class="status">
                                    @if ($hot->chatluong == 0)
                                        SD
                                    @elseif($hot->chatluong == 1)
                                        HD
                                    @elseif($hot->chatluong == 2)
                                        Trailer
                                    @endif
                                </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                    @if ($hot->sotap == 0)
                                        {{ $hot->tapphim_count }}/?? tập
                                    @elseif($hot->sotap == $hot->tapphim_count)
                                        Full-{{ $hot->tapphim_count }}/{{ $hot->sotap }} tập
                                    @else
                                        {{ $hot->tapphim_count }}/{{ $hot->sotap }} tập
                                    @endif
                                    |
                                    @if ($hot->phude == 0)
                                        Thuyết minh
                                    @else
                                        Phụ đề
                                    @endif
                                </span>
                                <div class="icon_overlay"></div>
                                <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                        <p class="entry-title">{{ $hot->ten }}</p>
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
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            @foreach ($category_home as $key => $cate_home)
                <section id="halim-advanced-widget-2">
                    <div class="section-heading">
                        <a href="{{ route('category', $cate_home->slug) }}" title="{{ $cate_home->ten }}">
                            <span class="h-text">{{ $cate_home->ten }}</span>
                        </a>
                    </div>
                    <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                        @foreach ($cate_home->phim->take(12) as $key => $mov)
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
                </section>
                <div class="clearfix"></div>
            @endforeach
        </main>
        @include('layouts.trangchu.sidebar')
    </div>
@endsection
