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
                            {!! $index->map_contact !!}
                        </div>
                        <!-- /.map -->
                </div>
                <!--/column -->
                <div class="col-lg-6">
                    <div class="shape bg-dot primary rellax w-18 h-18" data-rellax-speed="1"
                    style="top: 0; right: 1.4rem; z-index: 0;"></div>
                    <h2 class="display-4 mb-8"> {{ $index->desc_contact }}</h2>
                    <div class="d-flex flex-row">
                        <div>
                            <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-location-pin-alt"></i> </div>
                        </div>
                        <div>
                            <h5 class="mb-1">Địa chỉ</h5>
                            <address> {{ $index->address_contact }}</address>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div>
                            <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-phone-volume"></i> </div>
                        </div>
                        <div>
                            <h5 class="mb-1">Hotline</h5>
                            <p> {{ $index->phone_contact }}</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div>
                            <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-envelope"></i> </div>
                        </div>
                        <div>
                            <h5 class="mb-1">E-mail</h5>
                            <p class="mb-0"><a href="mailto: {{ $index->email_contact }}" class="link-body"> {{ $index->email_contact }}</a></p>
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
