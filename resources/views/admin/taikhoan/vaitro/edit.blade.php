@extends('layouts.trangquanly')
@section('head')
@endsection
@section('content')
    <form action="{{ route('admin.vaitro.update', [$vaitro]) }}" method="post">
        @csrf
        @method('put')

        <div class="card-body">
            <div class="form-group">
                <label>Tên Quốc Gia</label>
                <input type="text" name="tenvaitro" value="{{ $vaitro->tenvaitro }}" class="form-control"
                    placeholder="Nhập tên quốc gia">
            </div>
            @error('tenvaitro')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Mô Tả</label>
                <textarea name="mota" id="mota" class="form-control">{{ $vaitro->mota }}</textarea>
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="khoa"
                        {{ $vaitro->khoa == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="khoa"
                        {{ $vaitro->khoa == 0 ? 'checked=""' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
            @csrf
    </form>
@endsection

@section('footer')
    <script>
        ClassicEditor.create(document.querySelector('#mota')).catch(erro => {
            console.error(error);
        });
    </script>
@endsection
