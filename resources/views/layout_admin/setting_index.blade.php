@extends('layout_admin.master')
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Thiết lập</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Thiết lập giao diện</h6>
            </nav>
            @include('layout_admin.info')
        </div>
        </div>
    </nav>
    @if (session('information'))
    <div class="alert alert-success"><b>{{ session('information') }}</b></div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="card h-80">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Thiết lập banner trang chủ</h6>
                            </div>
                        </div>
                        <form action="{{ route('updatebannerindex', $index->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body p-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Nội dung 1</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="desc" name="desc" value="{{ $index->desc_banner }}"
                                            placeholder="Tiêu đề 1">
                                    </div>
                                    @error('name')
                                        <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Nội dung 2</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="sub_desc" name="sub_desc"
                                            placeholder="Tiêu đề 2" value="{{ $index->sub_desc_banner }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Ảnh banner</label> <br>
                                    <input id="img0" type="file" name="img_banner" class="form-control"
                                        style="display: none" onchange="changeImgPack(this, 0)">
                                    <img id="0" class="img0 imgpackgame" style="width: 120px; height: 120px;"
                                        src="{{ asset($index->image_banner ? $index->image_banner : 'dashboard/assets/img/no_img.jpg') }}">
                                </div>
                                @error('img_banner')
                                    <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-12">Cập nhật </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card h-80">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Thiết lập nội dung 1</h6>
                            </div>
                        </div>
                    </div>
                    <form action="{{isset($index->id) ? route('updateserve', $index->id) : '#'}}" id="form_data_serve" method="post"  enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id_serve_delected" name="id_serve_delected" value="">
                        <div class="card-body p-3">
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Tiêu đề </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="text" class="form-control" id="tittle" name="tittle" value="{{ isset($index->title_serve) ? $index->title_serve : '' }}" placeholder="Tiêu đề 1">
                                </div>
                                @error('name')
                                <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                            @php
                                $i = 0;
                            @endphp
                            @if(isset($index->desc_serve))
                            @for($i; $i < count(json_decode($index->desc_serve)); $i++)
                            <input type="hidden" name="serve[]" value="{{isset(json_decode($index->icon_serve)[$i]) ? json_decode($index->icon_serve)[$i] : 'dashboard/assets/img/no_img.jpg'}}">
                            <div class="row" id="row_serve{{$i + 1}}">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="form-control-label" for="basic-url">Nội dung </label>

                                        <div class="input-group">
                                            <input name="title_serve[]" id="title_serve" type="text" value="{{ isset(json_decode($index->desc_serve)[$i]) ? json_decode($index->desc_serve)[$i] : ''}}" class="form-control" id="exampleFormControlInput1" placeholder="Nội dung. . . . . . . . ." min="0" maxlength="50" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                        <label class="form-control-label" for="basic-url">Icon </label><br>
                                        <input id="img_icon_serve{{ $i + 1}}" type="file" name="img_serve[]" class="form-control packgame"
                                        onchange="changeIconServe(this, '{{$i + 1}}'    )" style="display: none">
                                        <img id="{{$i + 1}}" class="img_icon_serve{{$i + 1}} imgserve" style="width: 50px; height: 34px;"
                                        src="{{ asset(isset(json_decode($index->icon_serve)[$i]) ? json_decode($index->icon_serve)[$i] : 'dashboard/assets/img/no_img.jpg') }}">
                                    </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="basic-url">Thao Tác: </label> <br>
                                        <button type="button" class="btn bg-gradient-primary w-12 float-left btn_remove_serve" name="remove_btn" id="{{ $i }}"><i class="fa fa-minus"></i></button>
                                        @if($i == 0)
                                        <button type="button" class="btn bg-gradient-primary w-12 float-left" name="add_btn_serve" id="add_btn_serve"><i class="fa fa-plus"></i></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endfor
                            @endif      
                            <div id="new_chq_serve"></div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-12">Cập nhật </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card h-80">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Thiết lập nội dung 2</h6>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('update.step', $index->id) }} }}" method="post" enctype="multipart/form-data" id="form_data1">
                            @csrf
                            <input type="hidden" id="id_step" name="id_step" value="">
                            <div class="card-body p-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Tiêu đề </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="tittle" name="tittle" value="{{ $index->desc_step }}"
                                            placeholder="Tiêu đề 1">
                                    </div>
                                    @error('name')
                                        <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Mô tả</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="desc" name="desc"
                                            placeholder="Tiêu đề 2" value="{{ $index->sub_desc_step }}">
                                    </div>
                                </div>
                                @php
                                    $i = 0;
                                    // dd(json_decode($index->icon_step));
                                @endphp
                                
                                <button type="button" class="btn bg-gradient-primary w-12 float-left" name="add_btn" id="add_btn"><i class="fa fa-plus"></i></button>
                                @if(isset($index->desc_number_step))
                                @for($i; $i < count(json_decode($index->desc_number_step)); $i++)
                                <div class="row" id="new{{ $i + 1 }}">
                                    <input type="hidden" name="pack[]" value="{{ json_decode($index->icon_step)[$i] }}">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Nội dung </label>                       
                                            <div class="input-group">
                                                <input name="content[]" id="content" type="text" class="form-control" value="{{ json_decode($index->desc_number_step)[$i] }}" id="exampleFormControlInput1" placeholder="Nội dung. . . . . . . . ." maxlength="50" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Miêu tả </label>                       
                                            <div class="input-group" style="width: 100%;">
                                                <input type="text" class="form-control" id="description" name="description[]" value="{{ json_decode($index->sub_desc_number_step)[$i] }}" placeholder="Miêu tả. . . . . . . . .">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="form-control-label" for="basic-url">Icon </label><br>
                                        <input id="img_icon{{ $i + 1 }}" type="file" name="icon[]" class="form-control packgame"
                                        onchange="changeIcon(this, {{ $i + 1 }})" style="display: none">
                                        <img id="{{ $i + 1 }}" class="img_icon{{ $i + 1 }} imgicon" style="width: 50px; height: 34px;"
                                        src="{{ asset(isset(json_decode($index->icon_step)[$i]) ? json_decode($index->icon_step)[$i] : 'dashboard/assets/img/no_img.jpg') }}">
                                    </div>                                 
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Thao tác</label> <br>
                                            <button type="button" class="btn bg-gradient-primary w-12 float-left btn_remove" name="remove_btn" id="{{ $i + 1 }}"><i class="fa fa-minus"></i></button>                                         
                                        </div>
                                    </div>
                                </div>
                               @endfor
                               @endif
                               @error('icon')
                                    <p style="color:red; font-size: 15px; margin-left: 10px">{{ $message }}</p>
                                @enderror
                                <div id="new_chq"></div>
                                <input type="hidden" value="1" id="total_chq">
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Ảnh </label> <br>
                                    <input id="img4" type="file" name="image_step" class="form-control"
                                        style="display: none" onchange="changeImgPack(this, 4)">
                                    <img id="4" class="img4 imgpackgame" style="width: 120px; height: 120px;"
                                        src="{{ asset($index->image_step ? $index->image_step : 'dashboard/assets/img/no_img.jpg') }}">
                                </div>
                                @error('image_step')
                                    <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-12">Cập nhật </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="card h-80">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Thiết lập ảnh nền</h6>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('updatebackground', $index->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-3">
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Ảnh nền</label> <br>
                                <input id="img3" type="file" name="img_background" class="form-control" style="display: none" onchange="changeImgPack(this, 3)">
                                <img id="3" class="img3 imgpackgame" style="width: 200px; height: 120px;" src="{{ asset($index->image_background ? $index->image_background : 'dashboard/assets/img/no_img.jpg') }}">
                            </div>
                            @error('avatar')
                            <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-12">Cập nhật </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card h-80">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Thiết lập banner mua thẻ</h6>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('updatebannercard', $index->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-3">
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Ảnh banner</label> <br>
                                <input id="img2" type="file" name="img_buy_card" class="form-control" style="display: none" onchange="changeImgPack(this, 2)">
                                <img id="2" class="img2 imgpackgame" style="width: 200px; height: 120px;" src="{{ asset($index->banner_buy_card ? $index->banner_buy_card : 'dashboard/assets/img/no_img.jpg') }}">
                            </div>
                            @error('avatar')
                            <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-12">Cập nhật </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="card h-80">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Thiết lập logo</h6>
                            </div>
                        </div>
                        <form action="{{ route('updatelogo', $index->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Chiều rộng </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-text-width"></i></span>
                                                <input type="number" class="form-control" id="width" name="width"
                                                    value="{{ json_decode($index->image_logo)[1] }}" required min="0" required>
                                                <span class="input-group-text" id="basic-addon2">px</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Chiều cao </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                                <input type="number" class="form-control" id="height" name="height"
                                                    value="{{ json_decode($index->image_logo)[2] }}" required min="0" required>
                                                <span class="input-group-text" id="basic-addon2">px</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Logo ( xóa background trước khi thêm )</label> <br>
                                    <input id="img1" type="file" name="img_logo" class="form-control" style="display: none"
                                        onchange="changeImgPack(this, 1)">
                                    <img id="1" class="img1 imgpackgame" style="width: 200px; height: 120px;"
                                        src="{{ asset(json_decode($index->image_logo)[0] ? json_decode($index->image_logo)[0] :'dashboard/assets/img/no_img.jpg') }}">
                                </div>
                                @error('img_logo')
                                    <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-12">Cập nhật </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card h-80">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Thiết lập liên hệ</h6>
                            </div>
                        </div>
                        <form action="{{ route('updatecontact', $index->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Địa chỉ </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $index->address_contact }}" placeholder="Địa chỉ" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Số điện thoại</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="{{ $index->phone_contact }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $index->email_contact }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Bản đồ (kích thước ifame 500 x 450)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map"></i></span>
                                    <input type="text" class="form-control" id="maps" name="maps" placeholder="Cài đặt ifame có kích thước 500 x 450" value="{{ $index->map_contact }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-12">Cập nhật </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
@section('script')
<script>
    function changeImgPack(input, id_number) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.img' + id_number + '').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).on('click', '.imgpackgame', function() {
        var input_id = $(this).attr('id');
        $('#img' + input_id + '').click();
    });
</script>
<script>
function changeIconServe(input, id_number) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.img_icon_serve'+id_number+'').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            } 
$(document).ready(function() {
    <?php if (isset($index->icon_serve)) { ?>
            var arr_number = '{{ count(json_decode($index->icon_serve)) }}';
            var count = '{{ count(json_decode($index->icon_serve)) }}';
            <?php } else { ?>
            var arr_number = 0;
            var count = true;
            <?php } ?>

    function data_form(number) {
        if(count == true) {
            count = 1;
        }
        var html = `<div class='row' id='row_serve`+count+`'>
                                <div class='col-md-7'>
                                    <div class='form-group'>
                                        <label class='form-control-label' for='basic-url'>Nội dung </label>

                                        <div class='input-group'>
                                            <input name='title_serve[]' id='title_serve' type='text' class='form-control' id='exampleFormControlInput1' placeholder='Nội dung. . . . . . . . .' min='0' maxlength='50' required>
                                            <span class='input-group-text' id='basic-addon2'>VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                        <label class="form-control-label" for="basic-url">Icon </label><br>
                                        <input id="img_icon_serve`+count+`" type="file" name="img_serve[]" class="form-control packgame"
                                        onchange="changeIconServe(this, `+count+`    )" style="display: none">
                                        <img id="`+count+`" class="img_icon_serve`+count+` imgserve" style="width: 50px; height: 34px;"
                                        src="{{ asset(isset(json_decode($index->icon_serve)[`+count+`]) ? json_decode($index->icon_serve)[`+count+`] : 'dashboard/assets/img/no_img.jpg') }}">
                                    </div>
                                <div class='col-md-2'>
                                    <div class='form-group'>
                                        <label class='form-control-label' for='basic-url'>Thao Tác: </label> <br>
                                        <button type='button' class='btn bg-gradient-primary w-12 float-left btn_remove_serve' name='remove_btn_serve' id='`+count+`'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                            </div>`;
                $('#new_chq_serve').append(html);

            }

            $('#add_btn_serve').click(function() {
                count++;
                data_form(count);
            });

            $(document).on('click', '.imgserve', function() {
                var input_id = $(this).attr('id');
                $('#img_icon_serve'+input_id+'').click();
            });       

            $(document).on('click', '.btn_remove_serve', function() {
               var button_id = $(this).attr('id');
               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xoá?',
                    text: "Bạn không thể hoàn tác sau khi xoá!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xoá!',
                    cancelButtonText: 'Huỷ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (count == true && arr_number != 0) {
                            $("#title_serve").val('');
                        } else {
                            $('#id_serve_delected').attr('value', button_id);
                            $('#row_serve' + button_id + '').remove();
                        }
                        $.ajax({
                            url: "{{ route('delete.icon.serve', $index->id) }}",
                            method: 'GET',
                            data: $('#form_data_serve').serialize(),
                            dataType: 'json',
                            success: function(data) {
                                Swal.fire(
                                    'Xóa!',
                                    'Xóa thành công',
                                    'success'
                                )
                                window.location.reload();
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Cần ít nhất một dữ liệu!',
                                })
                                window.location.reload();
                            }
                        });
                    }
                })
            });
        });
</script>
<script>
    
     function changeIcon(input, id_number) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.img_icon'+id_number+'').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }           
        $(document).ready(function() {

            <?php if (isset($index->desc_number_step)) { ?>
            var arr_number = "{{ count(explode(',', $index->desc_number_step)) }}";
            var count = "{{ count(explode(',', $index->desc_number_step)) }}";
            <?php } else { ?>
            var arr_number = 0;
            var count = true;
            <?php } ?>

            function data_form(number) {
                if(count == true){
                    count = 1;
                }
                var html = `<div class="row" id="new`+count+`">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Nội dung </label>                       
                                            <div class="input-group">
                                                <input name="content[]" id="content" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nội dung. . . . . . . . ." maxlength="50" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Miêu tả </label>                       
                                            <div class="input-group" style="width: 100%;">
                                                <input type="text" class="form-control" id="description" name="description[]" value="" placeholder="Miêu tả. . . . . . . . .">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="form-control-label" for="basic-url">Icon </label><br>
                                        <input id="img_icon`+count+`" type="file" name="icon[]" class="form-control packgame"
                                        onchange="changeIcon(this, `+count+`)" style="display: none">
                                        <img id="`+count+`" class="img_icon`+count+` imgicon" style="width: 50px; height: 34px;"
                                        src="{{ asset('dashboard/assets/img/no_img.jpg') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Thao tác</label> <br>
                                            <button type="button" class="btn bg-gradient-primary w-12 float-left btn_remove" name="btn_remove" id="`+count+`"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>`;

                $('#new_chq').append(html);

            }

            $('#add_btn').click(function() {
                count++;
                if(count <= 6){
                    data_form(count);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Giới hạn là 6 nội dung!',
                    })
                }
                
            });

            $(document).on('click', '.imgicon', function() {
                var input_id = $(this).attr('id');
                $('#img_icon'+input_id+'').click();
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xoá?',
                    text: "Bạn không thể hoàn tác sau khi xoá!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xoá!',
                    cancelButtonText: 'Huỷ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (count == true && arr_number != 0) {
                            $("#content").val('');
                            $("#description").val('');
                        } else {
                            $('#id_step').attr('value', button_id - 1);
                            $('#new' + button_id + '').remove();
                        }
                        $.ajax({
                            url: "{{ route('delete.icon', $index->id) }}",
                            method: 'GET',
                            data: $('#form_data1').serialize(),
                            dataType: 'json',
                            success: function(data) {
                                Swal.fire(
                                    'Xóa!',
                                    'Xóa thành công',
                                    'success'
                                )
                                window.location.reload();
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Cần ít nhất một dữ liệu!',
                                })
                                window.location.reload();
                            }
                        });
                    }
                })

            });
        });
</script>
@endsection
