<div class="card-body p-3">
    <div class="form-group" style="width: 70%;">
        <label class="form-control-label" for="basic-url">Tên thẻ</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
            <input type="text" class="form-control" id="name_card" name="name_card" aria-describedby="basic-addon3" maxlength="150" value="{{ isset($card) ? $card->name : old('name_card') }}" required>
        </div>
    </div>
    <div class="form-group">
        <label class="form-control-label" for="basic-url">Loại thẻ</label>
        <select class="form-control" id="type_card" name="type_card" style="width: 200px;" required>
            @if($card_types && !isset($card))
                @foreach($card_types as $t)
                    <option>{{ $t->name }}</option>
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
            <img id="img" class="img" style="width: 100px; height: 100px;" src="{{ isset($card) ? asset($card->image) : asset('dashboard/assets/img/no_img.jpg') }}">
        </div>
    </div>
</div>
</div>