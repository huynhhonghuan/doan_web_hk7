@extends('layouts.trangquanly')
@section('content')
    <div class="py-3 px-5">
        <h3 class="pb-3">Tài khoản</h3>
        <div class="row justify-content-center">
            <div class="col-md-3" style="padding-right: 20px;">
                <div class="row h-100 bg-danger">
                    <div class="col-8 py-4">
                        <div class="text-white px-3" style="font-size: 40px;">
                            <span style="font-weight: bold">{{ $tk_admin }}</span>
                            <br>
                        </div>
                        <span class="px-3" style="font-size: 20px;">Admin</span>
                    </div>
                    <div class="col-4 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-person-gear" viewBox="0 0 16 16">
                            <path
                                d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding-right: 20px;">
                <div class="row h-100 bg-success">
                    <div class="col-8 py-4">
                        <div class="text-white px-3" style="font-size: 40px;">
                            <span style="font-weight: bold">{{ $tk_ctvt }}</span>
                            <br>
                        </div>
                        <span class="px-3" style="font-size: 20px;">Cộng tác viên truyện</span>

                    </div>
                    <div class="col-4 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-person-rolodex" viewBox="0 0 16 16">
                            <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                            <path
                                d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding-right: 20px;">
                <div class="row h-100 bg-warning">
                    <div class="col-8 py-4">
                        <div class="text-white px-3" style="font-size: 40px;">
                            <span style="font-weight: bold">{{ $tk_ctvp }}</span>
                            <br>
                        </div>
                        <span class="px-3 text-white" style="font-size: 20px;">Cộng tác viên phim</span>

                    </div>
                    <div class="col-4 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-person-video3" viewBox="0 0 16 16">
                            <path
                                d="M14 9.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0m-6 5.7c0 .8.8.8.8.8h6.4s.8 0 .8-.8-.8-3.2-4-3.2-4 2.4-4 3.2" />
                            <path
                                d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h5.243c.122-.326.295-.668.526-1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v7.81c.353.23.656.496.91.783.059-.187.09-.386.09-.593V4a2 2 0 0 0-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding-right: 20px;">
                <div class="row h-100 bg-info">
                    <div class="col-8 py-4">
                        <div class="text-white px-3" style="font-size: 40px;">
                            <span style="font-weight: bold">{{ $tk_nd }}</span>
                            <br>
                        </div>
                        <span class="px-3" style="font-size: 20px;">Người dùng</span>

                    </div>
                    <div class="col-4 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                            <path
                                d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5" />
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="py-3 px-5">
        <h3 class="pb-3">Truyện</h3>
        <div class="row justify-content-left">
            <div class="col-md-3" style="padding-right: 20px;">
                <div class="row h-100 bg-danger">
                    <div class="col-8 py-4">
                        <div class="text-white px-3" style="font-size: 40px;">
                            <span style="font-weight: bold">{{ $truyendang }}</span>
                            <br>
                        </div>
                        <span class="px-3" style="font-size: 20px;">Truyện đã đăng</span>

                    </div>
                    <div class="col-4 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-columns-gap" viewBox="0 0 16 16">
                            <path
                                d="M6 1v3H1V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm14 12v3h-5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM6 8v7H1V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm14-6v7h-5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding-right: 20px;">
                <div class="row h-100 bg-success">
                    <div class="col-8 py-4">
                        <div class="text-white px-3" style="font-size: 40px;">
                            <span style="font-weight: bold">{{ $truyenchuaduyet }}</span>
                            <br>
                        </div>
                        <span class="px-3" style="font-size: 20px;">Truyện chờ duyệt</span>

                    </div>
                    <div class="col-4 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-file-earmark-richtext" viewBox="0 0 16 16">
                            <path
                                d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                            <path
                                d="M4.5 12.5A.5.5 0 0 1 5 12h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m0-2A.5.5 0 0 1 5 10h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m1.639-3.708 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V8.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V8s1.54-1.274 1.639-1.208M6.25 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding-right: 20px;">
                <div class="row h-100 bg-warning">
                    <div class="col-8 py-4">
                        <div class="text-white px-3" style="font-size: 40px;">
                            <span style="font-weight: bold">{{ $truyenduyet }}</span>
                            <br>
                        </div>
                        <span class="px-3 text-white" style="font-size: 20px;">Truyện được duyệt</span>

                    </div>
                    <div class="col-4 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-calendar-check" viewBox="0 0 16 16">
                            <path
                                d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                        </svg>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3" style="padding-right: 20px;">
                <div class="row h-100 bg-info">
                    <div class="col-8 py-4">
                        <div class="text-white px-3" style="font-size: 40px;">
                            <span style="font-weight: bold">10</span>
                            <br>
                        </div>
                        <span class="px-3" style="font-size: 20px;">Truyện được duyệt</span>

                    </div>
                    <div class="col-4 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-calendar-check" viewBox="0 0 16 16">
                            <path
                                d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                        </svg>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <hr>
    <div class="py-3 px-5">
        <h3 class="pb-3">Phim</h3>
        <div class="row justify-content-center">
            <div class="col-md-3" style="padding-right: 20px;">
                <div class="row h-100 bg-danger">
                    <div class="col-8 py-4">
                        <div class="text-white px-3" style="font-size: 40px;">
                            <span style="font-weight: bold">150</span>
                            <br>
                        </div>
                        <span class="px-3" style="font-size: 20px;">Truyện đã đăng</span>

                    </div>
                    <div class="col-4 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-columns-gap" viewBox="0 0 16 16">
                            <path
                                d="M6 1v3H1V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm14 12v3h-5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM6 8v7H1V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm14-6v7h-5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding-right: 20px;">
                <div class="row h-100 bg-success">
                    <div class="col-8 py-4">
                        <div class="text-white px-3" style="font-size: 40px;">
                            <span style="font-weight: bold">15</span>
                            <br>
                        </div>
                        <span class="px-3" style="font-size: 20px;">Truyện chờ duyệt</span>

                    </div>
                    <div class="col-4 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-file-earmark-richtext" viewBox="0 0 16 16">
                            <path
                                d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                            <path
                                d="M4.5 12.5A.5.5 0 0 1 5 12h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m0-2A.5.5 0 0 1 5 10h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m1.639-3.708 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V8.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V8s1.54-1.274 1.639-1.208M6.25 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding-right: 20px;">
                <div class="row h-100 bg-warning">
                    <div class="col-8 py-4">
                        <div class="text-white px-3" style="font-size: 40px;">
                            <span style="font-weight: bold">10</span>
                            <br>
                        </div>
                        <span class="px-3 text-white" style="font-size: 20px;">Truyện được duyệt</span>

                    </div>
                    <div class="col-4 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-calendar-check" viewBox="0 0 16 16">
                            <path
                                d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding-right: 20px;">
                <div class="row h-100 bg-info">
                    <div class="col-8 py-4">
                        <div class="text-white px-3" style="font-size: 40px;">
                            <span style="font-weight: bold">10</span>
                            <br>
                        </div>
                        <span class="px-3" style="font-size: 20px;">Truyện được duyệt</span>

                    </div>
                    <div class="col-4 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-calendar-check" viewBox="0 0 16 16">
                            <path
                                d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
