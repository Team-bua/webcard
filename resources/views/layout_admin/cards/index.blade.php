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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Thẻ</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Tất cả thẻ</h6>
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
                    <div class="card-header pb-0">
                        @if (session('information'))
                        <div class="alert alert-success"><b>{{ session('information') }}</b></div>
                        @endif
                        <a href="{{ route('create-card') }}">
                            <button class="btn bg-gradient-primary mt-4 w-12" style="float: right;;margin-bottom:5px;margin-left:5px;">
                                <i class="fa fa-plus">&nbsp; Thêm thẻ </i></button>
                        </a>
                        {{-- <a href="{{ route('add-card-code') }}">
                            <button class="btn bg-gradient-primary mt-4 w-12" style="float: right;;margin-bottom:5px;margin-left:5px">
                                <i class="fa fa-plus">&nbsp; Thêm mã </i></button>
                        </a> --}}
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        
                        <div class="table-responsive p-0">
                            <table class="table table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Loại thẻ</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Thương hiệu</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Giá</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Thêm mã</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Chi tiết kho thẻ</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Ngày</th>
                                        <th class="text-secondary"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($cards)
                                    @foreach($cards as $card)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset($card->image) }}" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $card->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $card->card_type }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $card->sub_card_type->name }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <ul style="list-style-type: none; padding: 0; margin: 0;">
                                                @for($i = 0; $i < count(json_decode($card->price)); $i++)
                                                    <li  style="margin-bottom:5px">
                                                        <p class="text-xs font-weight-bold mb-0">{{number_format(json_decode($card->price)[$i])}} VNĐ &nbsp; <span class="badge badge-sm bg-gradient-success" style="font-size: 12px;">{{ isset($arr_price_use[json_decode($card->price)[$i].'-'.$card->name.'-0']) ? $arr_price_use[json_decode($card->price)[$i].'-'.$card->name.'-0'] : 0 }}</span>&nbsp; <span class="badge badge-sm bg-gradient-danger" style="font-size: 12px;">{{ isset($arr_price_used[json_decode($card->price)[$i].'-'.$card->name.'-1']) ? $arr_price_used[json_decode($card->price)[$i].'-'.$card->name.'-1'] : 0 }}</span></p>
                                                    </li>
                                                    @endfor
                                            </ul>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <ul style="list-style-type: none; padding: 0; margin: 0;">
                                                @for($i = 0; $i < count(json_decode($card->price)); $i++)
                                                    <li  style="margin-bottom:5px">
                                                        <p class="text-xs font-weight-bold mb-0"><a href="javascript:" onclick="myclick('{{number_format(json_decode($card->price)[$i])}}', '{{ $card->name }}', '{{ $card->card_type }}')"><span class="badge badge-sm bg-gradient-success" style="font-size: 12px;"><i class="fa fa-plus"></i></span></a></p>
                                                    </li>
                                                    @endfor
                                            </ul>
                                        </td>
                                        <td>
                                            <ul style="list-style-type: none; padding: 0; margin: 0;">
                                                @for($i = 0; $i < count(json_decode($card->price)); $i++)
                                                    <li  style="margin-bottom:5px">
                                                        <a href="{{ route('view.cards.stores', [$card->name, json_decode($card->price)[$i]]) }}"><i class="fa fa-eye" style="margin-left: 45%;"></i></a>
                                                    </li>
                                                    @endfor
                                            </ul>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('d/m/Y', strtotime(str_replace('/', '-', $card->created_at))) }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('card_edit', $card->id) }}" class="text-secondary font-weight-bold text-xs">
                                                <span class="badge bg-gradient-info">Sửa</span>
                                            </a> ||
                                            <a href="javascript:;" delete_id="{{ $card->id }}" class="text-secondary font-weight-bold text-xs simpleConfirm">
                                                <span class="badge bg-gradient-danger">Xóa</span>
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="col-md-4">
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thêm mã thẻ</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('card-code-save') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1">Tên thẻ</label>
                                                                <input class="form-control" id="card_name_modal" name="code" rows="3" disabled>
                                                                <input type="hidden" class="form-control" id="card_name_form" name="card_name_form" rows="3">
                                                                <input type="hidden" class="form-control" id="card_type_form" name="card_type_form" rows="3">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1">Giá thẻ</label>
                                                                <input class="form-control" id="card_price_modal" name="code" rows="3" disabled>
                                                                <input type="hidden" class="form-control" id="card_price_form" name="card_price_form" rows="3">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1">Mã thẻ(ID|MãThẻ hoặc MãVoucher)</label>
                                                                <textarea class="form-control" id="code" name="code" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn bg-gradient-success" data-bs-dismiss="modal">Thêm</button>
                                                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Đóng</button>
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
</main>
@endsection
@section('script')
<script src="{{ asset('dashboard/assets/js/plugins/datatables.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
        searchable: true,
        fixedHeight: true
    });

    function myclick(price, name, type) {
        $('#card_name_modal').attr('value', name);
        $('#card_name_form').attr('value', name);
        $('#card_type_form').attr('value', type);
        $('#card_price_modal').attr('value', price);
        $('#card_price_form').attr('value', price);
        $('#exampleModalMessage').modal('show');
    }

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