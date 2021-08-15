@extends('layout_index.master')
@section('content')
    <section class="wrapper bg-soft-primary">
        <div class="container pt-10 pb-15 py-lg-17 py-xl-20 py-xxl-22 position-relative">
            <img class="position-lg-absolute col-12 col-lg-12 mt-lg-n50p mb-3 mb-md-10 mb-lg-0"
                src="{{ asset('dev/img/photos/hopqua.png') }}" data-cue="fadeIn" alt=""
                style="top: 50%; left: 0%; width: 50%; height: 80%;" />
            <div class="row gx-lg-8 gx-xl-12 align-items-center">
                <div class="col-md-10 offset-md-1 col-lg-6 offset-lg-6 mt-md-n9 text-center text-lg-start"
                    data-cues="slideInDown" data-group="download">
                    <h1 class="display-4 mb-4 px-md-10 px-lg-0">Webcard.com cung cấp các loại thẻ cào & voucher giá rẻ</h1>
                    <p class="lead fs-lg mb-7 px-md-10 px-lg-0 pe-xxl-15">Giao dịch nhanh chóng - Đảm bảo uy tín</p>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-2">
            <div class="row text-center mt-xl-12">
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <h3 class="display-4 mb-9 px-xxl-11">Hãy để chúng tôi phục vụ bạn</h3>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="row gx-md-5 gy-5 text-center">
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <img src="{{ asset('dev/img/icons/search-1.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-yellow mb-3" alt="">
                            <h4>Cung cấp nhiều loại thẻ cho khách hàng lựa chọn</h4>
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <img src="{{ asset('dev/img/icons/shield.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-red mb-3" alt="">
                            <h4>Trải nghiệm đơn giản, nhưng bảo mật cao</h4>
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <img src="{{ asset('dev/img/icons/gift.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-green mb-3" alt="">
                            <h4>Giao dịch - gửi thẻ nhanh chóng, uy tín</h4>
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <img src="{{ asset('dev/img/icons/megaphone.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-blue mb-3" alt="">
                            <h4>Nâng cao trải nghiệm người dùng khi sử dụng dịch vụ</h4>
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row gx-lg-8 align-items-center">
                <div class="col-lg-6">
                    <figure><img src="{{ asset('dev/img/photos/device.png') }}"
                            srcset="{{ asset('dev/img/photos/device@2x.png') }} 2x" data-cue="fadeIn" alt="" /></figure>
                </div>
                <!-- /column -->
                <div class="col-lg-6">
                    <h3 class="display-4 mb-5">Cách thức giao dịch đơn giản, dễ thao tác</h3>
                    <p class="mb-8">Bằng cách nạp tiền vào tài khoản trên hệ thống trang web, bạn có thể thoải mái giao dịch và thanh toán bất cứ loại hình dịch vụ nào có trên trang web.</p>
                    <div class="row gy-6 gx-xxl-8 process-wrapper" data-cues="slideInUp" data-group="process">
                        <div class="col-md-4"> <img src="{{ asset('dev/img/icons/savings.svg') }}"
                                class="svg-inject icon-svg icon-svg-sm text-green mb-3" alt="" />
                            <h4 class="mb-1">1. Nạp tiền</h4>
                            <p class="mb-0">Nạp tiền vào tài khoản</p>
                        </div>
                        <!--/column -->
                        <div class="col-md-4"> <img src="{{ asset('dev/img/icons/shopping-cart.svg') }}"
                                class="svg-inject icon-svg icon-svg-sm text-red mb-3" alt="" />
                            <h4 class="mb-1">2. Mua thẻ</h4>
                            <p class="mb-0">Tiến hành giao dịch</p>
                        </div>
                        <!--/column -->
                        <div class="col-md-4"> <img src="{{ asset('dev/img/icons/rocket.svg') }}"
                                class="svg-inject icon-svg icon-svg-sm text-aqua mb-3" alt="" />
                            <h4 class="mb-1">3. Nhận thẻ</h4>
                            <p class="mb-0">Tại trang người dùng của bạn</p>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
	<section class="wrapper image-wrapper bg-image bg-overlay" data-image-src="{{ asset('dev/img/photos/lol.jpg') }}">
		<div class="container py-18">
		  <div class="row">
			<div class="col-lg-8">
			  <h2 class="fs-16 text-uppercase text-line text-white mb-3">CHỈ VỚI 1 TÀI KHOẢN VÍ ĐIỆN TỬ</h2>
			  <h2 class=" mb-6 text-white ">THANH TOÁN Ở MỌI NƠI, THEO CÁCH MÀ BẠN MUỐN</h2>
              <a href="{{ route('signup') }}" class="btn btn-white rounded mb-0 text-nowrap">Tham gia ngay</a>
			</div>
			<!-- /column -->
		  </div>
		  <!-- /.row -->
		</div>
		<!-- /.container -->
	  </section>
    <!-- /section -->
    <section class="wrapper bg-light angled upper-end lower-end">
        <div class="container pb-14 pb-md-16">
            <div class="row gx-lg-8 gy-8 mt-5 mt-md-12 mt-lg-0 mb-15 align-items-center">
                <div class="col-lg-5 order-lg-2">
                    <div class="row gx-md-5 gy-5" data-cues="fadeIn" data-group="images" data-disabled="true">
                        <div class="col-md-4 offset-md-2 align-self-end" data-cue="fadeIn" data-group="images"
                            data-show="true"
                            style="animation-name: fadeIn; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                            <figure class="rounded"><img src="{{ asset('dev/img/photos/g1.jpg') }}" alt=""></figure>
                        </div>
                        <!--/column -->
                        <div class="col-md-6 align-self-end" data-cue="fadeIn" data-group="images" data-show="true"
                            style="animation-name: fadeIn; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 300ms; animation-direction: normal; animation-fill-mode: both;">
                            <figure class="rounded"><img src="{{ asset('dev/img/photos/g2.jpg') }}" alt=""></figure>
                        </div>
                        <!--/column -->
                        <div class="col-md-6 offset-md-1" data-cue="fadeIn" data-group="images" data-show="true"
                            style="animation-name: fadeIn; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 600ms; animation-direction: normal; animation-fill-mode: both;">
                            <figure class="rounded"><img src="{{ asset('dev/img/photos/g3.jpg') }}" alt=""></figure>
                        </div>
                        <!--/column -->
                        <div class="col-md-4 align-self-start" data-cue="fadeIn" data-group="images" data-show="true"
                            style="animation-name: fadeIn; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 900ms; animation-direction: normal; animation-fill-mode: both;">
                            <figure class="rounded"><img src="{{ asset('dev/img/photos/g4.jpg') }}" alt=""></figure>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!--/column -->
                <div class="col-lg-7">
                    <h2 class="display-4 mb-3">Chúng tôi làm gì?</h2>
                    <p class="lead fs-lg mb-8 pe-xxl-2">Dịch vụ đầy đủ mà chúng tôi đang cung cấp được thiết kế đặc biệt để
                        đáp ứng nhu cầu của bạn</p>
                    <div class="row gx-xl-10 gy-6" data-cues="slideInUp" data-group="services" data-disabled="true">
                        <div class="col-md-6 col-lg-12 col-xl-6" data-cue="slideInUp" data-group="services" data-show="true"
                            style="animation-name: slideInUp; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                            <div class="d-flex flex-row">
                                <div>
                                    <div class="icon btn btn-circle btn-lg btn-soft-primary disabled me-5"> <i
                                            class="uil uil-phone-volume"></i> </div>
                                </div>
                                <div>
                                    <h4 class="mb-1">Hỗ trợ 24/7</h4>
                                    <p class="mb-0">Hỗ trợ của chúng tôi luôn lôn sẵn sàng hỗ trợ bạn, 24 giờ mỗi ngày.</p>
                                </div>
                            </div>
                        </div>
                        <!--/column -->
                        <div class="col-md-6 col-lg-12 col-xl-6" data-cue="slideInUp" data-group="services" data-show="true"
                            style="animation-name: slideInUp; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 300ms; animation-direction: normal; animation-fill-mode: both;">
                            <div class="d-flex flex-row">
                                <div>
                                    <div class="icon btn btn-circle btn-lg btn-soft-primary disabled me-5"> <i
                                            class="uil uil-shield-check exclamation"></i> </div>
                                </div>
                                <div>
                                    <h4 class="mb-1">An toàn và Bảo mật</h4>
                                    <p class="mb-0">Chúng tôi không lưu trữ nhật ký để đảm bảo bảo mật cao nhất.</p>
                                </div>
                            </div>
                        </div>
                        <!--/column -->
                        <div class="col-md-6 col-lg-12 col-xl-6" data-cue="slideInUp" data-group="services" data-show="true"
                            style="animation-name: slideInUp; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 600ms; animation-direction: normal; animation-fill-mode: both;">
                            <div class="d-flex flex-row">
                                <div>
                                    <div class="icon btn btn-circle btn-lg btn-soft-primary disabled me-5"> <i
                                            class="uil uil-laptop-cloud"></i> </div>
                                </div>
                                <div>
                                    <h4 class="mb-1">Nạp với giá thấp hơn</h4>
                                    <p class="mb-0">Chiết khấu lên đến hơn 20%.</p>
                                </div>
                            </div>
                        </div>
                        <!--/column -->
                        <div class="col-md-6 col-lg-12 col-xl-6" data-cue="slideInUp" data-group="services" data-show="true"
                            style="animation-name: slideInUp; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 900ms; animation-direction: normal; animation-fill-mode: both;">
                            <div class="d-flex flex-row">
                                <div>
                                    <div class="icon btn btn-circle btn-lg btn-soft-primary disabled me-5"> <i
                                            class="uil uil-chart-line"></i> </div>
                                </div>
                                <div>
                                    <h4 class="mb-1">Chi phí thấp</h4>
                                    <p class="mb-0">Chúng tôi cung cấp giá tốt nhất trên thị trường.</p>
                                </div>
                            </div>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <h2 class="display-4 mb-3 text-center">Đối tác của chúng tôi</h2>
            <div class="carousel owl-carousel clients owl-loaded owl-drag" data-margin="30" data-loop="true"
                data-dots="false" data-autoplay="true" data-autoplay-timeout="3000"
                data-responsive="{&quot;0&quot;:{&quot;items&quot;: &quot;2&quot;}, &quot;768&quot;:{&quot;items&quot;: &quot;4&quot;}, &quot;992&quot;:{&quot;items&quot;: &quot;5&quot;}, &quot;1200&quot;:{&quot;items&quot;: &quot;6&quot;}, &quot;1400&quot;:{&quot;items&quot;: &quot;7&quot;}}">
                <div class="owl-stage-outer">
                    <div class="owl-stage"
                        style="transform: translate3d(-1140px, 0px, 0px); transition: all 0.25s ease 0s; width: 4370px;">
                        @if($partners)
                        @foreach ($partners as $partner)
                        <div class="owl-item cloned" style="width: 160px; margin-right: 30px;">
                            <div class="item px-5"><a href="{{ $partner->link ? $partner->link : '#' }}" target="_blank"><img src="{{ asset($partner->image) }}" alt=""></a></div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><i
                            class="uil-arrow-left"></i></button><button type="button" role="presentation"
                        class="owl-next"><i class="uil-arrow-right"></i></button></div>
                <div class="owl-dots disabled"></div>
            </div>
            <!-- /.owl-carousel -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    </div>
    <!-- /.content-wrapper -->
@endsection
