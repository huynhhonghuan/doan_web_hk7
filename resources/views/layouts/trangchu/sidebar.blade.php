<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim Hot</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                    @foreach ($movie_hot as $key => $hot)
                        <div class="item post-37176">
                            <a href="{{ route('movie', $hot->slug) }}" title="{{ $hot->ten }}">
                                <div class="item-link">
                                    <img src="{{ asset('public/image/phim') }}/{{ $hot->hinhanh }}"
                                        class="lazy post-thumb" alt="{{ $hot->ten }}" title="{{ $hot->ten }}" />
                                    <span class="is_trailer">
                                        @if ($hot->chatluong == 0)
                                            SD
                                        @elseif($hot->chatluong == 1)
                                            HD
                                        @elseif($hot->chatluong == 2)
                                            Trailer
                                        @endif
                                    </span>
                                </div>
                                <p class="title">{{ $hot->ten }}</p>


                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">{{ $hot->view }} lượt quan tâm</div>
                            <div class="viewsCount" style="color: #9d9d9d;">{{ $hot->nam }}</div>
                            <div style="float: left;">
                                <ul class="list-inline rating" title="Average Rating">
                                    {{-- @dd($rating_sidebar) --}}
                                    @for ($count = 1; $count <= 5; $count++)
                                        <li title="star_rating" id="{{ $count }}"
                                            style="cursor:pointer;
                                            @php
                                                $rating_sidebar = $hot->danhgiaphim;
                                                $rating_sidebar = $rating_sidebar->avg('danhgia');
                                                $rating_sidebar = round($rating_sidebar); @endphp
                                    @if ($count <= $rating_sidebar) color:#ffcc00
                                            @else
                                            color:#ccc @endif;
                                            font-size:20px; padding:0;">
                                            &#9733;
                                        </li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>

<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim sắp chiếu</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                    @foreach ($movie_trailersidebar as $key => $traler_sidebar)
                        <div class="item post-37176">
                            <a href="{{ route('movie', $traler_sidebar->slug) }}" title="{{ $traler_sidebar->ten }}">
                                <div class="item-link">
                                    <img src="{{ asset('public/image/phim') }}/{{ $traler_sidebar->hinhanh }}"
                                        class="lazy post-thumb" alt="{{ $traler_sidebar->ten }}"
                                        title="{{ $traler_sidebar->ten }}" />
                                    <span class="is_trailer">
                                        @if ($traler_sidebar->chatluong == 0)
                                            SD
                                        @elseif($traler_sidebar->chatluong == 1)
                                            HD
                                        @elseif($traler_sidebar->chatluong == 2)
                                            Trailer
                                        @endif
                                    </span>
                                </div>
                                <p class="title">{{ $traler_sidebar->ten }}</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">{{ $traler_sidebar->view }} lượt quan tâm
                            </div>
                            <div class="viewsCount" style="color: #9d9d9d;">{{ $traler_sidebar->nam }}</div>
                            <div style="float: left;">
                                <ul class="list-inline rating" title="Average Rating">
                                    @for ($count = 1; $count <= 5; $count++)
                                        <li title="star_rating"
                                            style="cursor:pointer; color:#ffcc00; font-size:20px; padding:0;">
                                            &#9733;
                                        </li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>
