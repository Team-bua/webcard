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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Mã nạp</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Tất cả mã nạp tiền</h6>
            </nav>
            @include('layout_admin.info')
        </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Tổng số mã chưa sử dụng</p>
                                    <h5 class="font-weight-bolder mb-0">
                                       {{ $not_use }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-credit-card text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Tổng số mã đã sử dụng</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $used }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-credit-card text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    @if (session('information'))
                    <div class="alert alert-success"><b>{{ session('information') }}</b></div>
                    @endif
                    <div class="card-header pb-0">
                        <a href="#" class="delete_all">
                            <button class="btn bg-gradient-danger mt-4 w-12" style="float: right;;margin-bottom:5px;margin-left:5px">
                                <i class="fa fa-trash">&nbsp; Xóa all </i></button>
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_code">
                            <button class="btn bg-gradient-primary mt-4 w-12" style="float: right;;margin-bottom:5px;margin-left:5px">
                                <i class="fa fa-plus">&nbsp; Thêm mã </i></button>
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                       
                            <table class="table table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Mã nạp tiền</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Giá nạp</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Trạng thái</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Ngày sử dụng</th>
                                        <th class="text-secondary"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($recharge_code))
                                    @foreach ($recharge_code as $recharge)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $recharge->code }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold" style="font-size: 12px;">{{ number_format($recharge->price) }} VNĐ</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if($recharge->status == 0)
                                                <span class="badge badge-sm bg-gradient-success">Chưa sử dụng</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">Đã sử dụng</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($recharge->created_at != $recharge->updated_at)
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('H:i d/m/Y', strtotime(str_replace('/', '-', $recharge->updated_at))) }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            {{-- <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#edit_code{{ $recharge->id }}">
                                                <span class="badge bg-gradient-info">Sửa</span>
                                            </a> ||  --}}
                                            <a href="javascript:;" delete_id="{{ $recharge->id }}" class="text-secondary font-weight-bold text-xs simpleConfirm" >
                                                <span class="badge bg-gradient-danger">Xóa</span>
                                            </a>
                                        </td>
                                    </tr>
                                  <!-- <div class="col-md-4">
                                        
                                        <div class="modal fade" id="edit_code" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cập nhật mã nạp tiền</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">×</span>
                                                </button>
                                              </div>
                                              <form action="#" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">               
                                                    <div class="form-group">       
                                                        <div class="form-group" style="width: 70%;">
                                                            <label class="form-control-label" for="basic-url">Giá</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
                                                                <input type="number" class="form-control" id="price_edit" name="price_edit" min="0"  maxlength="150" required>
                                                                <span class="input-group-text">VNĐ</span>
                                                            </div>
                                                        </div>    
                                                        <div class="form-group" style="width: 70%;">
                                                            <label class="form-control-label" for="basic-url">Mã nạp tiền</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                                                <input type="text" class="form-control" id="recharge_edit_code" name="recharge_edit_code" value="" maxlength="150" required>                            
                                                            </div>
                                                            <button type="button" class="btn bg-gradient-info" id="btn_edit_code">Tạo mã</button>
                                                        </div>                           
                                                    </div>       
                                                </div>
                                                <div class="modal-footer">
                                                <button type="submit" class="btn bg-gradient-secondary">Cập nhật</button>
                                                </div>
                                            </form>
                                            </div>
                                          </div>
                                        </div>
                                    </div>                                    -->
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
     <!-- Addd Modal -->
     <div class="modal fade" id="add_code" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Thêm mã nạp tiền</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div> 
            <form action="{{ route('rechargecode.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">               
                    <div class="form-group">       
                        <div class="form-group" style="width: 70%;">
                            <label class="form-control-label" for="basic-url">Giá</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
                                <input type="number" class="form-control" id="price" name="price" min="0" maxlength="150" required>
                                <span class="input-group-text" id="show_add">VNĐ</span>
                            </div>
                        </div>    
                        <div class="form-group" style="width: 70%;">
                            <label class="form-control-label" for="basic-url">Mã nạp tiền</label>
                            <textarea class="form-control" id="recharge_code" name="recharge_code" rows="3" ></textarea> <br>                        
                            <button type="button" class="btn bg-gradient-info" id="btn_code">Tạo mã</button>
                        </div>                           
                    </div>       
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn bg-gradient-secondary">Thêm</button>
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
      searchable: true,
      fixedHeight: true
    });

    // function updateStatus(el){
    //     if(el.checked){
    //         var status = 0;
    //     }
    //     else{
    //         var status = 1;
    //     }
    //     $.ajax({
    //         method: 'get',
    //         url: "#",
    //         data: {
    //             _token:'{{ csrf_token() }}',
    //             id: el.value,
    //             status: status,
    //         },
    //         success: function(data) {
    //             if (data == 1) {
    //                 Swal.fire({
    //                     icon: 'success',
    //                     title: 'Kích hoạt thành công!',
    //                     showConfirmButton: false,
    //                     timer: 2000
    //                 })
    //             }
    //         }
    //     })
    // }

    $('#btn_code').on('click', function(){
        let r = (Math.random() + 1).toString(36).substring(2, 20);
        $('#recharge_code').attr('value', r);
    })

    $(document).on('click', '.simpleConfirm', function(e) {
        e.preventDefault();
        var id = $(this).attr('delete_id');
        swal.fire({
            title: "Bạn có muốn xóa mã này?",
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
                    url: "{{ route('rechargecode.destroy') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.success == true) {
                            Swal.fire(
                                'Xóa!',
                                'Xóa thành công.',
                                'success'
                            )
                            window.location.reload();
                        }
                    }
                })
            }
        });
    });

    $(document).on('click', '.delete_all', function(e) {
        e.preventDefault();
        swal.fire({
            title: "Bạn có muốn xóa tất cả mã đã sử dụng không?",
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
                    url: "{{ route('rechargecode.destroy.all') }}",
                    success: function(data) {
                        if (data.success == true) {
                            Swal.fire(
                                'Xóa!',
                                'Xóa thành công.',
                                'success'
                            )
                            window.location.reload();
                        }
                    }
                })
            }
        });
    })
</script>
@endsection