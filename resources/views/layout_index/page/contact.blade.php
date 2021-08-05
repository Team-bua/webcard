@extends('layout_index.master')
@section('content')
    <section class="wrapper bg-soft-primary" style="background-image: url('dev/img/photos/contact.jpg')">
        <div class="container pt-10 pb-19 pt-md-14 pb-md-20 text-center">
            <div class="row">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-6 col-xxl-5 mx-auto">
                    <h1 class="display-1 mb-3">Liên hệ chúng tôi</h1>
                    <nav class="d-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
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
    <section class="wrapper bg-light angled upper-end">
        <div class="container py-14 py-md-16">
            <div class="row gy-10 gx-lg-8 gx-xl-12 mb-16 align-items-center">
                <div class="col-lg-6 position-relative">
                        <div class="map map-full rounded-top rounded-lg-start">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1234.4463464837008!2d106.62554745131472!3d10.80192195749052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752bfcfb83d76b%3A0x9a92bc5280c32acd!2zMjk1IFTDom4gS-G7syBUw6JuIFF1w70sIFTDom4gU8ahbiBOaMOsLCBUw6JuIFBow7osIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1628180641806!5m2!1svi!2s" width="500" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        <!-- /.map -->
                </div>
                <!--/column -->
                <div class="col-lg-6">
                    <div class="shape bg-dot primary rellax w-18 h-18" data-rellax-speed="1"
                    style="top: 0; right: 1.4rem; z-index: 0;"></div>
                    <h2 class="display-4 mb-8">Hợp tác cùng phát triễn</h2>
                    <div class="d-flex flex-row">
                        <div>
                            <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-location-pin-alt"></i> </div>
                        </div>
                        <div>
                            <h5 class="mb-1">Địa chỉ</h5>
                            <address>295 Tân Kỳ Tân Quý, Tân Sơn Nhì, Tân Phú, Thành phố Hồ Chí Minh
                            </address>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div>
                            <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-phone-volume"></i> </div>
                        </div>
                        <div>
                            <h5 class="mb-1">Hotline</h5>
                            <p>0349397157</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div>
                            <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-envelope"></i> </div>
                        </div>
                        <div>
                            <h5 class="mb-1">E-mail</h5>
                            <p class="mb-0"><a href="mailto:webcard@email.com" class="link-body">webcard@email.com</a></p>
                        </div>
                    </div>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
@endsection
