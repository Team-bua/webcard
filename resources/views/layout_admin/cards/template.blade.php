<div class="card-body p-3">
    <div class="form-group" style="width: 70%;">
        <label class="form-control-label" for="basic-url">Tên thẻ</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
        </div>
    </div>
    <div class="form-group">
        <label class="form-control-label" for="basic-url">Loại thẻ</label>
        <select class="form-control" id="exampleFormControlSelect1" style="width: 200px;">
            <option>Card</option>
            <option>Voucher</option>
        </select>
    </div>
    <div class="row" style="width: 80%;" id="row1">
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-control-label" for="basic-url">Giá: </label>
                <div class="input-group">
                    <input name="package[]" id="package" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Giá. . . . . . . . ." maxlength="150" required>
                    <span class="input-group-text" id="basic-addon2">VNĐ</span>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="form-control-label" for="basic-url">Thao Tác: </label> <br>
                <button type="button" class="btn bg-gradient-primary w-12 float-left" name="add_btn" id="add_btn"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div id="new_chq"></div>
    <div class="form-group">
        <label class="form-control-label" for="basic-url">Ảnh đại diện</label>
        <div class="input-group">
            <input id="fImages" type="file" name="avatar" class="form-control" style="display: none" onchange="changeImg(this)">
            <img id="img" class="img" style="width: 100px; height: 100px;" src="{{ asset('dashboard/assets/img/no_img.jpg') }}">
        </div>
    </div>
</div>