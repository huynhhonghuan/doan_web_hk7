<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            @if (Auth::user()->getVaiTro->first()->id == 'admin')
                <a href="{{ route('admin.home') }}" class="nav-link">Trang chủ</a>
            @elseif (Auth::user()->getVaiTro->first()->id == 'ctvt')
                <a href="{{ route('congtacvientruyen.home') }}" class="nav-link">Trang chủ</a>
            @elseif (Auth::user()->getVaiTro->first()->id == 'ctvp')
                <a href="{{ route('congtacvienphim.home') }}" class="nav-link">Trang chủ</a>
            @endif
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Liên hệ</a>
        </li> --}}
        @if (Auth::user()->getVaiTro->first()->id == 'admin')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('admin.saoluu')}}" class="nav-link">Sao lưu</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('admin.phuchoi')}}" class="nav-link">Phục hồi</a>
            </li>
        @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        {{-- <li class="nav-item">
<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
  <i class="fas fa-th-large"></i>
</a>
</li> --}}
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
            style="padding-top: 8px;" id="btn_logout">
            Đăng xuất
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</nav>
