< script >
    function changeIcon(input, id_number) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.img_icon' + id_number + '').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

$(document).ready(function() {

    <?php if (isset($index->desc_number_step)) { ?>
    var arr_number = '{{ count(explode(',
        ', $index->desc_number_step)) }}';
    var count = '{{ count(explode(',
        ', $index->desc_number_step)) }}';
    <?php } else { ?>
    var arr_number = 0;
    var count = 1;
    <?php } ?>

    function data_form(number) {
        var html = `<div class="row" id="new` + count + `">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Nội dung </label>                       
                                            <div class="input-group">
                                                <input name="content[]" id="content" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nội dung. . . . . . . . ." maxlength="50" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Miêu tả </label>                       
                                            <div class="input-group" style="width: 100%;">
                                                <input type="text" class="form-control" id="description" name="description[]" value="" placeholder="Miêu tả. . . . . . . . .">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="form-control-label" for="basic-url">Icon </label><br>
                                        <input id="img_icon` + count + `" type="file" name="icon[]" class="form-control packgame"
                                        onchange="changeIcon(this, ` + count + `)" style="display: none">
                                        <img id="` + count + `" class="img_icon` + count + ` imgicon" style="width: 50px; height: 34px;"
                                        src="{{ asset('dashboard/assets/img/no_img.jpg') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="basic-url">Thao tác</label> <br>
                                            <button type="button" class="btn bg-gradient-primary w-12 float-left btn_remove" name="btn_remove" id="` + count + `"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>`;

        $('#new_chq').append(html);

    }

    $('#add_btn').click(function() {
        count++;
        if (count <= 6) {
            data_form(count);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Giới hạn là 6 nội dung!',
            })
        }

    });

    $(document).on('click', '.imgicon', function() {
        var input_id = $(this).attr('id');
        $('#img_icon' + input_id + '').click();
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
                    $("#content").val('');
                    $("#description").val('');
                } else {
                    $('#new' + button_id + '').remove();
                }
                $.ajax({
                    url: "{{ route('delete.icon', $index->id) }}",
                    method: 'GET',
                    data: $('#form_data1').serialize(),
                    dataType: 'json',
                    success: function(data) {
                        Swal.fire(
                            'Xóa!',
                            'Xóa thành công',
                            'success'
                        )
                        window.location.reload();
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

        $('#form_data1').validate();

    });
}); <
/script>