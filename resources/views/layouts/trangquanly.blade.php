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
    @yield('content')
    {{-- nhúng tĩnh Footer --}}
    @include('layouts.trangquanly.footer')
    {{-- nhúng động script từ bên form kế thừa --}}
    @yield('script')

</body>

</html>
