@extends('layout_admin.master')
@section('content')   
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        @include('user.avatar')
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="card h-100">
                        @if (session('information'))
                            <div class="alert alert-success">{{ session('information') }}</div>
                        @endif
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Thông tin cá nhân</h6>
                        </div>
                        <form action="{{ route('profile.update.info', $user->id) }}" method="post"  enctype="multipart/form-data">  
                        @csrf
                            <div class="card-body p-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Tên khách hàng</label>
                                    <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Tên khách hàng">                                   
                                    </div>
                                    @error('name')
                                        <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Số điện thoại</label>
                                    <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" placeholder="Số điện thoại">                       
                                    </div>
                                    @error('phone')
                                        <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Email</label>
                                    <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Ảnh đại diện</label> <br>
                                    <div class="avatar avatar-xl position-relative" style="margin-top: 25px; margin-left: 25px">
                                    @if(Auth::user()->avatar_original)
                                        <img class="border-radius-lg shadow-sm" style="width: 120px; height: 120px;" src="{{ $user->avatar_original}}">
                                    @else   
                                        <input id="fImages" type="file" name="avatar" class="form-control" style="display: none"  onchange="changeImg(this)">
                                        <img id="img" class="border-radius-lg shadow-sm" style="width: 120px; height: 120px;" src="{{ asset($user->avatar ? $user->avatar : 'dashboard/assets/img/no_img.jpg') }}">
                                    @endif                                    
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
                        @if (session('changepass'))
                            <div class="alert alert-success">{{ session('changepass') }}</div>
                        @endif
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Đổi mật khẩu</h6>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('profile.change_pass', $user->id) }} "method="post">  
                            @csrf
                            <div class="card-body p-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Mật khẩu mới</label>
                                    <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Mật khẩu mới">
                                    </div>
                                    @error('new_password')
                                        <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Nhập lại mật khẩu</label>
                                    <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu">
                                    </div>
                                    @error('confirm_password')
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
    </div>
@endsection