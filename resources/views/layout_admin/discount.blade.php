@extends('layout_admin.master')
@section('content')   
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Hóa đơn</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Tất cả hóa đơn</h6>
            </nav>
            @include('layout_admin.info')
        </div>
    </nav>
    <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        @if (session('information'))
                            <div class="alert alert-success">{{ session('information') }}</div>
                        @endif
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Khuyến mãi thẻ</h6>
                        </div>
                        <form action="{{ route('update.discount', $discount->id) }}" method="post">  
                        @csrf
                            <div class="card-body p-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="basic-url">Giảm giá</label>
                                    <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                    <input type="number" class="form-control" id="discount" name="discount" value="{{ $discount->discount }}">
                                    <span class="input-group-text" id="basic-addon2">%</span>                                   
                                    </div>
                                    @error('discount')
                                        <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-12">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection