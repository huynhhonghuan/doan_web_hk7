@section('style')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
@endsection
@extends('layouts.trangchu')
@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('public/image/truyen/' . $truyen->slug . '/' . $truyen->hinhanh) }}"
                    class="card-img-top border border-white" alt="..." style="width: 250px; height: 300px;">
            </div>
            <div class="col-md-8">
                <h3 class="text-white">{{ $truyen->tentruyen }}</h3>
                <h5 class="mt-4 ">{{ $truyen->TacGia->tentacgia }}</h5>
                <div class="fs-3 my-5">{!! $truyen->mota !!}</div>
                <h5 class="mb-4">Thể loại: {{ $truyen->getTheLoai[0]->tentheloai }}</h5>
                <h5 class="mb-4">Nhóm dịch: {{ $truyen->nhomdich }}</h5>
                <h6>{{ $truyen->updated_at }}</h6>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="row">
            <div class="col-md-7 me-5">
                <div class="section-bar clearfix">
                    <h3 class="section-title"><span>CHƯƠNG</span></h3>
                </div>
                <div class="row">
                    @foreach ($truyenchitiet as $item)
                        <div class="col-md-6 border-top border-secondary mt-5">
                            <a href="{{ route('truyenchitiet', ['slug' => $truyen->slug, 'chuong' => $loop->iteration]) }}"
                                class="text-decoration-none fs-3 text-white fw-bold"
                                style="font-weight: bold; color:cornsilk;">Chương {{ $loop->iteration }}</a>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 border border-secondary rounded-2 ms-auto me-2 mt-4">
                <div class="section-bar clearfix">
                    <h3 class="section-title"><span>ĐỌC NHIỀU</span></h3>
                </div>
                @foreach ($truyenmoinhat as $item)
                    <div class="col-12 my-5 pb-5 border-bottom border-secondary">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ route('truyen_id', ['id' => $item->id]) }}"
                                    class="text-decoration-none text-white fs-3">
                                    <img src="{{ asset('public/image/truyen/' . $item->slug . '/' . $item->hinhanh) }}"
                                        class="card-img-top" alt="..." style="width: 100px; height: 130px;"> </a>
                            </div>
                            <div class="col-md-8">
                                <a href="{{ route('truyen_id', ['id' => $item->id]) }}"
                                    class="text-decoration-none text-white fs-3">
                                    {{ $item->tentruyen }}
                                </a>
                                <h5 class="text-white mt-3">Tác giả: {{ $item->TacGia->tentacgia }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
