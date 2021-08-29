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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Nội dung</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Link</th>
                                        <th class="text-secondary"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(isset($subject_links))
                                    @foreach($subject_links as $subject)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ isset($subject->type_subject) ?  $subject->type_subject : ''}}</span>
                                        </td>

                                        <td class="align-middle text-center">

                                        
                                            <span class="text-secondary text-xs font-weight-bold">{{ isset($subject->subject) ?  $subject->subject : ''}}</span>
                                     
                                        </td>
                                        <td class="align-middle text-center">
                                            <input type="hidden" id="subject_{{ $subject->id }}" value="{{ route('link.subject', $subject->link_subject) }}">
                                            <a href="javascript:" onclick="copyToClipboard('#subject_{{ $subject->id }}')"><span class="badge bg-gradient-primary">Copy</span></a>
                                        </td>
                                        <td class="align-middle">
                                            <!-- <a data-bs-toggle="modal" data-bs-target="#edit_link" class="text-secondary font-weight-bold text-xs" >
                                                <span class="badge bg-gradient-info">Sửa</span>
                                            </a> || -->
                                            <a href="javascript:;" delete_id="{{ $subject->id }}" class="text-secondary font-weight-bold text-xs simpleConfirm">
                                                <span class="badge bg-gradient-danger">Xóa</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('link.export') }}" method="post" id="form_export">
                            @csrf
                            <div class="col-lg-4 mt-md-0 mt-3" style="margin-left: 20px">
                                <button class="btn bg-gradient-info mt-lg-7 mb-0" type="submit" name="button" id="btn_export">Xuất Excel</button>
                            </div>
                        </form>
                       
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
                                <select class="form-control" id="subject_type" name="subject_type" style="width: 200px;" required>
                                    @if(isset($subject_types))
                                    @foreach ($subject_types as $type)
                                    <option id="{{ $type->id }}" value="{{ $type->name }}">{{ $type->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group" style="width: 70%; display: none" id="type_discount">
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
                        <div class="form-group" style="width: 70%; display: none" id="discount">
                            <label class="form-control-label" for="basic-url">Giá</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
                                <input type="number" class="form-control" id="discount" name="discount" min="0" maxlength="150" >
                                <span class="input-group-text" id="show_add">VNĐ</span>
                            </div>
                        </div>    
                        <div class="form-group" style="width: 70%;">
                            <label class="form-control-label" for="basic-url">Nội dung</label>
                            <textarea class="form-control" id="subject" name="subject" rows="3"></textarea> <br>
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

    $('#subject_type').on('change', function() {
       if(this.value == 'Thẻ' || this.value == 'Voucher'){
           $('#type_discount').attr('style', 'display: none');
           $('#discount').attr('style', 'display: none');
       }else if(this.value == 'Mã giảm giá'){
           $('#type_discount').attr('style', 'width: 70%;');
           $('#discount').attr('style', 'width: 70%;');
       }else if(this.value == 'Mã nạp tiền'){
           $('#type_discount').attr('style', 'display: none');
           $('#discount').attr('style', 'width: 70%;');
           $('#show_add').html('VNĐ');
       }
        
    });

    $('#discount_type').on('change', function() {
       if(this.value == 'Cố định'){
           $('#show_add').html('VNĐ');
       }else if(this.value == 'Phần trăm'){
           $('#show_add').html('%');
       }
        
    });

    function copyToClipboard(element) {
        var link_subject = $(element).val();
        navigator.clipboard.writeText(link_subject);

        Swal.fire({
            icon: 'success',
            title: 'Copy link thành công!',
            showConfirmButton: false,
            timer: 2000
        })
        // var $temp = $("<input>");
        // $("body").append($temp);
        // $temp.val($(element).text()).select();
        // document.execCommand("copy");
        // $temp.remove();
    }

    $(document).on('click', '.simpleConfirm', function(e) {
        e.preventDefault();
        var id = $(this).attr('delete_id');
        var that = $(this);
        swal.fire({
            title: "Bạn có muốn link mã này?",
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
                    url: "{{ route('link.destroy') }}",
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
                                title: 'Oops, lỗi sever!',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    }
                })
            }
        });
    });

    // $(document).on('click', '.delete_all', function(e) {
    //     e.preventDefault();
    //     swal.fire({
    //         title: "Bạn có muốn xóa tất cả mã đã sử dụng không?",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Xóa ngay!',
    //         cancelButtonText: 'Hủy'
    //     }).then((result) => {
    //         if (result.value) {
    //             $.ajax({
    //                 method: 'get',
    //                 url: "{{ route('discount.destroy.all') }}",
    //                 success: function(data) {
    //                     if (data.success == true) {
    //                         Swal.fire(
    //                             'Xóa!',
    //                             'Xóa thành công.',
    //                             'success'
    //                         )
    //                         window.location.reload();
    //                     }
    //                 }
    //             })
    //         }
    //     });
    // })
</script>
@endsection