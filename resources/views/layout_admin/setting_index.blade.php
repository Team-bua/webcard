@extends('layout_admin.master')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
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
                        </div>
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body p-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Nội dung 1</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="tittle1" name="tittle1" value=""
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
                                        <input type="text" class="form-control" id="tittle2" name="tittle2"
                                            placeholder="Tiêu đề 2" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Ảnh banner</label> <br>
                                    <input id="img0" type="file" name="img_banner" class="form-control"
                                        style="display: none" onchange="changeImgPack(this, 0)">
                                    <img id="0" class="img0 imgpackgame" style="width: 200px; height: 120px;"
                                        src="{{ asset('dashboard/assets/img/no_img.jpg') }}">
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
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body p-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Tiêu đề 1 </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="tittle1" name="tittle1" value=""
                                            placeholder="Tiêu đề 1">
                                    </div>
                                    @error('name')
                                        <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Tiêu đề 2</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="tittle2" name="tittle2"
                                            placeholder="Tiêu đề 2" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Tiêu đề 2</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="tittle2" name="tittle2"
                                            placeholder="Tiêu đề 2" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Tiêu đề 2</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="tittle2" name="tittle2"
                                            placeholder="Tiêu đề 2" value="">
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
                                        <input type="text" class="form-control" id="tittle1" name="tittle1" value=""
                                            placeholder="Tiêu đề 1">
                                    </div>
                                    @error('name')
                                        <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Tiêu đề 2</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="tittle2" name="tittle2"
                                            placeholder="Tiêu đề 2" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Ảnh đại diện</label> <br>
                                    <div class="avatar avatar-xl position-relative"
                                        style="margin-top: 25px; margin-left: 25px">
                                        <input id="fImages" type="file" name="avatar" class="form-control"
                                            style="display: none" onchange="changeImg(this)">
                                        <img id="img" class="border-radius-lg shadow-sm"
                                            style="width: 120px; height: 120px;"
                                            src="{{ asset('dashboard/assets/img/no_img.jpg') }}">
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
                        </div>
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body p-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Tiêu đề 1 </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="tittle1" name="tittle1" value=""
                                            placeholder="Tiêu đề 1">
                                    </div>
                                    @error('name')
                                        <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Tiêu đề 2</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="tittle2" name="tittle2"
                                            placeholder="Tiêu đề 2" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Tiêu đề 2</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="tittle2" name="tittle2"
                                            placeholder="Tiêu đề 2" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Tiêu đề 2</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="tittle2" name="tittle2"
                                            placeholder="Tiêu đề 2" value="">
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
                                    <input id="img3" type="file" name="img_background" class="form-control"
                                        style="display: none" onchange="changeImgPack(this, 3)">
                                    <img id="3" class="img3 imgpackgame" style="width: 200px; height: 120px;"
                                        src="{{ asset('dashboard/assets/img/no_img.jpg') }}">
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
                                    <input id="img2" type="file" name="img_buy_card" class="form-control"
                                        style="display: none" onchange="changeImgPack(this, 2)">
                                    <img id="2" class="img2 imgpackgame" style="width: 200px; height: 120px;"
                                        src="{{ asset($index->banner_buy_card ? $index->banner_buy_card : 'dashboard/assets/img/no_img.jpg') }}">
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
                        </div>
                        <form action="{{ route('updatelogo', $index->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Chiều rộng </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
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
                                                <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
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
                                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $index->address_contact }}"
                                            placeholder="Địa chỉ" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Số điện thoại</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Số điện thoại" value="{{ $index->phone_contact }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                            value="{{ $index->email_contact }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Bản đồ (kích thước ifame 500 x 450)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-map"></i></span>
                                        <input type="text" class="form-control" id="maps" name="maps"
                                            placeholder="Cài đặt ifame có kích thước 500 x 450" value="{{ $index->map_contact }}" required>
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
@endsection
