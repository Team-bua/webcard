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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Thương hiệu</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Cập nhật thương hiệu</h6>
            </nav>
            @include('layout_admin.info')
        </div>
        </div>
    </nav>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="content-wrapper" >

                            <!-- Main content -->
                            <section class="content">
                                <div class="box-header">
                                    @if (session('information'))
                                    <div class="alert alert-success"><b>{{ session('information') }}</b></div>
                                    @endif
                                </div>
                                <div class="box box-info">
                                    <form action="{{ route('brand.update', $sub_card_type->id) }}" method="post" enctype="multipart/form-data" id="form_data">
                                        @csrf
                                        @include('layout_admin.sub_card.template')
                                        <div class="text-center">
                                            <input type="submit" name="submit" id="submit" value="Cập nhật" class="btn bg-gradient-primary w-12 btnthem">
                                        </div>
                                    </form>
                                </div>
                            </section><!-- /.content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection