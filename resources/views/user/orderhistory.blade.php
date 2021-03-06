@extends('layout_admin.master')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        @include('user.avatar')
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h4>Lịch sử mua hàng</h4>
                        </div>
                        <form action="">
                            <div class="card-header pb-0">
                                <button type="submit" name="search" class="btn bg-gradient-primary mt-2 " style="float: right;margin-left:5px">
                                    <i class="fa fa-search"></i></button>
                                <input class="form-control datepicker" name="date" style="width: 25%; float: right; margin-top: 10px" placeholder="Please select date" type="text"
                                value="{{ date('d/m/Y', strtotime($first_day)) . ' to ' . date('d/m/Y', strtotime($last_day)) }}" >
                                <input type="text" name="name" class="form-control" placeholder="Mã đơn hàng" style="width: 20%; float: right; margin-top: 10px; margin-right: 5px" aria-describedby="basic-addon1">
                            </div>
                        </form>
                        <div class="card-body px-0 pt-0 pb-2">                           
                            <div class="table-responsive p-0">
                                <table class="table table-flush" id="datatable-basic">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Xem</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Thẻ</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Mã đơn hàng</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Đơn giá</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Số lượng</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Tổng tiền</th>                                        
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Trạng thái</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Xem</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Mã giảm giá</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Khuyến mãi</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Ngày</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($bills)
                                        @foreach($bills as $bill)
                                        <tr>
                                            <td class="align-middle">
                                                <a href="{{ route('show.card_bill', $bill->id) }}" target="_blank" class="text-secondary font-weight-bold text-xs">
                                                    <span class="badge bg-gradient-info">Hóa đơn</span>
                                                </a>
                                            </td>
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
                                            <td><p class="text-xs font-weight-bold mb-0">{{ $bill->order_id }}</p></td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ number_format($bill->card_price) }} VNĐ</p>
                                            </td>      
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $bill->card_total }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ number_format($bill->price_total) }} VNĐ</p>
                                            </td>                                          
                                            <td class="align-middle text-center text-sm">
                                                @if($bill->status == 1)
                                                <span class="badge badge-sm bg-gradient-success">Đã giao</span>
                                                @else
                                                <span class="badge badge-sm bg-gradient-danger">Đang xử lý</span>
                                                @endif
                                            </td>
                                            <td >
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalMessage{{ $bill->id }}"><i class="fa fa-eye"  style="margin-top: 10px"></i></a>                             
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ isset($bill->discount_code) ? $bill->discount_code : '' }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ isset($bill->discount_info) ? $bill->discount_info : '' }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ date('d/m/Y', strtotime(str_replace('/', '-', $bill->created_at))) }}</span>
                                            </td>
                                        </tr>
                                        <div class="col-md-4">
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalMessage{{ $bill->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thông tin thẻ</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <form>
                                                      <div class="form-group"> 
                                                      <ul>
                                                        @for($i = 0; $i < count(json_decode($bill->card_info)); $i++)
                                                            <li>
                                                                <p class="text-xs font-weight-bold mb-0">{{json_decode($bill->card_info)[$i]}}</p>
                                                            </li>
                                                        @endfor
                                                    </ul>                                            
                                                      </div>
                                                    </form>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Đóng</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
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
<script>
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