<!DOCTYPE html>
<html lang="en">

<head>
    {{-- nhúng tĩnh header --}}
    @include('layouts.trangchu.head')
    {{-- nhúng động style từ bên form kế thừa --}}
    @yield('style')
</head>

<body>
    {{-- nhúng tĩnh Navbar --}}
    @include('layouts.trangchu.navbar')
    {{-- nhúng động Contents từ bên form kế thừa --}}
    <div class="container">
        @yield('content')
    </div>
    {{-- nhúng tĩnh Footer --}}
    @include('layouts.trangchu.footer')
    {{-- nhúng động script từ bên form kế thừa --}}
    @yield('script')

</body>

</html>
