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
                            <div class="card-header pb-0">
                                <a href="{{ route('create-card') }}">
                                    <button class="btn bg-gradient-primary mt-4 w-12" style="float: right;;margin-bottom:5px;margin-left:5px;">
                                        <i class="fa fa-plus">&nbsp; Thêm thẻ </i></button>
                                </a>
                                <a href="{{ route('add-card-code') }}">
                                    <button class="btn bg-gradient-primary mt-4 w-12" style="float: right;;margin-bottom:5px;margin-left:5px">
                                        <i class="fa fa-plus">&nbsp; Thêm mã </i></button>
                                </a>
                            </div>
                            <table class="table table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Loại thẻ</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Giá</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Số lượng</th>
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
                                        <td>
                                            <ul>
                                                @for($i = 0; $i < count(json_decode($card->price)); $i++)
                                                    <li>
                                                        <p class="text-xs font-weight-bold mb-0">{{number_format(json_decode($card->price)[$i])}} VNĐ </p>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalMessage{{ $card->id }}"><span class="badge badge-sm bg-gradient-success" style="font-size: 12px;">{{ isset($arr[$card->name]) ? $arr[$card->name] : 0 }}</span></a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('d/m/Y', strtotime(str_replace('/', '-', $card->created_at))) }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('card_edit', $card->id) }}" class="text-secondary font-weight-bold text-xs">
                                                <span class="badge bg-gradient-info">Sửa</span>
                                            </a> || 
                                            <a href="javascript:;" delete_id="{{ $card->id }}" class="text-secondary font-weight-bold text-xs simpleConfirm" >
                                                <span class="badge bg-gradient-danger">Xóa</span>
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="col-md-4">
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalMessage{{ $card->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
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
                                                        @for($i = 0; $i < count(json_decode($card->price)); $i++)
                                                            <li>
                                                                <p class="text-xs font-weight-bold mb-0">{{number_format(json_decode($card->price)[$i])}} VNĐ: <span class="badge badge-sm bg-gradient-success" style="font-size: 12px;">{{ isset($arr_price[json_decode($card->price)[$i].'-'.$card->name]) ? $arr_price[json_decode($card->price)[$i].'-'.$card->name] : 0 }}</span> </p>
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
<script type="text/javascript">
    const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
        searchable: false,
        fixedHeight: true,
    });
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