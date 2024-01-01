@extends('layouts.trangchu')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a
                                        href="{{ route('category', $movie->danhmuc->slug) }}">{{ $movie->danhmuc->ten }}</a>
                                    »
                                    <span>
                                        @foreach ($genre_id as $gen)
                                            <a href="{{ route('genre', $gen->slug) }}">
                                                {{ $gen->tentheloai }}</a> »
                                        @endforeach
                                        <a
                                            href="{{ route('country', $movie->quocgia->slug) }}">{{ $movie->quocgia->tenquocgia }}</a>
                                        » <span class="breadcrumb_last" aria-current="page">{{ $movie->ten }}</span>
                                    </span></span></span></div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section id="content" class="test">
                <div class="clearfix wrap-content">

                    <div class="halim-movie-wrapper">
                        <div class="title-block">
                            <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                                <div class="halim-pulse-ring"></div>
                            </div>
                            <div class="title-wrapper" style="font-weight: bold;">
                                Bookmark
                            </div>
                        </div>
                        <div class="movie_info col-xs-12">
                            <div class="movie-poster col-md-3">
                                <img class="movie-thumb" src="{{ asset('public/image/phim') }}/{{ $movie->hinhanh }}"
                                    alt="{{ $movie->ten }}">
                                @if ($movie->chatluong != 2)
                                    @if (isset($episode_first->phim))
                                        <div class="bwa-content">
                                            <div class="loader"></div>
                                            {{-- {{ route('watch', ['slug'=>$movie->slug, 'tap-phim'=>$episode_first->episode]) }} --}}
                                            @if ($movie->danhmuc->slug == 'phim-bo')
                                                <a
                                                    href="{{ url('xem-phim/' . $movie->slug . '/tap-' . $episode_first->tap) }}"class="bwac-btn">
                                                @else
                                                    <a
                                                        href="{{ url('xem-phim/' . $movie->slug . '/full') }}"class="bwac-btn">
                                            @endif
                                            <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <a href="#watch_trailer" class="btn btn-primary watch_trailer"
                                        style="display: block;">Xem Trailer</a>
                                @endif
                            </div>
                            <div class="film-poster col-md-9">
                                <h1 class="movie-title title-1"
                                    style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">
                                    {{ $movie->ten }}</h1>
                                {{-- <h2 class="movie-title title-2" style="font-size: 12px;">Black Widow (2021)</h2> --}}
                                <ul class="list-info-group">
                                    <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                                            @if ($movie->chatluong == 0)
                                                SD
                                            @elseif($movie->chatluong == 1)
                                                HD
                                            @elseif($movie->chatluong == 2)
                                                Trailer
                                            @endif
                                        </span>
                                        @if ($movie->chatluong != 2)
                                            <span class="episode">
                                                @if ($movie->phude == 0)
                                                    Thuyết minh
                                                @else
                                                    Phụ đề
                                                @endif
                                            </span>
                                        @endif
                                    </li>
                                    {{-- <li class="list-info-group-item"><span>Điểm IMDb</span> : <span class="imdb">7.2</span></li> --}}
                                    <li class="list-info-group-item"><span>Thời lượng</span> :
                                        {{ $movie->thoiluong ? $movie->thoiluong : 'Chưa cập nhật' }}</li>
                                    <li class="list-info-group-item"><span>Số tập phim</span> :
                                        @if ($movie->chatluong != 2)
                                            @if ($movie->danhmuc->slug == 'phim-bo')
                                                @if ($episode_cur_list_count == 0 && $movie->sotap == 0)
                                                    ??/?? tập - Đang cập nhật
                                                @elseif($movie->sotap == 0)
                                                    {{ $episode_cur_list_count }}/?? tập - Đang cập nhật
                                                @elseif($movie->sotap == $episode_cur_list_count)
                                                    {{ $episode_cur_list_count }}/{{ $movie->sotap }} tập - Hoàn thành
                                                @else
                                                    {{ $episode_cur_list_count }}/{{ $movie->sotap }} tập - Đang cập nhật
                                                @endif
                                            @else
                                                1/1 tập - Hoàn thành
                                            @endif
                                        @else
                                            Đang cập nhật<table></table>
                                        @endif
                                    </li>
                                    <li class="list-info-group-item"><span>Năm phát hành</span> :
                                        {{ $movie->nam ? $movie->nam : 'Chưa cập nhật' }}</li>
                                    <li class="list-info-group-item">
                                        <span>Thể loại</span> :
                                        @foreach ($genre_id as $gen)
                                            {{-- @dd($gen->title) --}}
                                            {{-- @if ($genre_id == $genre_test) --}}
                                            <a href="{{ route('genre', $gen->slug) }}" rel="category tag">
                                                {{ $gen->tentheloai }}</a>
                                            {{-- @endif --}}
                                        @endforeach

                                    </li>
                                    <li class="list-info-group-item"><span>Quốc gia</span> : <a
                                            href="{{ route('country', $movie->quocgia->slug) }}"
                                            rel="tag">{{ $movie->quocgia->tenquocgia }}</a></li>
                                    @if ($movie->chatluong != 2)
                                        <li class="list-info-group-item"><span>Tập phim mới nhất</span> :
                                            @if ($episode)
                                                @if ($movie->danhmuc->slug == 'phim-bo')
                                                    @foreach ($episode as $key => $ep)
                                                        {{-- {{ route('watch', ['slug'=>$ep->movie->slug, 'tap-phim'=>$ep->episode]) }} --}}
                                                        <a href="{{ url('xem-phim/' . $ep->phim->slug . '/tap-' . $ep->tap) }}"
                                                            rel="tag">{{ $ep->tap }}</a>
                                                    @endforeach
                                                @else
                                                    @foreach ($episode as $key => $ep)
                                                        <a href="{{ url('xem-phim/' . $ep->phim->slug . '/full') }}"
                                                            rel="tag">Full</a>
                                                    @endforeach
                                                @endif
                                            @endif
                                    @endif
                                    </li>
                                    <li class="list-info-group-item"><span>Lượt quan tâm</span> :
                                        {{ $movie->view }} lượt</li>
                                    <li class="list-info-group-item" style="height: 60px;">
                                        <span class="total_rating">Đánh Giá : {{ $count_rating }} lượt</span>
                                        <ul class="list-inline rating alo" title="Average Rating"
                                            style="margin-right: 60%;">
                                            @for ($count = 5; $count >= 1; $count--)
                                                @php
                                                    if ($count <= $rating) {
                                                        $color = 'color:#ffcc00;';
                                                    } else {
                                                        $color = 'color:#ccc;';
                                                    }
                                                @endphp
                                                <li title="star_rating" id="{{ $movie->id }}-{{ $count }}"
                                                    data-index="{{ $count }}" data-movie_id="{{ $movie->id }}"
                                                    data-rating="{{ $rating }}" class="rating"
                                                    style="cursor:pointer; {{ $color }} font-size:25px; padding-bottom: 20px;">
                                                    &#9733;
                                                </li>
                                            @endfor

                                        </ul>
                                    </li>
                                    {{-- <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director" rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland" title="Cate Shortland">Cate Shortland</a></li>
                         <li class="list-info-group-item last-item" style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;"><span>Diễn viên</span> : <a href="" rel="nofollow" title="C.C. Smiff">C.C. Smiff</a>, <a href="" rel="nofollow" title="David Harbour">David Harbour</a>, <a href="" rel="nofollow" title="Erin Jameson">Erin Jameson</a>, <a href="" rel="nofollow" title="Ever Anderson">Ever Anderson</a>, <a href="" rel="nofollow" title="Florence Pugh">Florence Pugh</a>, <a href="" rel="nofollow" title="Lewis Young">Lewis Young</a>, <a href="" rel="nofollow" title="Liani Samuel">Liani Samuel</a>, <a href="" rel="nofollow" title="Michelle Lee">Michelle Lee</a>, <a href="" rel="nofollow" title="Nanna Blondell">Nanna Blondell</a>, <a href="" rel="nofollow" title="O-T Fagbenle">O-T Fagbenle</a></li> --}}
                                </ul>
                                <div class="movie-trailer hidden"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="halim_trailer"></div>
                    <div class="clearfix"></div>
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                {!! $movie->mota !!}
                            </article>
                        </div>
                    </div>
                    <!-- Tags phim-->
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Tags phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                @if ($movie->tags != null)
                                    @php
                                        $tags = [];
                                        $tags = explode(', ', $movie->tags);
                                    @endphp
                                    @foreach ($tags as $key => $tag)
                                        <a href="{{ route('tag', $tag) }}">{{ $tag }}</a>
                                    @endforeach
                                @else
                                    {{ $movie->tags }}
                                @endif
                            </article>
                        </div>
                    </div>
                    <!-- Trailer phim-->
                    @if ($movie->trailer != null)
                        <div class="section-bar clearfix">
                            <h2 class="section-title"><span style="color:#ffed4d">Trailer phim</span></h2>
                        </div>
                        <div class="entry-content htmlwrap clearfix">
                            <div class="video-item halim-entry-box">
                                <article id="watch_trailer" class="item-content">
                                    <iframe width="100%" height="350"
                                        src="https://www.youtube.com/embed/{{ $movie->trailer }}?si=V7ou-1LV4GIj4soV"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>
                                </article>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
            <section class="related-movies">
                <div id="halim_related_movies-2xx" class="wrap-slider">
                    @if ($movie_related->count() != 0)
                        <div class="section-bar clearfix">
                            <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                        </div>
                        <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                            @foreach ($movie_related as $key => $hot)
                                <article class="thumb grid-item post-38498">
                                    <div class="halim-item">
                                        <a class="halim-thumb" href="{{ route('movie', $hot->slug) }}"
                                            title="{{ $hot->title }}">
                                            <figure><img class="lazy img-responsive"
                                                    src="{{ asset('public/image/phim') }}/{{ $hot->hinhanh }}"
                                                    alt="Đại Thánh Vô Song" title="Đại Thánh Vô Song"></figure>
                                            <span class="status">
                                                @if ($hot->chatluong == 0)
                                                    HD
                                                @else
                                                    SD
                                                @endif
                                            </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
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
                    @endif
                    <script>
                        jQuery(document).ready(function($) {
                            var owl = $('#halim_related_movies-2');
                            owl.owlCarousel({
                                loop: true,
                                margin: 4,
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
                                        items: 4
                                    },
                                    1000: {
                                        items: 4
                                    }
                                }
                            })
                        });
                    </script>

                </div>
            </section>
            <!-- Comment fb-->
            <div class="section-bar clearfix">
                <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
                <div class="video-item halim-entry-box">
                    <article id="watch_trailer" class="item-content">
                        @php
                            $current_url = Request::url();
                        @endphp
                        <div style="background-color: #eee;">
                            <div class="fb-comments" data-href="{{ $current_url }}" data-width="100%"
                                data-numposts="10"></div>
                        </div>
                    </article>
                </div>
            </div>
        </main>
        @include('layouts.trangchu.sidebar')
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function remove_background(movie_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + movie_id + '-' + count).css('color', '#ccc');
            }
        }

        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data("index");
            var movie_id = $(this).data("movie_id");
            remove_background(movie_id);
            for (var count = 1; count <= index; count++) {
                $('#' + movie_id + '-' + count).css('color', '#ffcc00');
            }
        });

        $(document).on("mouseleave", '.rating', function() {
            var movie_id = $(this).data("movie_id");
            var rating = $(this).data("rating");
            remove_background(movie_id);
            for (var count = 1; count <= rating; count++) {
                $('#' + movie_id + '-' + count).css('color', '#ffcc00');
            }
        });

        $(document).on("click", '.rating', function() {
            var index = $(this).data("index");
            var movie_id = $(this).data("movie_id");

            $.ajax({
                url: "{{ route('them-danhgia') }}",
                method: "POST",
                data: {
                    index: index,
                    phim_id: movie_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data); // In thông tin từ server vào console
                    if (data === 'done') {
                        alert("Bạn đã đánh giá " + index + " trên 5");
                        location.reload();
                    } else if (data === 'exist') {
                        alert("Bạn đã đánh giá phim này rồi, cảm ơn bạn nhé");
                    } else {
                        alert("Lỗi");
                    }
                },
            });
        });
    </script>
@endsection
