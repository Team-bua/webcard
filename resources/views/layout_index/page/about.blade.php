@extends('layout_index.master')
@section('content')
    <section class="wrapper bg-soft-primary" style="background-image: url('dev/img/photos/about.jpg')">
        <div class="container pt-10 pb-12 pt-md-14 pb-md-16 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-1 mb-3">Giới thiệu</h1>
                    <nav class="d-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Đội ngũ</li>
                        </ol>
                    </nav>
                    <!-- /nav -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light wrapper-border">
        <div class="container py-14 py-md-16">
            <div class="row mb-3">
                <div class="col-md-10 col-lg-12 col-xl-10 col-xxl-9 mx-auto text-center">
                    <h3 class="display-4 mb-7 px-lg-19 px-xl-18">Think unique and be innovative. Make a difference with
                        Sandbox.</h3>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row gx-lg-8 gx-xl-12 gy-6 text-center">
                <div class="col-md-6 col-lg-4">
                  <img src="{{ asset('dev/img/client-2.png') }}" style="width: 100px; height: 100px;" alt="">
                  <h4>Thẻ quà tặng được sử dụng tại hơn 160 thương hiệu nổi tiếng với 12,000 cửa hàng toàn quốc</h4>
                </div>
                <!--/column -->
                <div class="col-md-6 col-lg-4">
                  <img src="{{ asset('dev/img/client-3.png') }}" style="width: 100px; height: 100px;" alt="">
                  <h4>Sự lựa chọn hàng đầu của hơn 500 tập đoàn đa quốc gia</h4>
                </div>
                <!--/column -->
                <div class="col-md-6 col-lg-4">
                  <img src="{{ asset('dev/img/client-5.png') }}" style="width: 150px; height: 100px;" alt="">
                  <h4>Nền tảng an toàn và bảo mật</h4>
                </div>
                <!--/column -->
              </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light wrapper-border">
        <div class="container py-14 py-md-16">
            <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                <div class="col-lg-4">
                    <h2 class="fs-15 text-uppercase text-line text-primary text-center mb-3">Đội ngũ chúng tôi</h2>
                    <h3 class="display-5 mb-5">Tiết kiệm thời gian và tiền bạc của bạn bằng cách chọn chúng tôi</p>
                </div>
                <!--/column -->
                <div class="col-lg-8">
                    <div class="carousel owl-carousel text-center" data-margin="30" data-dots="true" data-autoplay="false"
                        data-autoplay-timeout="5000"
                        data-responsive='{"0":{"items": "1"}, "768":{"items": "2"}, "992":{"items": "2"}, "1200":{"items": "3"}}'>
                        <div class="item">
                            <img class="rounded-circle w-20 mx-auto mb-4" src="{{ asset('dev/img/avatars/t1.jpg') }}" alt="" />
                            <h4 class="mb-1">Nguyễn Văn A</h4>
                            <div class="meta mb-2">Quản lý</div>
                            <nav class="nav social justify-content-center text-center mb-0">
                                <a href="#"><i class="uil uil-twitter"></i></a>
                                <a href="#"><i class="uil uil-slack"></i></a>
                                <a href="#"><i class="uil uil-linkedin"></i></a>
                            </nav>
                            <!-- /.social -->
                        </div>
                        <!-- /.item -->
                        <div class="item">
                            <img class="rounded-circle w-20 mx-auto mb-4" src="{{ asset('dev/img/avatars/t2.jpg') }}" alt="" />
                            <h4 class="mb-1">Lê Văn Tèo</h4>
                            <div class="meta mb-2">Nhân viên tư vấn</div>
                            <nav class="nav social justify-content-center text-center mb-0">
                                <a href="#"><i class="uil uil-youtube"></i></a>
                                <a href="#"><i class="uil uil-facebook-f"></i></a>
                                <a href="#"><i class="uil uil-dribbble"></i></a>
                            </nav>
                            <!-- /.social -->
                        </div>
                        <!-- /.item -->
                        <div class="item">
                            <img class="rounded-circle w-20 mx-auto mb-4" src="{{ asset('dev/img/avatars/t3.jpg') }}" alt="" />
                            <h4 class="mb-1">Nguyễn Xuyến</h4>
                            <div class="meta mb-2">Nhân viên hỗ trợ</div>
                            <nav class="nav social justify-content-center text-center mb-0">
                                <a href="#"><i class="uil uil-linkedin"></i></a>
                                <a href="#"><i class="uil uil-tumblr-square"></i></a>
                                <a href="#"><i class="uil uil-facebook-f"></i></a>
                            </nav>
                            <!-- /.social -->
                        </div>
                    </div>
                    <!-- /.owl-carousel -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    </div>
    <!-- /.content-wrapper -->
@endsection
