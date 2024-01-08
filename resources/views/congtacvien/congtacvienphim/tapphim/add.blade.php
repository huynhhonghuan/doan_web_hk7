@extends('layouts.trangquanly')
@section('head')
    <style>
        .preview-upload img {
            width: 110px;
        }
    </style>
@endsection
@section('content')
    <form action="{{ route('congtacvienphim.episode.postadd') }}" method="post" enctype="multipart/form-data">
        <div class="card-body">
            {{-- <div class="form-group">
                <label>Lựa chọn thêm</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="1">Bằng link</option>
                    <option value="2">Upload video</option>
                </select>
            </div> --}}

            <div class="form-group" id="form-ep">
                <div class="form-group">
                    <label>Link Phim</label>
                    <input type="text" name="linkphim" class="form-control" placeholder="...">
                </div>
                @if ($movie->danhmuc_id == 1)
                    <div class="form-group">
                        <label>Tập Phim</label>
                        <select class="form-control" name="episode">
                            <option value="0" style="display: none;">---Chọn tập phim---</option>
                            @if ($movie->sotap)
                                @for ($i = 1; $i <= $movie->sotap; $i++)
                                    <option value="{{ $i }}"
                                        @foreach ($episode as $key => $ep)
                    @if ($ep->tap == $i)
                        style="display: none;"
                    @endif @endforeach>
                                        {{ $i }}
                                    </option>
                                @endfor
                            @else
                                @for ($i = 1; $i <= $movie->tapphim->count() + 1; $i++)
                                    <option value="{{ $i }}"
                                        @foreach ($episode as $key => $ep)
            @if ($ep->tap == $i)
                style="display: none;"
            @endif @endforeach>
                                        {{ $i }}
                                    </option>
                                @endfor
                            @endif
                        </select>
                    </div>
                @endif
                <div class="">
                    <button type="submit" class="btn btn-primary">Thêm Tập Phim</button>
                </div>
            </div>

            {{-- <div class="form-group" id="uploadvideo">
                <div class="form-group">
                    <label for="video">Upload Video</label>
                    <input type="file" class="form-control" id="video" name="video" value="">
                    <img src="" id="image">
                    <div class="preview-upload">
                        <img id='sp_hinh-upload' width="80px" />
                    </div>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-primary">Thêm Tập Phim</button>
                </div>
            </div> --}}
        </div>
        @csrf
    </form>
@endsection

@section('script')
    {{-- <script>
        $(document).ready(function() {
            $("#form-ep").hide();
            $("#uploadvideo").hide();
            $("#category_id").change(function() {
                var selectedValue = $(this).val();
                console.log(selectedValue);
                if (selectedValue === '2') {
                    $("#uploadvideo").show();
                    $("#form-ep").hide();
                } else {
                    $("#form-ep").show();
                    $("#uploadvideo").hide();
                }
            });
        });
    </script> --}}
    {{-- <script>
        ClassicEditor.create(document.querySelector('#description')).catch(erro => {
            console.error(error);
        });
    </script>
    <script>
        // Sử dụng FileReader để đọc dữ liệu tạm trước khi upload lên Server
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#sp_hinh-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Bắt sự kiện, ngay khi thay đổi file thì đọc lại nội dung và hiển thị lại hình ảnh mới trên khung preview-upload
        $("#image").change(function() {
            readURL(this);
        });
    </script> --}}
@endsection
