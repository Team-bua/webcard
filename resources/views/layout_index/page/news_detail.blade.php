@extends('layout_index.master')
@section('content')
    <section class="wrapper bg-soft-primary">
        <img src="{{ asset('dev/img/photos/news.jpg') }}" width="100%" height="400px" alt="">
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
          <div class="row gx-lg-8 gx-xl-12">
            <div class="col-lg-8">
              <div class="blog single">
                <div class="card">
                  <figure class="card-img-top"><img src="{{ asset( $news_detail->thumbnail ? $news_detail->thumbnail : $news_detail->avatar ) }}" alt=""></figure>
                  <div class="card-body">
                    <div class="classic-view">
                      <article class="post">
                        <div class="post-content mb-5">
                          <h2 class="h1 mb-4">{{ $news_detail->tittle }}</h2>
                            <p>{{ $news_detail->content }}</p>
                          <div class="row g-6 mt-3 mb-10 light-gallery-wrapper">
                          <!-- /.row -->
                        </div>
                      </article>
                      <!-- /.post -->
                    </div>
                    <!-- /.classic-view -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.blog -->
            </div>
            <!-- /column -->
            <aside class="col-lg-4 sidebar mt-11 mt-lg-6">
              <div class="widget">
                <h4 class="widget-title mb-3">Bài viết gần đây</h4>
                <ul class="image-list">
                    @foreach ($news_other as $new)
                    <li>
                        <figure class="rounded"><a href="{{ route('news.detail', $new->id) }}"><img src="{{ asset($new->avatar) }}" alt=""></a></figure>
                        <div class="post-content">
                          <h6 class="mb-2"> <a class="link-dark" href="{{ route('news.detail', $new->id) }}">{{ $new->tittle }}</a> </h6>
                          <ul class="post-meta">
                            <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ date('H:i d/m/Y', strtotime(str_replace('/', '-', $new->created_at))) }}</span></li>
                          </ul>
                          <!-- /.post-meta -->
                        </div>
                    </li>
                    @endforeach          
                </ul>
                <!-- /.image-list -->
              </div>
              <div class="widget">
                <h4 class="widget-title mb-3">Bài viết xem nhiều</h4>
                <ul class="image-list">
                    @foreach ($views_news as $new)
                    <li>
                        <figure class="rounded"><a href="{{ route('news.detail', $new->id) }}"><img src="{{ asset($new->avatar) }}" alt=""></a></figure>
                        <div class="post-content">
                          <h6 class="mb-2"> <a class="link-dark" href="{{ route('news.detail', $new->id) }}">{{ $new->tittle }}</a> </h6>
                          <ul class="post-meta">
                            <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ date('H:i d/m/Y', strtotime(str_replace('/', '-', $new->created_at))) }}</span></li>
                            <li class="post-comments"><a href="#"><i class="uil uil-eye"></i>{{ $new->view }}</a></li>
                          </ul>
                          <!-- /.post-meta -->
                        </div>
                    </li>
                    @endforeach          
                </ul>
                <!-- /.image-list -->
              </div>
            </aside>
            <!-- /column .sidebar -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
      </section>
    <!-- /section -->
    </div>
    </div>
    <!-- /.content-wrapper -->
@endsection
