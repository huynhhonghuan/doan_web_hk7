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
            <div class="form-group">
                <label>Danh Mục Phim</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="1">Thêm tập phim bằng link</option>
                    <option value="2">Thêm tập phim bằng upload video</option>
                </select>
            </div>
            <div class="form-group" id="form-link">
                <div class="form-group">
                    <label>Link Phim</label>
                    <input type="text" name="linkphim" class="form-control" placeholder="...">
                </div>
            </div>
            <div class="form-group" id="form-video">
                <div class="form-group">
                    <label for="video">Video Phim</label>
                    <input type="file" class="form-control" id="video" name="video" value="{{ old('video') }}">
                    {{-- <img src="" id="image"> --}}

                    <video id="previewVideo" class="video-js vjs-default-skin" controls preload="auto" width="560px"
                        height="315px">
                        <source src="" type="video/mp4">
                        <!-- Các nguồn video khác nếu cần -->
                    </video>
                </div>
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
            {{-- <div class="card-body">
                <div id="upload-container" class="text-center">
                    <button type="button" id="browseFile" class="btn btn-primary">Brows File</button>
                </div>
                <div class="progress mt-3" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                </div>
            </div>
            <div class="card-footer p-4" >
                <video id="videoPreview" controls style="width: 100%; height: auto">
                    <source src=""></video>
            </div> --}}

            {{-- <input type="file" name="video" accept="video/*">
            <button type="button" onclick="uploadAndOptimize()">Upload và Tối Ưu Hóa</button> --}}


            <div class="">
                <button type="submit" class="btn btn-primary" onclick="checkFileSize();">Thêm Tập Phim</button>
            </div>
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
    <script>
        function checkFileSize() {
            var fileInput = document.getElementById('video');
            if (fileInput.files.length > 0) {
                var fileSizeInBytes = fileInput.files[0].size;
                var fileSizeInMB = fileSizeInBytes / (1024 * 1024);

                if (fileSizeInMB > 1) {
                    alert("Dung lượng file không được lớn hơn 1GB.");
                    event.preventDefault();
                } else {
                    document.getElementById('uploadForm').submit();
                }
            }
        }
    </script>
    <script>
        $("#form-video").hide();
        $(document).ready(function() {
            $("#category_id").change(function() {
                var selectedValue = $(this).val();
                console.log(selectedValue);
                if (selectedValue === '1') {
                    $("#form-link").show();
                    $("#form-video").hide();
                } else {
                    $("#form-link").hide();
                    $("#form-video").show();
                }
            });
        });
    </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js"></script>
     <script>
         $('#previewVideo').hide();
         document.getElementById('video').addEventListener('change', function(e) {
             $('#previewVideo').show();
             var fileInput = e.target;
             var previewVideo = document.getElementById('previewVideo');

             if (fileInput.files.length > 0) {
                 var file = fileInput.files[0];

                 // Kiểm tra định dạng file, ví dụ chỉ chấp nhận file video MP4
                 // if (file.type.includes('video/mp4')) {
                 // Tạo URL cho file và đặt làm nguồn của video player
                 var videoURL = URL.createObjectURL(file);
                 previewVideo.src = videoURL;
                 // } else {
                 //     alert('Chỉ hỗ trợ tải lên file video MP4.');
                 // }
             }
         });
     </script>
@endsection
