<form action="{{ route('loc') }}" method="GET">
    <style>
        .select_filter {
            border: 0;
            background: #12171b;
            color: #fff;
        }

        .btn_filter {
            border: 0 #b2b7bb;
            background: #12171b;
            color: #fff;
            padding: 9px;
        }
    </style>
    <div class="col-md-2" style="width: 20%;">
        <div class="form-group">
            <select name="order" id="" class="form-control select_filter">
                <option value="" style="display: none;">--Sắp xếp--</option>
                <option value="date">Ngày đăng</option>
                <option value="year_release">Năm sản xuất</option>
                <option value="name_a_z">Tên phim</option>
                <option value="views">Lượt xem</option>
            </select>
        </div>
    </div>
    <div class="col-md-2" style="width: 20%;">
        <div class="form-group">
            <select name="genre" id="" class="form-control select_filter">
                <option value="">--Thể loại--</option>
                @foreach ($genre as $key => $gen)
                    <option {{ isset($_GET['genre']) && $_GET['genre'] == $gen->id ? 'selected' : '' }}
                        value="{{ $gen->id }}">{{ $gen->tentheloai }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2" style="width: 20%;">
        <div class="form-group">
            <select name="country" id="" class="form-control select_filter">
                <option value="">--Quốc gia--</option>
                @foreach ($country as $key => $coun)
                    <option {{ isset($_GET['country']) && $_GET['country'] == $coun->id ? 'selected' : '' }}
                        value="{{ $coun->id }}">{{ $coun->tenquocgia }}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{-- <div class="col-md-2" style="width: 20%;">
        <div class="form-group">
            <select name="" id="" class="form-control select_filter">
                <option value="">--Năm phim--</option>
            </select>
        </div>
    </div> --}}
    <div class="col-md-2">
        <input type="submit" value="Lọc Phim" class="btn btn-sm btn-default btn_filter">
    </div>
</form>
