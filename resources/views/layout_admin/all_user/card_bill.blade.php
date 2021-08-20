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
                                            <h4>Tất cả đơn hàng của {{ $user_info->name }}</h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-flush" id="datatable-basic">
                                                <thead class="thead-light">
                                                    <tr>                                        
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Thẻ</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Khách hàng</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Mã đơn hàng</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Số lượng</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Tổng tiền</th>                                        
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Trạng thái</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Xem</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Ngày</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($card_bills as $card_bill)
                                                    <tr>         
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div>
                                                                    <img src="{{ asset($card_bill->card_bill->image) }}" class="avatar avatar-sm me-3" alt="user1">
                                                                </div>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">{{$card_bill->card_bill->name }}</h6>
                                                                    <p class="text-xs text-secondary mb-0">{{ $card_bill->card_type }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div>
                                                                    @if($card_bill->user_card_bill->avatar_original)
                                                                        <img src="{{ $card_bill->user_card_bill->avatar_original }}" class="avatar avatar-sm me-3" alt="user1">
                                                                    @else
                                                                        <img src="{{ asset($card_bill->user_card_bill->avatar ? $card_bill->user_card_bill->avatar : 'dashboard/assets/img/no_img.jpg') }}" class="avatar avatar-sm me-3" alt="user1">
                                                                    @endif
                                                                </div>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">{{$card_bill->user_card_bill->name }}</h6>
                                                                    <p class="text-xs text-secondary mb-0">{{ $card_bill->user_card_bill->email }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm"><p class="text-xs font-weight-bold mb-0">{{ $card_bill->order_id }}</p></td>
                                                        <td class="align-middle text-center text-sm">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $card_bill->card_total }}</p>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <p class="text-xs font-weight-bold mb-0">{{ number_format($card_bill->price_total) }} VNĐ</p>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            @if($card_bill->status == 1)
                                                            <span class="badge badge-sm bg-gradient-success">Đã thanh toán</span>
                                                            @else
                                                            <span class="badge badge-sm bg-gradient-danger">Chưa thanh toán</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalMessage{{ $card_bill->id }}"><i class="fa fa-eye" style="margin-top: 10px"></i></a>                             
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">{{ date('d/m/Y', strtotime(str_replace('/', '-', $card_bill->created_at))) }}</span>
                                                        </td>
                                                    </tr>
                                                    <div class="col-md-4">
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalMessage{{ $card_bill->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
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
                                                                        @for($i = 0; $i < count(json_decode($card_bill->card_info)); $i++)
                                                                            <li>
                                                                                <p class="text-xs font-weight-bold mb-0">{{json_decode($card_bill->card_info)[$i]}}</p>
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
