@extends('layouts.trangquanly')
@section('content')
    <p class="mt-3">
        <a href="{{ route('admin.danhmuc.add') }}" class="btn btn-info"><i class="fa fa-plus"></i> Thêm mới</a>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default">
            Nhập từ Excel
        </button>
        <a href="{{ route('admin.danhmuc.xuat') }}" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất
            ra Excel</a>
    </p>
    <table class="table text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Danh Mục</th>
                <th>Tên Danh Mục không dấu</th>
                <th>Mô Tả</th>
                <th>Trạng thái</th>
                <th>Thời gian cập nhật</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($categoryList))
                @foreach ($categoryList as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->ten }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{!! $item->mota !!}</td>
                        @if ($item->khoa == 1)
                            <td><span class="btn btn-success btn-xs">Có</span></td>
                        @else
                            <td><span class="btn btn-danger btn-xs">Không</span></td>
                        @endif
                        {{-- <td>{{ $item->active }}</td>  --}}
                        <td>{{ $item->updated_at }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('admin.danhmuc.edit', ['id' => $item->id]) }}"><i
                                    class="fas fa-edit"></i></a>
                            <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-danger btn-sm"
                                href="{{ route('admin.danhmuc.delete', ['id' => $item->id]) }}"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Không có danh mục nào</td>
                </tr>
            @endif
        </tbody>
    </table>
    <form action="{{ route('admin.danhmuc.nhap') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modal-default" style="display: none;" tabindex="-1" role="dialog"
            aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Nhập từ Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-0">
                            <label for="file_excel" class="form-label">Chọn tập tin Excel</label>
                            <input type="file" class="form-control" id="file_excel" name="file_excel" required />
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-primary">Nhập dữ liệu</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
