<!DOCTYPE html>
<html lang="en">

<head>
    {{-- nhúng tĩnh header --}}
    @include('layouts.trangquanly.head')
    {{-- nhúng động style từ bên form kế thừa --}}
    @yield('style')
</head>

<body>
    {{-- nhúng tĩnh Navbar --}}
    @include('layouts.trangquanly.navbar')
    {{-- nhúng tĩnh sidebar --}}
    @include('layouts.trangquanly.sidebar')
    {{-- nhúng động Contents từ bên form kế thừa --}}
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <br>
                @include('layouts.trangquanly.alert')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary mt-3">
                            <div class="card-header" style="margin-bottom: 10px;">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- nhúng tĩnh Footer --}}
    @include('layouts.trangquanly.footer')
    {{-- nhúng động script từ bên form kế thừa --}}
    @yield('script')

</body>

</html>
