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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Mã giảm giá</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Tất cả mã giảm giá</h6>
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
                            @if (session('information'))
                            <div class="alert alert-success"><b>{{ session('information') }}</b></div>
                            @endif
                        <div class="table-responsive p-0">
                            <div class="card-header pb-0">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#add_code">
                                    <button class="btn bg-gradient-primary mt-4 w-12" style="float: right;;margin-bottom:5px;margin-left:5px">
                                        <i class="fa fa-plus">&nbsp; Thêm mã </i></button>
                                </a>
                            </div>
                            <table class="table table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Loại giảm giá</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Mã giảm giá</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Giảm giá</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Trạng thái</th>
                                        <th class="text-secondary"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($discount))
                                    @foreach($discount as $discounts)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $discounts->discount_type }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $discounts->code }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold" style="font-size: 12px;">{{ number_format($discounts->price) }}
                                            @if($discounts->discount_type == 'Cố định')
                                                VNĐ
                                            @elseif($discounts->discount_type == 'Phần trăm')
                                                %
                                            @endif
                                        </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <center>
                                            <div class="form-switch">
                                                <input onchange="update_approved(this)" class="form-check-input" type="checkbox" checked="">
                                            </div>   
                                            </center> 
                                        </td>
                                        <td class="align-middle">
                                            <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#edit_code{{ $discounts->id }}">
                                                <span class="badge bg-gradient-info">Sửa</span>
                                            </a> || 
                                            <a href="javascript:;" delete_id="" class="text-secondary font-weight-bold text-xs simpleConfirm" >
                                                <span class="badge bg-gradient-danger">Xóa</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <div class="col-md-4">
                                        <!-- Modal -->
                                        <div class="modal fade" id="edit_code{{ $discounts->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cập nhật mã giảm giá</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">×</span>
                                                </button>
                                              </div>
                                              <form action="{{ route('discount.update', $discounts->id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="text" id="discount_id" value="{{ $discounts->id }}">
                                                <div class="modal-body">               
                                                    <div class="form-group">       
                                                        <div class="form-group" style="width: 70%;">
                                                            <label class="form-control-label" for="basic-url">Loại giảm giá</label>
                                                            <div class="input-group">
                                                                <select class="form-control select-discount" id="discount_type_edit{{ $discounts->id }}" name="discount_type_edit" style="width: 200px;" required>
                                                                    @foreach ($types as $type)
                                                                    @if($type == $discounts->discount_type)
                                                                        <option selected>{{ $discounts->discount_type }}</option>
                                                                    @else
                                                                        <option id="{{ $type->id }}" value="{{ $type->name }}">{{ $type->name }}</option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div> 
                                                        <div class="form-group" style="width: 70%;">
                                                            <label class="form-control-label" for="basic-url">Giảm giá</label>
                                                            <div class="input-group">
                                                                <input type="text" id="edit_discount" value="{{ $discounts->price }}">
                                                                <input type="text" id="edit_type_discount" value="{{ $discounts->discount_type }}">
                                                                <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
                                                                <input type="number" class="form-control" id="discount_edit" name="discount_edit" min="0" value="{{ $discounts->price }}" maxlength="150" required>
                                                                <span class="input-group-text" id="show_edit">VNĐ</span>
                                                            </div>
                                                        </div>    
                                                        <div class="form-group" style="width: 70%;">
                                                            <label class="form-control-label" for="basic-url">Mã giảm giá</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                                                <input type="text" class="form-control" id="discount_edit_code" name="discount_edit_code" value="" maxlength="150" required>                            
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
     <!-- Addd Modal -->
     <div class="modal fade" id="add_code" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Thêm mã giảm giá</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div> 
            <form action="{{ route('discount.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">               
                    <div class="form-group">       
                        <div class="form-group" style="width: 70%;">
                            <label class="form-control-label" for="basic-url">Loại giảm giá</label>
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
                            <label class="form-control-label" for="basic-url">Giảm giá</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
                                <input type="number" class="form-control" id="discount" name="discount" min="0" maxlength="150" required>
                                <span class="input-group-text" id="show_add">VNĐ</span>
                            </div>
                        </div>    
                        <div class="form-group" style="width: 70%;">
                            <label class="form-control-label" for="basic-url">Mã giảm giá</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                <input type="text" class="form-control" id="discount_code" name="discount_code" value="" maxlength="150" required>                            
                            </div>
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
      searchable: false,
      fixedHeight: true
    });

    $('#discount_type').on('change', function() {
       if(this.value == 'Cố định'){
           $('#show_add').html('VNĐ');
       }else if(this.value == 'Phần trăm'){
           $('#show_add').html('%');
       }
        
    });

    $('.select-discount').on('click', function() { 
        var id = $('#discount_id').val();
        $('#discount_type_edit'+id).on('change', function(){
            var discount = $('#edit_discount').val(); 
            var type_discount = $('#edit_type_discount').val();
            if(type_discount != this.value){
                $('#discount_edit').attr('value', 0);
            }else{
                $('#discount_edit').attr('value', discount);
            }
            if(this.value == 'Cố định'){
                $('#show_edit').html('VNĐ');
            }else if(this.value == 'Phần trăm'){
                $('#show_edit').html('%');
            }
        })       
    });

    $('#btn_code').on('click', function(){
        let r = (Math.random() + 1).toString(36).substring(2, 20).toUpperCase();
        $('#discount_code').attr('value', r);
    })

    $('#btn_edit_code').on('click', function(){
        let r = (Math.random() + 1).toString(36).substring(2, 20).toUpperCase();
        $('#discount_edit_code').attr('value', r);
    })

    $(document).on('click', '.simpleConfirm', function(e) {
        e.preventDefault();
        var id = $(this).attr('delete_id');
        var that = $(this);
        swal.fire({
            title: "Bạn có muốn xóa thẻ này?",
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
                    url: "{{ route('destroy') }}",
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
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Mã thẻ vẫn còn tồn tại!',
                            })
                        }
                    }
                })
            }
        });
    });
</script>
@endsection