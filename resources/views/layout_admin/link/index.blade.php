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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Link</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Tất cả link</h6>
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
                    @if (session('information'))
                    <div class="alert alert-success"><b>{{ session('information') }}</b></div>
                    @endif
                    <div class="card-header pb-0">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_link">
                            <button class="btn bg-gradient-primary mt-4 w-12" style="float: right;;margin-bottom:5px;margin-left:5px">
                                <i class="fa fa-plus">&nbsp; Thêm link </i></button>
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">          
                        <div class="table-responsive p-0">
                            <table class="table table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Loại thẻ</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Link</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Nội dung</th>
                                        <th class="text-secondary"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="#"><span class="badge bg-gradient-primary">Copy</span></a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"></span>
                                        </td>
                                        <td class="align-middle">
                                            <a data-bs-toggle="modal" data-bs-target="#edit_link" class="text-secondary font-weight-bold text-xs" >
                                                <span class="badge bg-gradient-info">Sửa</span>
                                            </a> ||
                                            <a href="javascript:;" delete_id="#" class="text-secondary font-weight-bold text-xs simpleConfirm" >
                                                <span class="badge bg-gradient-danger">Xóa</span>
                                            </a>
                                        </td>
                                    </tr> 
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit_link" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cập nhật link</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            </div> 
                                            <form action="#" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">               
                                                    <div class="form-group">       
                                                        <div class="form-group" style="width: 70%;">
                                                            <label class="form-control-label" for="basic-url">Loại thẻ</label>
                                                            <div class="input-group">
                                                                <select class="form-control" id="discount_type" name="discount_type" style="width: 200px;" required>
                                                                @if(isset($types))
                                                                    @foreach ($types as $type)
                                                                        <option id="{{ $type->id }}" value="{{ $type->name }}">{{ $type->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                </select>
                                                            </div>
                                                        </div> 
                                                        <div class="form-group" style="width: 70%;">
                                                            <label class="form-control-label" for="basic-url">Nội dung</label>
                                                            <textarea class="form-control" id="discount_code" name="discount_code" rows="3" ></textarea> <br>                        
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Addd Modal -->
    <div class="modal fade" id="add_link" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Thêm link</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div> 
            <form action="{{ route('link.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">               
                    <div class="form-group">       
                        <div class="form-group" style="width: 70%;">
                            <label class="form-control-label" for="basic-url">Loại thẻ</label>
                            <div class="input-group">
                                <select class="form-control" id="discount_type" name="discount_type" style="width: 200px;" required>
                                   @if(isset($types))
                                    @foreach ($types as $type)
                                        <option id="{{ $type->id }}" value="{{ $type->name }}">{{ $type->name }}</option>
                                    @endforeach
                                   @endif
                                </select>
                            </div>
                        </div> 
                        <div class="form-group" style="width: 70%;">
                            <label class="form-control-label" for="basic-url">Nội dung</label>
                            <textarea class="form-control" id="discount_code" name="discount_code" rows="3" ></textarea> <br>                        
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

    $(document).on('click', '.simpleConfirm', function(e) {
        e.preventDefault();
        var id = $(this).attr('delete_id');
        var that = $(this);
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
                    url: "{{ route('discount.destroy') }}",
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
                    url: "{{ route('discount.destroy.all') }}",
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