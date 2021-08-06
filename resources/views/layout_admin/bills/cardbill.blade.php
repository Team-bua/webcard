@extends('layout_admin.master')
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Hóa đơn</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Tất cả hóa đơn</h6>
            </nav>
            @include('layout_admin.info')
        </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <form action="">
                                <div class="card-header pb-0">
                                    <button type="submit" name="search" class="btn bg-gradient-primary mt-2 " style="float: right;margin-left:5px">
                                        <i class="fa fa-search"></i></button>
                                    <input class="form-control datepicker" name="date" style="width: 25%; float: right; margin-top: 10px" placeholder="Please select date" type="text"
                                    value="{{ date('d/m/Y', strtotime($first_day)) . ' to ' . date('d/m/Y', strtotime($last_day)) }}" >
                                </div>
                            </form>
                            <table class="table table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Thẻ</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Khách hàng</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Số lượng</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Giá</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($bills)
                                    @foreach($bills as $bill)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset($bill->card_bill->image) }}" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$bill->card_bill->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $bill->card_type }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if($bill->user_card_bill->avatar_original)
                                                        <img src="{{ asset($bill->user_card_bill->avatar_original) }}" class="avatar avatar-sm me-3" alt="user1">
                                                    @else
                                                        <img src="{{ asset($bill->user_card_bill->avatar ? $bill->user_card_bill->avatar : 'dashboard/assets/img/no_img.jpg') }}" class="avatar avatar-sm me-3" alt="user1">
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$bill->user_card_bill->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $bill->user_card_bill->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ $bill->card_total }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ $bill->card_price }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('d/m/Y', strtotime(str_replace('/', '-', $bill->created_at))) }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if($bill->status == 1)
                                            <span class="badge badge-sm bg-gradient-success">Đã thanh toán</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script src="{{ asset('dashboard/assets/js/plugins/datatables.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
        searchable: false,
        fixedHeight: true
    });
</script>
<script type="text/javascript">
    if (document.querySelector('.datepicker')) {
      flatpickr('.datepicker', {
        mode: "range",
        dateFormat: 'd/m/Y'
      });       
    }
  </script>
@endsection