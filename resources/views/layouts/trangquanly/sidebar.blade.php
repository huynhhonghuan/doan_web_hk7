<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/admin" class="brand-link">
        <img src="{{ asset('public/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">KeyD</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('public/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Bạn muốn tìm gì?"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- Menu admin --}}
                @if (Auth::user()->getVaiTro->first()->id == 'admin')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-bars"></i>
                            <p>
                                Quản Lý Phim
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.danhmuc.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách Danh Mục</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-copy"></i>
                            <p> Quản Lý Truyện
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.truyen.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách Truyện</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.truyenchitiet.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Chi Tiết Truyện</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-copy"></i>
                            <p> Quản Lý Thư Viện
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.quocgia.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quốc Gia</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.theloai.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thể Loại</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.tacgia.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tác Giả</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-copy"></i>
                            <p> Quản Lý Tài Khoản
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.taikhoan.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách Tài Khoản</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.vaitro.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Vai Trò</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Menu dành cho cộng tác viên truyện --}}
                @elseif (Auth::user()->getVaiTro->first()->id == 'ctvt')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-bars"></i>
                            <p>
                                Quản Lý Truyện
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('congtacvientruyen.truyen.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách Truyện</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('congtacvientruyen.truyenchitiet.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Chi Tiết Truyện</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Menu dành cho cộng tác viên phim --}}
                @elseif (Auth::user()->getVaiTro->first()->id == 'ctvp')
                @endif
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-film"></i>
                        <p> Phim
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="
                            @if (Auth::user()->User_Role->first()->id == 'admin') {{ route('admin.movie.add') }}
                            @else
                            {{ route('collaborators.movie.add') }}
                            @endif"
                                class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Phim</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="@if (Auth::user()->User_Role->first()->id == 'admin') {{ route('admin.movie.list') }}
                                @else
                                {{ route('collaborators.movie.list') }}
                                @endif" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Phim</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-file-video"></i>
                        <p> Tập Phim
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="@if (Auth::user()->User_Role->first()->id == 'admin') {{ route('admin.movie.list') }}
                                @else
                                {{ route('collaborators.movie.list') }}
                                @endif" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Tập Phim</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="@if (Auth::user()->User_Role->first()->id == 'admin') {{ route('admin.episode.list') }}
                                @else
                                {{ route('collaborators.episode.list') }}
                                @endif" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Tập Phim</p>
                            </a>
                        </li>

                    </ul>
                </li> --}}
            </ul>
        </nav>
    </div>
</aside>
