@extends('layouts.trangquanly')
@section('content')
    <p class="pt-3">
        <a href="{{ route('admin.vaitro.create') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default">
            Nhập từ Excel
        </button>
        <a href="{{ route('admin.vaitro.xuat') }}" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất
            ra Excel</a>
    </p>
    <table id="tabletruyen" class="table text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên Vai Trò</th>
                <th>Mô Tả</th>
                <th>Ghi chú</th>
                <th>Thời gian cập nhật</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($danhsach) == false)
                @foreach ($danhsach as $key => $vaitro)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $vaitro->id }}</td>
                        <td>{{ $vaitro->tenvaitro }}</td>
                        <td>{{ $vaitro->mota }}</td>
                        <td>{{ $vaitro->ghichu }}</td>
                        <td>{{ $vaitro->updated_at }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.vaitro.edit', [$vaitro]) }}"><i
                                    class="fas fa-edit"></i></a>
                            <form onclick="return confirm('Bạn có muốn xóa không?');" class="d-inline-block"
                                action="{{ route('admin.vaitro.destroy', [$vaitro]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Không có vai trò nào</td>
                </tr>
            @endif
        </tbody>
    </table>

    <form action="{{ route('admin.vaitro.nhap') }}" method="post" enctype="multipart/form-data">
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
