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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Đối tác</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Tất cả đối tác</h6>
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
                                <a href="{{ route('news.create') }}">
                                    <button class="btn bg-gradient-primary mt-4 w-12" style="float: right;;margin-bottom:5px;margin-left:5px;">
                                        <i class="fa fa-plus">&nbsp; Thêm tin tức </i></button>
                                </a>
                            </div>
                            <table class="table table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Avatar</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Thumbnail</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Tiêu đề</th>
                                        <th class="text-secondary"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($news))
                                    @foreach($news as $new)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <img width="150px" height="80" src="{{ asset( $new->avatar ? $new->avatar : 'dashboard/assets/img/no_img.jpg') }}">
                                        </td>
                                        <td class="align-middle text-center">
                                            <img width="150px" height="80" src="{{ asset( $new->thumbnail ? $new->thumbnail : 'dashboard/assets/img/no_img.jpg') }}">
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">{{ $new->tittle }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('news.edit', $new->id) }}" class="text-secondary font-weight-bold text-xs">
                                                <span class="badge bg-gradient-info">Sửa</span>
                                            </a> || 
                                            <a href="javascript:;" delete_id="{{ $new->id }}" class="text-secondary font-weight-bold text-xs simpleConfirm" >
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
      searchable: false,
      fixedHeight: true
    });
    
    $(document).on('click', '.simpleConfirm', function(e) {
            e.preventDefault();
            var id = $(this).attr('delete_id');
            var that = $(this);
            swal.fire({
                title: "Bạn có muốn xóa tin tức này?",
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
                        url: "{{ route('news.destroy') }}",
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
@endsection