@extends('layout_index.master')
@section('content')
<section class="wrapper bg-soft-primary">
    <img src="{{ asset('dev/img/photos/news.jpg') }}" width="100%" height="400px" alt="">
    <!-- /.container -->
</section>
<!-- /section -->
@if($subject->type_subject == 'Thẻ')
<section class="wrapper bg-light wrapper-border">
    <div class="container py-14 py-md-16">
        <div class="table-responsive p-0">
            <h3>Thẻ quà tặng</h3>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Loại</th>
                <th scope="col">Đơn hàng</th>
                <th scope="col">Số seri</th>
                <th scope="col">Mã thẻ</th>
              </tr>
            </thead>
            <tbody>
                @if(isset($subject))
              <tr>
                <td>{{$subject->type_subject}}</td>
                <td></td>
                @for($i=0 ; $i < count(json_decode($subject->subject)); $i++ )
                <td>{{ isset(explode('|', json_decode($subject->subject)[$i])[0]) ? explode('|', json_decode($subject->subject)[$i])[0] : '' }}</td>
                <td>{{ isset(explode('|', json_decode($subject->subject)[$i])[1]) ? explode('|', json_decode($subject->subject)[$i])[1] : '' }}</td>
                @endfor
              </tr>
              @endif
            </tbody>
          </table>
        </div>
    </div>
    <!-- /.container -->
</section>
@elseif($subject->type_subject == 'Mã giảm giá')
<section class="wrapper bg-light wrapper-border">
    <div class="container py-14 py-md-16">
        <div class="table-responsive p-0">
            <h3>Thẻ quà tặng</h3>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Loại</th>
                <th scope="col">Mã thẻ</th>
              </tr>
            </thead>
            <tbody>
                @if(isset($subject))
              <tr>
                <td>{{$subject->type_subject}}</td>
                <td>{{$subject->subject}}</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
    </div>
    <!-- /.container -->
</section>
@elseif($subject->type_subject == 'Mã nạp tiền')
<section class="wrapper bg-light wrapper-border">
    <div class="container py-14 py-md-16">
        <div class="table-responsive p-0">
            <h3>Thẻ quà tặng</h3>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Loại</th>
                <th scope="col">Mã thẻ</th>
              </tr>
            </thead>
            <tbody>
                @if(isset($subject))
              <tr>
                <td>{{$subject->type_subject}}</td>
                <td>{{$subject->subject}}</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
    </div>
    <!-- /.container -->
</section>
@endif
@endsection
@section('script')
@stop
