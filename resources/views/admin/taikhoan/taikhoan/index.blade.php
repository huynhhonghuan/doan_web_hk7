@extends('layouts.trangquanly')
@section('content')
    <p class="mt-3">
        <a href="{{ route('admin.taikhoan.create') }}" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg"
                width="16" height="16" fill="currentColor" class="bi bi-cloud-plus" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5" />
                <path
                    d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z" />
            </svg> Thêm mới</a>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default"><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-building-add" viewBox="0 0 16 16">
                <path
                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0" />
                <path
                    d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6.5a.5.5 0 0 1-1 0V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5H8v4H3a1 1 0 0 1-1-1z" />
                <path
                    d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
            </svg>
            Nhập từ Excel
        </button>
        <a href="{{ route('admin.taikhoan.xuat') }}" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg"
                width="16" height="16" fill="currentColor" class="bi bi-layout-text-window-reverse"
                viewBox="0 0 16 16">
                <path
                    d="M13 6.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z" />
                <path
                    d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM2 1a1 1 0 0 0-1 1v1h14V2a1 1 0 0 0-1-1zM1 4v10a1 1 0 0 0 1 1h2V4zm4 0v11h9a1 1 0 0 0 1-1V4z" />
            </svg>
            Xuất ra Excel</a>
    </p>
    <table id="tabletruyen" class="table text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Username</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th>Thời gian cập nhật</th>
                <th>Chỉnh sửa</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($danhsach) == false)
                @foreach ($danhsach as $key => $taikhoan)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $taikhoan->name }}</td>
                        <td>{{ $taikhoan->username }}</td>
                        <td>{{ $taikhoan->email }}</td>
                        <td>{{ $taikhoan->sdt }}</td>
                        <td>{{ $taikhoan->getVaiTro[0]->tenvaitro }}</td>
                        @if ($taikhoan->status == 'active')
                            <td><a href="{{ route('admin.taikhoan.khoa', ['taikhoan' => $taikhoan]) }}"><span
                                        class="btn btn-success btn-xs">Hoạt động</span></a></td>
                        @else
                            <td><a href="{{ route('admin.taikhoan.khoa', ['taikhoan' => $taikhoan]) }}"><span
                                        class="btn btn-danger btn-xs">Không hoạt động</span></a></td>
                        @endif
                        <td>{{ $taikhoan->updated_at }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.taikhoan.edit', [$taikhoan]) }}"><i
                                    class="fas fa-edit"></i></a>
                            <a onclick="return confirm('Bạn có muốn khoá tài khoản?')"
                                href="{{ route('admin.taikhoan.xoa', [$taikhoan->id]) }}"> <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Không có quốc gia nào</td>
                </tr>
            @endif
        </tbody>
    </table>

    <form action="{{ route('admin.taikhoan.nhap') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modal-default" style="display: none;" tabindex="-1" role="dialog"
            aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Nhập từ Excel</h5>
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
