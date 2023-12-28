@section('style')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
@endsection
@extends('layouts.trangchu')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('public/image/truyen/' . $truyen->slug . '/' . $truyen->hinhanh) }}"
                    class="card-img-top border border-white" alt="..." style="width: 250px; height: 300px;">
            </div>
            <div class="col-md-8">
                <h3 class="text-white">{{ $truyen->tentruyen }}</h3>
                <h5 class="mt-4 ">{{ $truyen->TacGia->tentacgia }}</h5>
                <div class="fs-3 my-5">{!! $truyen->mota !!}</div>
                <h4 class="mb-4">Thể loại: {{ $truyen->getTheLoai[0]->tentheloai }}</h4>
                <h4 class="mb-4">Nhóm dịch: {{ $truyen->nhomdich }}</h4>
                <h4>{{ $truyen->updated_at }}</h4>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="border-bottom border-secondary">
            <h3 class="text-white">CHƯƠNG</h3>
        </div>
        <div class="row">
            <div class="col-md-7 me-5">
                <div class="row">
                    @foreach ($truyenchitiet as $item)
                        <div class="col-md-6 border-top border-secondary mt-5">
                            <a href="{{ route('truyenchitiet', ['id' => $truyen->id, 'chuong' => $loop->iteration]) }}"
                                class="text-decoration-none fs-3 text-white fw-bold">Chương {{ $loop->iteration }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 border border-secondary rounded-2 ms-auto me-2 mt-4">
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
                                <h4 class="text-white mt-3">Tác giả: {{ $item->TacGia->tentacgia }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
