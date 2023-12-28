@extends('layouts.trangquanly')
@section('content')
    <p class="mt-3">
        <a href="{{ route('admin.movie.add') }}" class="btn btn-info"><i class="fa fa-plus"></i> Thêm mới</a>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default">
            Nhập từ Excel
        </button>
        <a href="{{ route('admin.danhmuc.xuat') }}" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất
            ra Excel</a>
    </p>
    <table class="table table-responsive" id="tablephim">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Phim</th>
                <th>Danh Mục</th>
                <th style="width: 100px;">Thể Loại</th>
                <th>Quốc Gia</th>
                <th>Định Dạng</th>
                <th>Phụ Đề</th>
                <th>Thời lượng</th>
                {{-- <th scope="col">Mô Tả</th> --}}
                <th scope="col">Tags</th>
                <th>Trạng Thái</th>
                <th>Phim Hot</th>
                <th style="width: 150px;">Số tập</th>
                <th>Năm Phim</th>
                <th>Ảnh Bìa</th>
                {{-- <th>Thời gian cập nhật</th> --}}
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($movieList))
                @foreach ($movieList as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->ten }}</td>
                        <td>{{ $item->DanhMuc->ten }}</td>
                        <td>
                            @foreach ($item->phim_theloai as $gen)
                                <span class="badge badge-dark"> {{ $gen->ten }}</span>
                            @endforeach
                        </td>
                        <td>{{$item->QuocGia->ten}}</td>
                        @if ($item->chatluong == 0)
                            <td><span>SD</span></td>
                        @elseif($item->chatluong == 1)
                            <td><span>HD</span></td>
                        @elseif($item->chatluong == 2)
                            <td><span>Trailer</span></td>
                        @endif
                        @if ($item->phude == 1)
                            <td><span>Phụ đề</span></td>
                        @else
                            <td><span>Thuyết minh</span></td>
                        @endif
                        <td>{{ $item->thoiluong }}</td>
                        {{-- <td>{!! $item->description !!}</td> --}}
                        <td>{!! $item->tags !!}</td>
                        @if ($item->khoa == 1)
                            <td><span class="btn btn-success btn-xs">Hiển thị</span></td>
                        @else
                            <td><span class="btn btn-danger btn-xs">Không hiện thị</span></td>
                        @endif
                        @if ($item->phimhot == 1)
                            <td><span class="btn btn-success btn-xs">Có</span></td>
                        @else
                            <td><span class="btn btn-danger btn-xs">Không</span></td>
                        @endif
                        <td>
                            @if ($item->sotap == 0)
                                {{ $item->tapphim_count }}/?? tập
                            @else
                                {{ $item->tapphim_count }}/{{ $item->sotap }} tập
                            @endif
                            @if ($item->sotap != $item->tapphim_count)
                                <a class="btn btn-info btn-sm"
                                    href="{{ route('admin.episode.add', ['id' => $item->id]) }}"><i
                                        class="fa fa-plus"></i></a>
                            @endif
                        </td>
                        <td>
                            <select name="year" id="{{ $item->id }}" class="select-year">
                                <script>
                                    var today = new Date();
                                    var nam = today.getFullYear();
                                    for (var i = 1990; i <= nam; i++) {
                                        document.write("<option value='" + i + "'>" + i + "</option>");
                                    }
                                </script>
                            </select>
                        </td>
                        <script>
                            for (var j = 0; j < document.getElementById({{ $item->id }}).options.length; j++) {
                                if (document.getElementById({{ $item->id }}).options[j].value == {{ $item->nam }})
                                    document.getElementById({{ $item->id }}).options[j].selected = true;
                            }
                        </script>
                        <td><img src="{{ asset('public/image/phim') }}/{{ $item->hinhanh }}" width="80" height="100"></td>
                        {{-- <td>{{ $item->updated_at }}</td> --}}
                        <td>
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('admin.movie.edit', ['id' => $item->id]) }}"><i class="fas fa-edit"></i></a>
                            <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-danger btn-sm"
                                href="{{ route('admin.movie.delete', ['id' => $item->id]) }}"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Không có phim nào</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
