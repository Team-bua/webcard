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
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Nội dung 2</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="text" class="form-control" id="tittle2" name="tittle2" placeholder="Tiêu đề 2" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Ảnh banner</label> <br>
                                <input id="img0" type="file" name="img_banner" class="form-control" style="display: none" onchange="changeImgPack(this, 0)">
                                <img id="0" class="img0 imgpackgame" style="width: 200px; height: 120px;" src="{{ asset('dashboard/assets/img/no_img.jpg') }}">
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
                                <h6 class="mb-0">Thiết lập 2</h6>
                            </div>
                        </div>
                    </div>
                    <form action="{{isset($index->id) ? route('updateserve', $index->id) : '#'}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-3">
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Tiêu đề 1 </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="text" class="form-control" id="tittle1" name="tittle1" value="{{ isset($index->title_serve) ? $index->title_serve : '' }}" placeholder="Tiêu đề 1">
                                </div>
                                @error('name')
                                <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                            @if(isset($index->desc_serve))
                            @for($i = 0; $i < count(json_decode($index->desc_serve)); $i++)
                            <div class="row" style="width: 80%;" id="row_serve{{ $i }}">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="form-control-label" for="basic-url">Giá: </label>

                                        <div class="input-group">
                                            <input name="title_serve[]" id="title_serve" type="text" value="{{ isset(json_decode($index->desc_serve)[$i]) ? json_decode($index->desc_serve)[$i] : ''}}" class="form-control" id="exampleFormControlInput1" placeholder="Giá. . . . . . . . ." min="0" maxlength="50" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-control-label" for="basic-url">Giảm giá: </label>

                                        <div class="input-group">
                                            <input id="img_serve{{ $i }}" type="file" name="img_serve[]" class="form-control hidden packgame" onchange="changeImgServe(this, '{{ $i }}')" style="display:none">
                                            <img id="{{ $i }}" class="img_serve{{ $i }} indexServe" style="width: 50px; height: 34px;" src="{{ asset(json_decode($index->icon_serve)[$i]) ? asset(json_decode($index->icon_serve)[$i]) : asset('dashboard/assets/img/no_img.jpg') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="basic-url">Thao Tác: </label> <br>
                                        <button type="button" class="btn bg-gradient-primary w-12 float-left btn_remove" name="remove_btn" id="{{ $i }}"><i class="fa fa-minus"></i></button>
                                        @if($i == 0)
                                        <button type="button" class="btn bg-gradient-primary w-12 float-left" name="add_btn_serve" id="add_btn_serve"><i class="fa fa-plus"></i></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endfor
                            @else
                            <div class="row" style="width: 80%;" id="row_serve0">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="form-control-label" for="basic-url">Giá: </label>

                                        <div class="input-group">
                                            <input name="title_serve[]" id="title_serve" type="text" value="" class="form-control" id="exampleFormControlInput1" placeholder="Giá. . . . . . . . ." min="0" maxlength="50" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-control-label" for="basic-url">Giảm giá: </label>

                                        <div class="input-group">
                                            <input id="img_serve0" type="file" name="img_serve[]" class="form-control hidden packgame" onchange="changeImgServe(this, 0)" style="display:none">
                                            <img id="0" class="img_serve0 indexServe" style="width: 50px; height: 34px;" src="asset('dashboard/assets/img/no_img.jpg')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="basic-url">Thao Tác: </label> <br>                                   
                                        <button type="button" class="btn bg-gradient-primary w-12 float-left" name="add_btn_serve" id="add_btn_serve"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
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
            <div class="col-12 col-xl-6">
                <div class="card h-80">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Thiết lập banner</h6>
                            </div>
                        </div>
                    </div>
                    <form action="#" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-3">
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Tiêu đề 1 </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="text" class="form-control" id="tittle1" name="tittle1" value="" placeholder="Tiêu đề 1">
                                </div>
                                @error('name')
                                <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Tiêu đề 2</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="text" class="form-control" id="tittle2" name="tittle2" placeholder="Tiêu đề 2" value="">
                                </div>
                                @error('image_step')
                                    <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Ảnh đại diện</label> <br>
                                <div class="avatar avatar-xl position-relative" style="margin-top: 25px; margin-left: 25px">
                                    <input id="fImages" type="file" name="avatar" class="form-control" style="display: none" onchange="changeImg(this)">
                                    <img id="img" class="border-radius-lg shadow-sm" style="width: 120px; height: 120px;" src="{{ asset('dashboard/assets/img/no_img.jpg') }}">
                                </div>
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
                                <h6 class="mb-0">Thiết lập 2</h6>
                            </div>
                        </div>
                        <form action="{{ route('updatebackground', $index->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body p-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Ảnh nền</label> <br>
                                    <input id="img3" type="file" name="img_background" class="form-control"
                                        style="display: none" onchange="changeImgPack(this, 3)">
                                    <img id="3" class="img3 imgpackgame" style="width: 200px; height: 120px;"
                                        src="{{ asset($index->image_background ? $index->image_background : 'dashboard/assets/img/no_img.jpg') }}">
                                </div>
                                @error('img_background')
                                    <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Tiêu đề 2</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="text" class="form-control" id="tittle2" name="tittle2" placeholder="Tiêu đề 2" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Tiêu đề 2</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="text" class="form-control" id="tittle2" name="tittle2" placeholder="Tiêu đề 2" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Tiêu đề 2</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="text" class="form-control" id="tittle2" name="tittle2" placeholder="Tiêu đề 2" value="">
                                </div>
                                @error('img_buy_card')
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
                    <form action="#" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-3">
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Ảnh nền</label> <br>
                                <input id="img3" type="file" name="img_background" class="form-control" style="display: none" onchange="changeImgPack(this, 3)">
                                <img id="3" class="img3 imgpackgame" style="width: 200px; height: 120px;" src="{{ asset('dashboard/assets/img/no_img.jpg') }}">
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
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Logo ( xóa background trước khi thêm )</label> <br>
                                <input id="img1" type="file" name="img_logo" class="form-control" style="display: none" onchange="changeImgPack(this, 1)">
                                <img id="1" class="img1 imgpackgame" style="width: 200px; height: 120px;" src="{{ asset(json_decode($index->image_logo)[0] ? json_decode($index->image_logo)[0] :'dashboard/assets/img/no_img.jpg') }}">
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
                                <h6 class="mb-0">Thiết lập liên hệ</h6>
                            </div>
                        </div>
                        <form action="{{ route('updatecontact', $index->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body p-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Tiêu đề </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="tittle" name="tittle" value="{{ $index->desc_contact }}"
                                            placeholder="Tiêu đề">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Địa chỉ </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-book"></i></span>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $index->address_contact }}"
                                            placeholder="Địa chỉ" required>
                                    </div>
                                </div>
                            </div>
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
            var count = 1;
            <?php } ?>

            function data_form(number) {
                
                var html = `<div class="row" id="new`+count+`">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Nội dung </label>                       
                                            <div class="input-group">
                                                <input name="content[]" id="content" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Giá. . . . . . . . ." maxlength="50" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Miêu tả </label>                       
                                            <div class="input-group" style="width: 100%;">
                                                <input type="text" class="form-control" id="description" name="description[]" value="" placeholder="Giá. . . . . . . . .">
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
                        if (button_id == 1 && arr_number != 0) {
                            $("#content").val('');
                            $("#description").val('');
                        } else {
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
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                })
                            }
                        });
                        // Swal.fire(
                        // 'Deleted!',
                        // 'Your file has been deleted.',
                        // 'success'
                        // )
                        // $('#row'+button_id+'').remove();
                    }
                })

                $('#form_data1').validate();

            });
        });
</script>
<script>
function changeImgServe(input, id_number) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.img_serve'+id_number+'').attr('src', e.target.result);
            }
        }
    }
$(document).ready(function() {
    <?php if (isset($index->icon_serve)) { ?>
            var arr_number = '{{ count(json_decode($index->icon_serve)) }}';
            var count = '{{ count(json_decode($index->icon_serve)) }}';
            <?php } else { ?>
            var arr_number = 0;
            var count = 1;
            <?php } ?>

    function data_form(number) {
        var html = `<div class='row' style='width: 80%;' id='row_serve`+count+`'>
                                <div class='col-md-7'>
                                    <div class='form-group'>
                                        <label class='form-control-label' for='basic-url'>Giá: </label>

                                        <div class='input-group'>
                                            <input name='title_serve[]' id='title_serve' type='text' class='form-control' id='exampleFormControlInput1' placeholder='Giá. . . . . . . . .' min='0' maxlength='50' required>
                                            <span class='input-group-text' id='basic-addon2'>VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-2'>
                                    <div class='form-group'>
                                        <label class='form-control-label' for='basic-url'>Giảm giá: </label>

                                        <div class='input-group'>
                                            <input id='img_serve`+count+`' type='file' name='img_serve[]' class='form-control hidden packgame' onchange='changeImgServe(this, `+count+`)' style='display:none'>
                                            <img id='`+count+`' class='img_serve`+count+` indexServe' style='width: 50px; height: 34px;' src='{{ asset('dashboard/assets/img/no_img.jpg') }}'>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-2'>
                                    <div class='form-group'>
                                        <label class='form-control-label' for='basic-url'>Thao Tác: </label> <br>
                                        <button type='button' class='btn bg-gradient-primary w-12 float-left btn_remove' name='remove_btn_serve' id='`+count+`'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                            </div>`;
                $('#new_chq_serve').append(html);

            }

            $('#add_btn_serve').click(function() {
                count++;
                data_form(count);
            });

            $(document).on('click', '.indexServe', function() {
                var input_id = $(this).attr('id');
                $('#img_serve'+input_id+'').click();
            });       

            $(document).on('click', '.btn_remove', function() {
               var button_id = $(this).attr('id');
               $('#row_serve'+button_id+'').remove();
            });
        });
</script>
@endsection