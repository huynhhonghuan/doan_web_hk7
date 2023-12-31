<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/admin" class="brand-link">
        {{-- <img src="{{ asset('public/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-amd"
            viewBox="0 0 16 16">
            <path
                d="m.334 0 4.358 4.359h7.15v7.15l4.358 4.358V0H.334ZM.2 9.72l4.487-4.488v6.281h6.28L6.48 16H.2V9.72Z" />
        </svg>
        @if (Auth::user()->getVaiTro->first()->id == 'admin')
            <span class="brand-text font-weight-light">ADMIN</span>
        @elseif(Auth::user()->getVaiTro->first()->id == 'ctvt')
            <span class="brand-text font-weight-light">CỘNG TÁC VIÊN TRUYỆN</span>
        @elseif(Auth::user()->getVaiTro->first()->id == 'ctvp')
            <span class="brand-text font-weight-light">CỘNG TÁC VIÊN PHIM</span>
        @endif
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image justify-content-center">
                <img src="{{ asset('public/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
                <a href="#" class="d-block mt-3">{{ Auth::user()->name }}</a>
            </div>
            <div class="info">
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
                                <a href="{{ route('admin.movie.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách Phim</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.episode.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách Tập Phim</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-bars"></i>
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
                            <i class="nav-icon fas fa-bars"></i>
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
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.danhmuc.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Mục</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-bars"></i>
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
                                <a href="{{ route('congtacvienphim.movie.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách Phim</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('congtacvienphim.episode.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách Tập Phim</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
