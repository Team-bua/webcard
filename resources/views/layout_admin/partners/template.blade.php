<div class="card-body p-3">
    <div class="form-group">
        <label class="form-control-label" for="basic-url">Đường dẫn</label>
        <div class="input-group">
        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
        <input type="text" class="form-control" id="link" name="link" value="{{ isset($partner) ? $partner->link : '' }}" placeholder="https://">                                   
        </div>
    </div>
    <div class="form-group">
        <label class="form-control-label" for="basic-url">Logo đối tác</label> <br>
        <div class="input-group">
            <input id="fImages" type="file" name="avatar" class="form-control" style="display: none"  onchange="changeImg(this)">
            <img id="img" class="img" style="width: 200px; height: 120px;" src="{{ asset(isset($partner->image) ? $partner->image : 'dashboard/assets/img/no_img.jpg') }}">
        </div>
    </div>
    @error('avatar')
        <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
    @enderror
</div>