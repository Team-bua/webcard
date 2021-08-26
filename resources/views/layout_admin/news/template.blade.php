<div class="card-body p-3">
    <div class="form-group" style="width: 70%;">
        <label class="form-control-label" for="basic-url">Tiêu đề</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
            <input type="text" class="form-control" id="tittle" name="tittle" aria-describedby="basic-addon3"
                maxlength="150" value="{{ isset($news->tittle) ? $news->tittle : '' }}" placeholder="Tiêu đề . . . ">
        </div>
        @error('tittle')
            <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group" style="width: 70%;">
        <label class="form-control-label" for="basic-url">Nội dung</label>
        <textarea class="form-control" id="content" name="content" rows="5" placeholder="Nội dung . . . . ">{{ isset($news->content) ? $news->content : '' }}</textarea> <br>                        
    </div> 
    @error('content')
        <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
    @enderror       
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label class="form-control-label" for="basic-url">Avatar</label>
                <div class="input-group">
                    <input id="fImages" type="file" name="avatar" class="form-control" style="display: none"
                        onchange="changeImg(this)">
                    <img id="img" class="img" style="width: 150px; height: 150px;"
                        src="{{ asset( isset($news->avatar) ? $news->avatar : 'dashboard/assets/img/no_img.jpg') }}">
                </div>
            </div>
            @error('avatar')
                <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-4">
            <div class="form-group">
                <label class="form-control-label" for="basic-url">Thumbnail</label>
                <div class="input-group">
                    <input id="thumbnail" type="file" name="thumbnail" class="form-control" style="display: none"
                        onchange="changeThumbnail(this)">
                    <img id="thum" class="thumbnail" style="width: 200px; height: 120px;"
                        src="{{ asset( isset($news->thumbnail) ? $news->thumbnail : 'dashboard/assets/img/no_img.jpg') }}">
                </div>
            </div>
            @error('thumbnail')
                <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
