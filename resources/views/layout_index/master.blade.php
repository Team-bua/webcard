<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ asset('dev/img/favicon.png') }}">
  <title>Sandbox</title>
  <link rel="stylesheet" href="{{ asset('dev/css/plugins.css') }}">
  <link rel="stylesheet" href="{{ asset('dev/css/style.css') }}"> 
  <link rel="stylesheet" href="{{ asset('dev/css/colors/aqua.css') }}">
  <link rel="preload" href="{{ asset('dev/css/fonts/thicccboi.css') }}" as="style" onload="this.rel='stylesheet'">
</head>

<body>
  <div class="content-wrapper">
    @include('layout_index.header')
    @yield('content')
    @include('layout_index.footer')

  <div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
  </div>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
  <script src="{{ asset('dev/js/plugins.js') }}"></script>
  <script src="{{ asset('dev/js/theme.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      var msg = "{{Session::get('message')}}";
      var exist = "{{Session::has('message')}}";
      console.log(msg, exist);
      if (exist && msg == '1') {
          Swal.fire({
              icon: 'success',
              title: 'Đăng ký thành công!',
              showConfirmButton: false,
              timer: 2000
          })
        }else if(exist && msg == '2') {
          Swal.fire({
              icon: 'success',
              title: 'Đăng nhập thành công!',
              showConfirmButton: false,
              timer: 2000
          })
        }else if(exist && msg == '3') {
          Swal.fire({
              icon: 'error',
              title: 'Tài khoản không chính xác',
              showConfirmButton: false,
              timer: 2000
          })
        }else if(exist && msg == '4') {
            Swal.fire({
                icon: 'error',
                title: 'Tài khoản của bạn đã bị khóa!',
                showConfirmButton: false,
                timer: 2500
            })
        }
    })
  </script>
  @yield('script')
    
</body>

</html>