@extends('layout_index.master')
@section('content')
    <section class="wrapper bg-soft-primary">
        <div class="container pt-10 pb-15 py-lg-17 py-xl-20 py-xxl-22 position-relative">
            @if(isset($index->image_banner))
            <img class="position-lg-absolute col-12 col-lg-12 mt-lg-n50p mb-3 mb-md-10 mb-lg-0"
                src="{{ asset($index->image_banner) }}" data-cue="fadeIn" alt=""
                style="top: 50%; left: 0%; width: 50%; height: 80%;" />
            @endif
            <div class="row gx-lg-8 gx-xl-12 align-items-center">
                <div class="col-md-10 offset-md-1 col-lg-6 offset-lg-6 mt-md-n9 text-center text-lg-start"
                    data-cues="slideInDown" data-group="download">
                    <h1 class="display-4 mb-4 px-md-10 px-lg-0">{{ $index->desc_banner }}</h1>
                    <p class="lead fs-lg mb-7 px-md-10 px-lg-0 pe-xxl-15">{{ $index->sub_desc_banner }}</p>
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
                    <h3 class="display-4 mb-9 px-xxl-11">{{ isset($index->title_serve) ? $index->title_serve : '' }}</h3>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="row gx-md-5 gy-5 text-center">
                @if(isset($index->desc_serve))
                @for($i = 0; $i < count(json_decode($index->desc_serve)); $i++)
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <img src="{{ asset(isset(json_decode($index->icon_serve)[$i])) ? json_decode($index->icon_serve)[$i] : ''}}"
                                class="svg-inject icon-svg icon-svg-md text-yellow mb-3" alt="">
                            <h4>{{ isset(json_decode($index->desc_serve)[$i]) ? json_decode($index->desc_serve)[$i] : '' }}</h4>
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                @endfor
                @endif
            </div>
            <!--/.row -->
            <div class="row gx-lg-8 align-items-center">
                <div class="col-lg-6">
                    @if(isset($index->image_step))
                    <figure><img src="{{ asset($index->image_step) }}" data-cue="fadeIn" alt="" /></figure>
                    @endif
                </div>
                <!-- /column -->
                <div class="col-lg-6">
                    <h3 class="display-4 mb-5">{{ $index->desc_step }}</h3>
                    <p class="mb-8">{{ $index->sub_desc_step }}</p>
                    <div class="row gy-6 gx-xxl-8 process-wrapper" data-cues="slideInUp" data-group="process">
                        @if(isset($index->desc_number_step))
                        @for($i = 0; $i < count(json_decode($index->desc_number_step)); $i++)
                        <div class="col-md-4"> <img src="{{ asset(json_decode($index->icon_step)[$i]) }}" width="50px" height="50px"
                                alt="" />
                            <h4 class="mb-1" style="margin-top: 10px">{{ json_decode($index->desc_number_step)[$i] }}</h4>
                            <p class="mb-0">{{ json_decode($index->sub_desc_number_step)[$i] }}</p>
                        </div>
                        @endfor
                        @endif
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
	<section class="wrapper image-wrapper bg-image bg-overlay" data-image-src="{{ asset($index->image_background) }}">
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
                            <figure class="rounded"><img src="{{ asset(isset(json_decode($index->image_to_do)[0]) ? json_decode($index->image_to_do)[0] : '' ) }}" alt=""></figure>
                        </div>
                        <!--/column -->
                        <div class="col-md-6 align-self-end" data-cue="fadeIn" data-group="images" data-show="true"
                            style="animation-name: fadeIn; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 300ms; animation-direction: normal; animation-fill-mode: both;">
                            <figure class="rounded"><img src="{{ asset(isset(json_decode($index->image_to_do)[0]) ? json_decode($index->image_to_do)[1] : '' ) }}" alt=""></figure>
                        </div>
                        <!--/column -->
                        <div class="col-md-6 offset-md-1" data-cue="fadeIn" data-group="images" data-show="true"
                            style="animation-name: fadeIn; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 600ms; animation-direction: normal; animation-fill-mode: both;">
                            <figure class="rounded"><img src="{{ asset(isset(json_decode($index->image_to_do)[0]) ? json_decode($index->image_to_do)[2] : '' ) }}" alt=""></figure>
                        </div>
                        <!--/column -->
                        <div class="col-md-4 align-self-start" data-cue="fadeIn" data-group="images" data-show="true"
                            style="animation-name: fadeIn; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 900ms; animation-direction: normal; animation-fill-mode: both;">
                            <figure class="rounded"><img src="{{ asset(isset(json_decode($index->image_to_do)[0]) ? json_decode($index->image_to_do)[3] : '' ) }}" alt=""></figure>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!--/column -->
                <div class="col-lg-7">
                    <h2 class="display-4 mb-3">{{ isset($index->decs_to_do) ? $index->decs_to_do : '' }}</h2>
                    <p class="lead fs-lg mb-8 pe-xxl-2">{{ isset($index->sub_desc_to_do) ? $index->sub_desc_to_do : '' }}</p>
                    <div class="row gx-xl-10 gy-6" data-cues="slideInUp" data-group="services" data-disabled="true">
                        @if(isset($index->desc_icon_to_do))
                        @for($i = 0; $i < count(json_decode($index->desc_icon_to_do)); $i++)
                        <div class="col-md-6 col-lg-12 col-xl-6" data-cue="slideInUp" data-group="services" data-show="true"
                            style="animation-name: slideInUp; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                            <div class="d-flex flex-row">
                                <div>
                                    <div class="icon btn btn-circle btn-lg btn-soft-primary disabled me-5"> 
                                        <img src="{{ asset(isset(json_decode($index->icon_to_do)[$i]) ? json_decode($index->icon_to_do)[$i] : '') }}" alt="" width="30px" height="30px"> </div>
                                </div>
                                <div>
                                    <h4 class="mb-1">{{ isset(json_decode($index->desc_icon_to_do)[$i]) ? json_decode($index->desc_icon_to_do)[$i] : ''}}</h4>
                                    <p class="mb-0">{{ isset(json_decode($index->sub_desc_icon_to_do)[$i]) ? json_decode($index->sub_desc_icon_to_do)[$i] : ''}}</p>
                                </div>
                            </div>
                        </div>
                        @endfor
                        @endif
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
