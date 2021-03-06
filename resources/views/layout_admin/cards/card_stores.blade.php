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

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Loại thẻ</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Giá</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">ID thẻ</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Mã thẻ</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Trạng thái</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Ngày sử dụng</th>
                                        <th class="text-secondary"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($card_stores)
                                    @foreach($card_stores as $card)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset($card_image->image) }}" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ ucwords($card->name) }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <p class="text-xs font-weight-bold mb-0">{{number_format($card->price)}} VNĐ </p>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ $card->seri_number }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ $card->code }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if($card->status == 1)
                                            <span class="badge badge-sm bg-gradient-danger">Đã sử dụng</span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-success">Chưa sử dụng</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if($card->date_used != null)
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('H:i d/m/Y', strtotime(str_replace('/', '-', ($card->date_used)))) }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('card.store.edit', $card->id) }}" class="text-secondary font-weight-bold text-xs">
                                                <span class="badge bg-gradient-info">Sửa</span>
                                            </a> ||
                                            <a href="javascript:;" delete_id="{{ $card->id }}" class="text-secondary font-weight-bold text-xs simpleConfirm">
                                                <span class="badge bg-gradient-danger">Xóa</span>
                                            </a>
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
                    url: "{{ route('destroy.card.store') }}",
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