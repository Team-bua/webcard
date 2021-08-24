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
                <h6 class="font-weight-bolder mb-0">Cập nhật Thẻ</h6>
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
                        <div class="content-wrapper" >

                            <!-- Main content -->
                            <section class="content">
                                <div class="box-header">
                                    @if (session('information'))
                                    <div class="alert alert-success"><b>{{ session('information') }}</b></div>
                                    @endif
                                </div>
                                <div class="box box-info">
                                    <form action="{{ route('card_update', $card->id) }}" method="post" enctype="multipart/form-data" id="form_data">
                                        @csrf
                                        @include('layout_admin.cards.template')
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
    $(document).ready(function() {

        <?php if (isset($card->price)) { ?>
            var arr_number = '{{ count(json_decode($card->price)) }}';
            var count = '{{ count(json_decode($card->price)) }}';
            <?php } else { ?>
            var arr_number = 0;
            var count = 1;
            <?php } ?>

        function data_form(number) {
            var html = '<div class="row" style="width: 80%;" id="row'+ count +'">';
            html += '<div class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label class="form-control-label" for="basic-url">Giá: </label>';
            html += '<div class="input-group">';
            html += '<input name="price[]" id="price" type="number" class="form-control" id="exampleFormControlInput1" placeholder="Giá. . . . . . . . ." min="0" maxlength="50" required>';
            html += '<span class="input-group-text" id="basic-addon2">VNĐ</span>';
            html += "</div>";
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label class="form-control-label" for="basic-url">Giảm giá: </label>';
            html += '<div class="input-group" style="width: 100%;">';
            html += '<span class="input-group-text"><i class="fa fa-paint-brush"></i></span>';
            html += '<input type="number" class="form-control" id="discount" name="discount[]" value="0" required min="0">';
            html += '<span class="input-group-text" id="basic-addon2">%</span>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-2">';
            html += '<div class="form-group">';
            html += '<label class="form-control-label" for="basic-url">Thao Tác: </label> <br>';
            html += '<button type="button" class="btn bg-gradient-primary w-12 float-left btn_remove" name="add_btn" id="'+ count +'"><i class="fa fa-minus"></i></button>';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            $('#new_chq').append(html);

        }

        $('#add_btn').click(function() {
            count++;
            data_form(count);
        });

        $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }   
                });
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xoá?',
                    text: "Bạn không thể hoàn tác sau khi xoá!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xoá!',
                    cancelButtonText: 'Huỷ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (button_id == 1 && arr_number != 0) {
                            $("#price").val('');
                        } else {
                            $('#row' + button_id + '').remove();
                        }
                        $.ajax({
                            url: "{{ route('card_price_delete', $card->id) }}",
                            method: 'GET',
                            data: $('#form_data').serialize(),
                            dataType: 'json',
                            success: function(data) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                )
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                })
                            }
                        });
                        // Swal.fire(
                        // 'Deleted!',
                        // 'Your file has been deleted.',
                        // 'success'
                        // )
                        // $('#row'+button_id+'').remove();
                    }
                })
            });
    });
</script>
@stop