@extends('layouts.trangchu')
@section('content')
    <div class="container">
        <div class="row" style="margin: 20px;">
            <div class="col-md-6" style="margin-top: 20px; font-size: 20px;">
                <select name="chuong" id="chuong" onchange="changeChuong()"
                    style="padding: 5px; font-weight: bold; border-radius: 10px; font-size: 20px;">
                    @foreach ($truyen_chuong as $item)
                        <option value="{{ $loop->iteration }}" @if ($loop->iteration == $truyenchitiet[0]->chuong) selected @endif>
                            Chương {{ $loop->iteration }}
                        </option>
                    @endforeach
                </select>
                <script>
                    function changeChuong() {
                        const chuong1 = document.getElementById('chuong').value;
                        let url = '{{ route('truyenchitiet', ['slug' => $truyen_slug->slug, 'chuong' => ':chuong']) }}';
                        window.location.href = url.replace(':chuong', chuong1);
                    }
                </script>
            </div>
            <div class="col-md-6" style="margin-top: 20px; font-size: 20px;">
                <button id="pre"
                    style="border: 2px solid red; background-color: red; color:aliceblue; border-radius: 5px; padding: 5px;">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg> Previous</button>
                <button id="next"
                    style="border: 2px solid red; background-color: red; color:aliceblue; border-radius: 5px; padding: 5px;">Next
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" style="color:aliceblue;"
                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                    </svg></button>
            </div>
            <script>
                //xử lý nút lùi
                document.getElementById("pre").addEventListener("click", pre);

                function pre() {
                    const chuong1 = parseInt(document.getElementById('chuong').value);
                    let url = '{{ route('truyenchitiet', ['slug' => $truyen_slug->slug, 'chuong' => ':chuong']) }}';
                    if (chuong1 > 1)
                        window.location.href = url.replace(':chuong', chuong1 - 1);
                }
                //xử lý nút tiến
                document.getElementById("next").addEventListener("click", next);

                var soluong_chuong = {{ count($truyen_chuong) }};

                function next() {
                    const chuong1 = parseInt(document.getElementById('chuong').value);
                    let url = '{{ route('truyenchitiet', ['slug' => $truyen_slug->slug, 'chuong' => ':chuong']) }}';
                    if (chuong1 < soluong_chuong)
                        window.location.href = url.replace(':chuong', chuong1 + 1);
                }
            </script>
            <script>
                // function onlick() {
                //     const pre = document.getElementById('pre');
                //     const next = document.getElementById('next');

                //     const chuong1 = pa document.getElementById('chuong').value;
                //     let url = '{{ route('truyenchitiet', ['slug' => $truyen_slug->slug, 'chuong' => ':chuong']) }}';
                //     window.location.href = url.replace(':chuong', chuong1 - 1);

                //     // if (event.target === pre && chuong1 > 1) {
                //     // } else if (event.target === next) {

                //     // }
                // }

                function onlick1() {
                    //event.preventDefault(); // Prevent default link behavior

                    const pre = document.getElementById('pre');
                    const next = document.getElementById('next');
                    const chuong1 = parseInt(document.getElementById('chuong').value); // Ensure chuong1 is an integer

                    console.log(chuong1);

                    if (event.target === pre && chuong1 > 1) {
                        const url = '{{ route('truyenchitiet', ['slug' => $truyen_slug->slug, 'chuong' => ':chuong']) }}';
                        window.location.href = url.replace(':chuong', chuong1 - 1); // Navigate to previous chapter
                    } else if (event.target === next) {
                        // Add logic for navigating to the next chapter here, similar to the previous chapter logic
                        // Assuming you have a way to determine the next chapter number
                        const nextChuong = chuong1 + 1;
                        const nextUrl = '{{ route('truyenchitiet', ['slug' => $truyen_slug->slug, 'chuong' => ':chuong']) }}';
                        window.location.href = nextUrl.replace(':chuong', nextChuong);
                    }
                }
            </script>
        </div>
        <div class="row">
            @foreach ($truyenchitiet as $item)
                <img src="{{ asset('public/image/truyen/' . $item->Truyen->slug . '/chuong-' . $item->chuong . '/' . $item->hinhanh) }}"
                    alt="hinhanh" style="width: 100%;">
            @endforeach
        </div>
    </div>
@endsection
