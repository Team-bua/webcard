
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('dashboard/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('dashboard/assets/img/favicon.png') }}">
    <title>Hóa đơn #{{ $recharge_bill->order_id }}</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('dashboard/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="{{ asset('dashboard/assets/js/plugins/42d5adcbca.js') }}" crossorigin="anonymous"></script>
    <link href="{{ asset('dashboard/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('dashboard/assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/soft-ui-dashboard2.min.css?v=1.0.0') }}">
  <style>
    .async-hide {
      opacity: 0 !important
    }
  </style>
  <!-- End Google Tag Manager -->
</head>

<body class="g-sidenav-show bg-gray-100">
  <main class="main-content max-height-vh-100 h-100">
    <div class="container-fluid my-3 py-3">
      <div class="row">
        <div class="col-md-8 col-sm-10 mx-auto">
          <form class="" action="index.html" method="post">
            <div class="card my-sm-5">
              <div class="card-header">
                <div class="row justify-content-between">
                  <div class="col-md-5 text-start">
                    <img src="{{ asset(json_decode($index->image_logo)[0]) }}" width="{{ json_decode($index->image_logo)[1] }}px" height="{{ json_decode($index->image_logo)[2] }}px" alt="" alt="Logo">
                  <h6>{{ $index->address_contact }}</h6>
                    <p class="d-block text-secondary"><i class="fa fa-phone-volume"></i>: {{ $index->phone_contact }}</p>
                  </div>
                  <div class="col-md-5 text-md-end text-start mt-5">
                    <h6 class="d-block mt-2 mb-0">Người nạp: {{ $user_info->name }}</h6>
                    <p class="text-secondary"><i class="fa fa-phone-volume"></i>: {{ $user_info->phone }}</p></p>
                  </div>
                </div>
                <div class="row justify-content-md-between">
                  <div class="col-md-4 mt-auto">
                    <h6 class="mb-0 text-start text-secondary">Hóa đơn</h6>
                    <h5 class="text-start mb-0">#{{ $recharge_bill->order_id }}</h5>
                  </div>
                  <div class="col-lg-5 col-md-7 mt-auto">
                    <div class="row mt-md-5 mt-4 text-md-end text-start">
                      <div class="col-md-6">
                        <h6 class="text-secondary mb-0">Ngày nạp:</h6>
                      </div>
                      <div class="col-md-6">
                        <h6 class="text-dark mb-0">{{ date('d/m/Y', strtotime(str_replace('/', '-', $recharge_bill->created_at))) }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="table text-right">
                        <thead class="bg-default">
                          <tr>
                            <th scope="col" class="pe-6 text-start ps-4" colspan="6">Số tiền</th>
                            <th scope="col" class="pe-4" colspan="4">Nội dung</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="ps-4" colspan="6">{{ number_format($recharge_bill->point_purchase) }} VNĐ</td>
                            <td class="ps-4" colspan="4">{{ $recharge_bill->description }}</td>
                          </tr>                             
                        </tbody>
                        <tfoot>
                          <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="h5 ps-4" colspan="4">Tổng tiền</th>
                            <th class="text-right h5 ps-4">{{ number_format($recharge_bill->point_purchase ) }} VNĐ</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer mt-md-5">
                <div class="row">           
                  <div class="col-lg-5 mt-md-0">
                    <button class="btn bg-gradient-info mb-0" onClick="window.print()" type="button" name="button">Xuất</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <script src="{{ asset('dashboard/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/jquery.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/flatpickr.min.js') }}" type="text/javascript"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>