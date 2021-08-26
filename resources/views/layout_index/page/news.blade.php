@extends('layout_index.master')
@section('content')
    <section class="wrapper bg-soft-primary">
        <img src="{{ asset('dev/img/photos/news.jpg') }}" width="100%" height="400px" alt="">
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light wrapper-border">
        <div class="container py-14 py-md-16">
            <div class="row">
                <div class="col-lg-9 col-xl-8 col-xxl-7 mx-auto">
                    <h3 class="display-4 mb-6 text-center">Tin tức mới nhất</h3>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="position-relative">
                <div class="carousel owl-carousel gap-small blog grid-view owl-loaded owl-drag" data-margin="0"
                    data-dots="true" data-autoplay="false" data-autoplay-timeout="5000"
                    data-responsive="{&quot;0&quot;:{&quot;items&quot;: &quot;1&quot;}, &quot;768&quot;:{&quot;items&quot;: &quot;2&quot;}, &quot;992&quot;:{&quot;items&quot;: &quot;2&quot;}, &quot;1200&quot;:{&quot;items&quot;: &quot;3&quot;}}">

                    <!-- /.item -->

                    <!-- /.item -->

                    <!-- /.item -->

                    <!-- /.item -->
                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1480px;">
                            @if($news)
                            @foreach ($news as $new)                      
                            <div class="owl-item active" style="width: 370px;">
                                <div class="item">
                                    <div class="item-inner">
                                        <article>
                                            <div class="card">
                                                <figure class="card-img-top overlay overlay1 hover-scale"><a href="{{ route('news.detail', $new->id) }}"><span
                                                            class="bg"></span> <img src="{{ asset( $new->avatar ? $new->avatar : 'dashboard/assets/img/no_img.jpg') }}" alt=""></a>
                                                    <figcaption>
                                                        <h5 class="from-top mb-0">Xem thêm</h5>
                                                    </figcaption>
                                                </figure>
                                                <div class="card-body">
                                                    <div class="post-header">
                                                        <!-- /.post-category -->
                                                        <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark"
                                                                href="{{ route('news.detail', $new->id) }}">{{ $new->tittle }}</a></h2>
                                                    </div>
                                                    <!-- /.post-header -->
                                                    <div class="post-content" style="display: -webkit-box;width:280px;line-height:25px;overflow: hidden; text-align: justify; text-overflow: ellipsis;-webkit-line-clamp:3;-webkit-box-orient: vertical;">
                                                        <p >{{ $new->content }}</p>
                                                    </div>
                                                    <!-- /.post-content -->
                                                </div>
                                                <!--/.card-body -->
                                                <div class="card-footer">
                                                    <ul class="post-meta d-flex mb-0">
                                                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ date('H:i d/m/Y', strtotime(str_replace('/', '-', $new->created_at))) }}</span></li>
                                                        <li class="post-likes ms-auto"><a href="#"><i class="uil uil-eye"></i>{{ $new->view }}</a></li>
                                                    </ul>
                                                    <!-- /.post-meta -->
                                                </div>
                                                <!-- /.card-footer -->
                                            </div>
                                            <!-- /.card -->
                                        </article>
                                        <!-- /article -->
                                    </div>
                                    <!-- /.item-inner -->
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><i
                                class="uil-arrow-left"></i></button><button type="button" role="presentation"
                            class="owl-next"><i class="uil-arrow-right"></i></button></div>
                    <div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button
                            role="button" class="owl-dot"><span></span></button></div>
                </div>
                <!-- /.owl-carousel -->
            </div>
            <!-- /.position-relative -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    </div>
    </div>
    <!-- /.content-wrapper -->
@endsection
