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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Mã thẻ</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Cập nhật mã thẻ</h6>
            </nav>
            @include('layout_admin.info')
        </div>
        </div>
    </nav>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="content-wrapper">

                            <!-- Main content -->
                            <section class="content">
                                <div class="box-header">
                                    @if (session('information'))
                                    <div class="alert alert-success"><b>{{ session('information') }}</b></div>
                                    @endif
                                </div>
                                <div class="box box-info">
                                    <form action="{{ route('card.store.update', $card_store->id) }}" method="post" enctype="multipart/form-data" id="form_data">
                                        @csrf
                                        <div class="card-body p-3">
                                            <div class="form-group" style="width: 70%;">
                                                <label class="form-control-label" for="basic-url">Tên thẻ</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
                                                    <input type="text" class="form-control" id="name_card" name="name_card" aria-describedby="basic-addon3" maxlength="150" value="{{ isset($card_store) ? $card_store->name : '' }}">
                                                </div>
                                                @error('name_card')
                                                <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="card-body p-3">
                                            <div class="form-group" style="width: 70%;">
                                                <label class="form-control-label" for="basic-url">Giá thẻ</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
                                                    <input type="text" class="form-control" id="price_card" name="price_card" aria-describedby="basic-addon3" maxlength="150" value="{{ isset($card_store) ? $card_store->price : '' }}">
                                                </div>
                                                @error('price_card')
                                                <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="card-body p-3">
                                            <div class="form-group" style="width: 70%;">
                                                <label class="form-control-label" for="basic-url">ID thẻ</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
                                                    <input type="text" class="form-control" id="id_card" name="id_card" aria-describedby="basic-addon3" maxlength="150" value="{{ isset($card_store) ? $card_store->seri_number : '' }}">
                                                </div>
                                                @error('id_card')
                                                <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="card-body p-3">
                                            <div class="form-group" style="width: 70%;">
                                                <label class="form-control-label" for="basic-url">Mã thẻ</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
                                                    <input type="text" class="form-control" id="code_card" name="code_card" aria-describedby="basic-addon3" maxlength="150" value="{{ isset($card_store) ? $card_store->code : '' }}">
                                                </div>
                                                @error('code_card')
                                                <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                </div>
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
@section('script')
<script type="text/javascript">
</script>
@stop