    <div class="card-header pb-0 p-3">
        <h6 class="mb-0">Thêm thẻ</h6>
    </div>
    <div class="card-body p-3">
        <div class="form-group">
            <label class="form-control-label" for="basic-url">Tên thẻ</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
        </div>
        <div class="form-group">
            <label class="form-control-label" for="basic-url">Loại thẻ</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                </select>
            </div>
        </div>
        <div class="input-group" id="row0">
            <div class="col-sm-2">
                <label class="form-control-label" for="basic-url">Giá: </label>
                <input name="package[]" id="package" type="text" class="form-control" placeholder="Giá. . . . . . . . ." maxlength="150" required>
            </div>
            <div class="col-sm-2" style="margin-left: 1%">
                <label class="form-control-label" for="basic-url">Thao Tác: </label>
                <br>
                <button type="button" class="btn bg-gradient-primary" name="add_btn" id="add_btn"><i class="fa fa-plus"></i></button>
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