@extends('layout_admin.master')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Thẻ</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Tất cả người dùng</h6>
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
                                @if (session('information'))
                                    <div class="alert alert-success">{{ session('information') }}</div>
                                @endif
                                <table class="table table-flush" id="datatable-basic">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Ảnh & Tên & email</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Số điện thoại</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Số dư</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Khóa user</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($users))
                                        @foreach ($users as $user)                                                                              
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if($user->avatar_orginal)
                                                        <img src="{{ asset($user->avatar_orginal) }}" class="avatar avatar-sm me-3" alt="user1">
                                                        @else
                                                        <img src="{{ asset($user->avatar ? $user->avatar : 'dashboard/assets/img/no_img.jpg') }}" class="avatar avatar-sm me-3" alt="user1">
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->phone }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ number_format($user->point) }} VNĐ</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if($user->banned_status == 0)
                                                    <a href="{{ route('users.banned', $user->id ) }}"><span class="badge badge-sm bg-gradient-danger">Khóa</span></a>
                                                @else
                                                <a href="{{ route('users.unbanned', $user->id ) }}"><span class="badge badge-sm bg-gradient-success">Mở</span></a>
                                                @endif
                                            </td>
                                            {{-- <td class="align-middle">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Edit
                                                </a>
                                            </td> --}}
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
    fixedHeight: true,
  });
</script>
@endsection