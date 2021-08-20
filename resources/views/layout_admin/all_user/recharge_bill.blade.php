@extends('layout_admin.master')
@section('content')
    <main class="main-content max-height-vh-100 h-100">
        <div class="container-fluid my-3 py-3">
            <div class="row">
                <div class="col-md-12 col-sm-12 mx-auto">
                    <form class="" action="index.html" method="post">
                        <div class="card my-sm-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-header pb-0">
                                            <h4>Tất cả đơn nạp tiền của {{ $user_info->name }}</h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-flush" id="datatable-basic">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Mã đơn hàng</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Khách hàng</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Số tiền</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Nội dung</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Ngày</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Trạng thái</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($recharge_bills)
                                                    @foreach($recharge_bills as $bill)
                                                    <tr>
                                                        <td class="align-middle text-center text-sm"><p class="text-xs font-weight-bold mb-0">{{ $bill->order_id }}</p></td>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div>
                                                                    @if($bill->user_bill->avatar_original)
                                                                        <img src="{{ $bill->user_bill->avatar_original }}" class="avatar avatar-sm me-3" alt="user1">
                                                                    @else
                                                                        <img src="{{ asset($bill->user_bill->avatar ? $bill->user_bill->avatar : 'dashboard/assets/img/no_img.jpg') }}" class="avatar avatar-sm me-3" alt="user1">
                                                                    @endif
                                                                </div>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">{{$bill->user_bill->name }}</h6>
                                                                    <p class="text-xs text-secondary mb-0">{{ $bill->user_bill->email }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <p class="text-xs font-weight-bold mb-0">{{ number_format($bill->point_purchase) }} VNĐ</p>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $bill->method }}</p>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">{{ date('d/m/Y', strtotime(str_replace('/', '-', $bill->created_at))) }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            @if($bill->status == 1)
                                                            <span class="badge badge-sm bg-gradient-success">Đã thanh toán</span>
                                                            @else
                                                            <span class="badge badge-sm bg-gradient-danger">Chưa thanh toán</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mt-md-0 mt-3">
                                        <button class="btn bg-gradient-info mt-lg-7 mb-0" onclick="window.print()" type="button" name="button">Print</button>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
@endsection
