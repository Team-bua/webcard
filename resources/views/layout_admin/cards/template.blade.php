<div class="card-body p-3">
    <div class="form-group" style="width: 70%;">
        <label class="form-control-label" for="basic-url">Tên thẻ</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
            <input type="text" class="form-control" id="name_card" name="name_card" aria-describedby="basic-addon3" maxlength="150" value="{{ isset($card) ? $card->name : old('name_card') }}">
        </div>
        @error('name_card')
        <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
        @enderror
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label" for="basic-url">Loại thẻ</label>
                <select class="form-control" id="type_card" name="type_card" style="width: 200px;" required>
                    @if($card_types && !isset($card))
                    @foreach($card_types as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                    @elseif ($card)
                    @foreach($card_types as $t)
                    @if($t->name == $card->card_type)
                    <option value="{{ $card->card_type }}" selected>{{ $card->card_type }}</option>
                    @else
                    <option value="{{ $t->name }}">{{ $t->name }}</option>
                    @endif
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label" for="basic-url">Thương hiệu</label>
                <select class="form-control" id="sub_card_type" name="sub_card_type" style="width: 200px;" required>
                    @if($sub_card_type && !isset($card))
                    @foreach($sub_card_type as $t)
                    <option value="{{ $t->id }}">({{ $t->card_type->name }}) {{ $t->name }}</option>
                    @endforeach
                    @elseif ($card)
                    @foreach($sub_card_type as $t)
                    @if($t->id == $card->sub_card_type_id)
                    <option value="{{ $card->sub_card_type_id }}" selected>({{ $card->card_type }}) {{ $card->sub_card_type->name }}</option>
                    @else
                    <option value="{{ $t->id }}">({{ $t->card_type->name  }}) {{ $t->name }}</option>
                    @endif
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <!-- <div class="form-group">
        <label class="form-control-label" for="basic-url">Giảm giá</label>
        <div class="input-group" style="width: 30%;">
            <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
            <input type="number" class="form-control" id="discount" name="discount" value="{{ isset($card) ? $card->discount : 0 }}">
            <span class="input-group-text" id="basic-addon2">%</span>
        </div>
        @error('discount')
            <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
        @enderror
    </div> -->
    @if(isset($card) && $card->price != '')
    @for($i = 0; $i < count(json_decode($card->price)); $i++)
        <div class="row" style="width: 80%;" id="row{{ $i + 1 }}">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-control-label" for="basic-url">Giá: </label>

                    <div class="input-group">
                        <input name="price[]" id="price" type="number" class="form-control" id="exampleFormControlInput1" placeholder="Giá. . . . . . . . ." min="0" maxlength="50" value="{{ json_decode($card->price)[$i] }}" required>
                        <span class="input-group-text" id="basic-addon2">VNĐ</span>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-control-label" for="basic-url">Giảm giá: </label>

                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                        <input type="number" class="form-control" id="discount" name="discount[]" value="{{ json_decode($card->discount)[$i] }}" required min="0">
                        <span class="input-group-text" id="basic-addon2">%</span>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-control-label" for="basic-url">Thao Tác: </label> <br>
                    <button type="button" class="btn bg-gradient-primary w-12 float-left btn_remove" name="remove_btn" id="{{ $i + 1 }}"><i class="fa fa-minus"></i></button>
                    @if($i == 0)
                    <button type="button" class="btn bg-gradient-primary w-12 float-left" name="add_btn" id="add_btn"><i class="fa fa-plus"></i></button>
                    @endif
                </div>
            </div>
        </div>
        @endfor
        @else
        <div class="row" style="width: 80%;" id="row1">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-control-label" for="basic-url">Giá: </label>

                    <div class="input-group">
                        <input name="price[]" id="price" type="number" class="form-control" id="exampleFormControlInput1" placeholder="Giá. . . . . . . . ." min="0" maxlength="50" required>
                        <span class="input-group-text" id="basic-addon2">VNĐ</span>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-control-label" for="basic-url">Giảm giá: </label>

                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                        <input type="number" class="form-control" id="discount" name="discount[]" value="0" required min="0">
                        <span class="input-group-text" id="basic-addon2">%</span>
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
        @endif
        <div id="new_chq"></div>
        <div class="form-group">
            <label class="form-control-label" for="basic-url">Ảnh đại diện</label>
            <div class="input-group">
                <input id="fImages" type="file" name="avatar" class="form-control" style="display: none" onchange="changeImg(this)">
                <img id="img" class="img" style="width: 200px; height: 100px;" src="{{ isset($card) ? asset($card->image) : asset('dashboard/assets/img/no_img.jpg') }}">
            </div>
        </div>
        @error('avatar')
        <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
        @enderror
</div>
</div>