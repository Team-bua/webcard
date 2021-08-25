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
                @if (session('information'))
                    <div class="alert alert-success"><b>{{ session('information') }}</b></div>
                @elseif (session('warning'))
                <div class="alert alert-warning"><b>{{ session('warning') }}</b></div>
                @endif
                <div class="card mb-4">
                    <form action="">
                        <div class="card-header pb-0">
                            <button type="submit" name="search" class="btn bg-gradient-primary mt-2 " style="float: right;margin-left:5px">
                                <i class="fa fa-search"></i></button>
                            <input class="form-control datepicker" id="date_picker" name="date" style="width: 20%; float: right; margin-top: 10px" placeholder="Please select date" type="text"
                            value="{{ date('d/m/Y', strtotime($first_day)) . ' to ' . date('d/m/Y', strtotime($last_day)) }}" >
                            <input type="text" name="name" class="form-control" placeholder="Mã đơn hàng" style="width: 20%; float: right; margin-top: 10px; margin-right: 5px" aria-describedby="basic-addon1">
                            <select class="form-control" name="status" style="width: 20%; float: right; margin-top: 10px; margin-right: 5px">
                                @if($status == 0)
                                    <option value="0" selected>Tất cả trạng thái </option>
                                    <option value="1">Chưa thanh toán</option>
                                    <option value="2" >Đã thanh toán</option>
                                @elseif($status == 2)
                                    <option value="0">Tất cả trạng thái </option>
                                    <option value="1">Chưa thanh toán</option>
                                    <option value="2" selected>Đã thanh toán</option>
                                @elseif($status == 1)
                                    <option value="0">Tất cả trạng thái </option>
                                    <option value="1" selected>Chưa thanh toán</option>
                                    <option value="2">Đã thanh toán</option>
                                @endif
                            </select>
                        </div>
                    </form>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <form action="{{ route('cardbill.update.status.all') }}" method="post" id="form_check">
                                @csrf
                                <input type="hidden" name="date_check" id="date_check">
                            </form>
                            <button class="btn bg-gradient-primary mt-4 w-12" id="btn_check" style="float: right;;margin-bottom:5px;margin-left:5px;">
                                <i class="fa fa-check">&nbsp; Duyệt tất cả đơn </i></button>
                            <table class="table table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>         
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Duyệt</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Xem</th>                               
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Thẻ</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Khách hàng</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Mã đơn hàng</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Đơn giá</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Số lượng</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Tổng tiền</th>                                        
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Trạng thái</th>                                        
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Xem</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Ngày</th>
                                        <th class="text-secondary"></th>
                                    </tr>  
                                </thead>                            
                                <tbody>
                                    @if($bills)
                                    @foreach($bills as $bill)
                                    <tr>      
                                        <td class="align-middle">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" onchange="updateStatus(this)" value="{{ $bill->id }}" type="checkbox" @if($bill->status == 1) checked disabled @endif>
                                            </div>
                                        </td>
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
                                                    <p class="text-xs text-secondary mb-0">{{ $bill->card_bill->card_type }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if($bill->user_card_bill->avatar_original)
                                                        <img src="{{ $bill->user_card_bill->avatar_original }}" class="avatar avatar-sm me-3" alt="user1">
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
                                        <td class="align-middle text-center text-sm"><p class="text-xs font-weight-bold mb-0">{{ $bill->order_id }}</p></td>
                                        <td class="align-middle text-center text-sm"><p class="text-xs font-weight-bold mb-0">{{ number_format($bill->card_price) }} VNĐ</p></td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ $bill->card_total }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ number_format($bill->price_total) }} VNĐ</p>
                                        </td>
                                        <td class="align-middle text-center text-sm" id="load{{ $bill->id }}">
                                            @if($bill->status == 1)
                                            <span class="badge badge-sm bg-gradient-success">Đã thanh toán</span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-danger">Chưa thanh toán</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalMessage{{ $bill->id }}"><i class="fa fa-eye" style="margin-top: 10px"></i></a>                             
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('H:i d/m/Y', strtotime(str_replace('/', '-', $bill->created_at))) }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" delete_id="{{ $bill->id }}" class="text-secondary font-weight-bold text-xs simpleConfirm" >
                                                <span class="badge bg-gradient-danger">Xóa</span>
                                            </a>
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
                        <form action="{{ route('cardbill.export') }}" method="post" id="form_export">
                            @csrf
                           <input type="hidden" name="date_export" id="date_export">
                        </form>
                        <div class="col-lg-4 mt-md-0 mt-3" style="margin-left: 20px">
                            <button class="btn bg-gradient-info mt-lg-7 mb-0" type="submit" name="button" id="btn_export">Xuất Excel</button>
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

    $('#btn_export').on('click', function(){ 
        $('#date_export').attr('value',$('#date_picker').val());
        $('#form_export').submit();
    })

    $('#btn_check').on('click', function(){ 
        $('#date_check').attr('value',$('#date_picker').val());
        $('#form_check').submit();
    })

    function updateStatus(el){
        if(el.checked){
            var status = 1;
            $(el).attr('disabled', true);
        }
        else{
            var status = 0;
        }    
        $.ajax({
            method: 'get',
            url: "{{ route('cardbill.update.status') }}",
            data: {
                _token:'{{ csrf_token() }}',
                id: el.value,
                status: status,
            },
            success: function(data) {
                if (data == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Duyệt thành công!',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $('#load'+el.value).html(`<span class="badge badge-sm bg-gradient-success">Đã thanh toán</span>`);
                }else if(data == 0){
                    Swal.fire({
                        icon: 'error',
                        title: 'Số thẻ còn lại trong kho không đủ để duyệt hoá đơn!',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        })
    }

    $(document).on('click', '.simpleConfirm', function(e) {
            e.preventDefault();
            var id = $(this).attr('delete_id');
            var that = $(this);
            swal.fire({
                title: "Bạn có muốn xóa hóa đơn này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa ngay!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'get',
                        url: "{{ route('cardbill.destroy') }}",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data.success == true) {
                                that.parent().parent().remove();
                                Swal.fire(
                                    'Xóa!',
                                    'Xóa thành công.',
                                    'success'
                                )
                            }
                        }
                    })
                }
            });
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