<header id="header">
    <div class="container">
        <div class="row" id="headwrap">
            <div class="col-md-3 col-sm-6 slogan">
                <p class="site-title"><a class="logo" href="" title="phim hay ">Phim Hay</p>
                </a>
            </div>
            <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                <div class="header-nav">
                    <div class="col-xs-12">
                        <div class="form-group form-timkiem">
                            <div class="input-group col-xs-12">
                                <form action="{{ route('search') }}" method="GET">
                                <input id="timkiem" type="text" name="search" class="form-control"
                                    placeholder="Tìm kiếm..." autocomplete="off">
                                </form>
                                {{-- <i class="animate-spin hl-spin4 hidden"></i> --}}
                            </div>
                        </div>
                        <ul class="list-group" id="result" style="display: none;"></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 hidden-xs">
                <div id="get-bookmark" class="box-shadow"><i class="hl-bookmark"></i><span> Bookmarks</span><span
                        class="count">0</span></div>
                       @if(Auth::user())
                       <a href="{{ route('logout') }}">Đăng xuất</a>
                       @else
                       <a href="{{ route('login') }}">Đăng nhập</a>
                       @endif
                <div id="bookmark-list" class="hidden bookmark-list-on-pc">
                    <ul style="margin: 0;"></ul>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="navbar-container">
    <div class="container">
        <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse"
                    data-target="#halim" aria-expanded="false">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right expand-search-form"
                    data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                    <span class="hl-search" aria-hidden="true"></span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                    Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                    <span class="count">0</span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">
                    <a href="javascript:;" id="expand-ajax-filter" style="color: #ffed4d;">Lọc <i
                            class="fas fa-filter"></i></a>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="halim">
                <div class="menu-menu_1-container">
                    <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                        <li class="current-menu-item active"><a title="Trang Chủ" href="{{ route('homepage') }}">Trang
                                Chủ</a></li>
                        {{-- @foreach ($category as $key => $item)
                            <li class="mega"><a title="{{ $item->title }}"
                                    href="{{ route('category', $item->slug) }}">{{ $item->title }}</a></li>
                        @endforeach --}}
                        <li class="current-menu-item active"><a title="Trang Chủ" href="{{ route('phim') }}">Phim</a></li>
                        <li class="current-menu-item active"><a title="Trang Chủ" href="{{ route('truyen') }}">Truyện</a></li>
                        <li class="mega dropdown">
                            <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                            <ul role="menu" class=" dropdown-menu">
                                @foreach ($genre as $key => $item)
                                    <li><a title="{{ $item->tentheloai }}"
                                            href="{{ route('genre', $item->slug) }}">{{ $item->tentheloai }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="mega dropdown">
                            <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                            <ul role="menu" class=" dropdown-menu">
                                @foreach ($country as $key => $item)
                                    <li><a title="{{ $item->tenquocgia }}"
                                            href="{{ route('country', $item->slug) }}">{{ $item->tenquocgia }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- <ul class="nav navbar-nav navbar-left" style="background:#000;">
                    <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc phim</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-left" style="background:#000;">
                    <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc truyện</a></li>
                </ul> -->
            </div>
        </nav>
        <div class="collapse navbar-collapse" id="search-form">
            <div id="mobile-search-form" class="halim-search-form"></div>
        </div>
        <div class="collapse navbar-collapse" id="user-info">
            <div id="mobile-user-login"></div>
        </div>
    </div>
</div>
</div>
