<div class="card-body p-3">
    <div class="form-group">
        <label class="form-control-label" for="basic-url">Loại thẻ</label>
        <select class="form-control" id="type_card" name="type_card" style="width: 200px;" required>
            @if($card_types && !isset($sub_card_type))
            @foreach($card_types as $t)
            <option value="{{ $t->id }}">{{ $t->name }}</option>
            @endforeach
            @elseif ($sub_card_type)
            @foreach($card_types as $t)
            @if($t->id == $sub_card_type->card_type_id)
            <option value="{{ $sub_card_type->card_type_id }}" selected>{{ $sub_card_type->card_type->name }}</option>
            @else
            <option value="{{ $t->id }}">{{ $t->name }}</option>
            @endif
            @endforeach
            @endif
        </select>
    </div>  
    <div class="form-group">
        <label class="form-control-label" for="basic-url">Tên thương hiệu</label>
        <div class="input-group">
        <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
        <input type="text" class="form-control" id="name" name="name" value="{{ isset($sub_card_type->name) ? $sub_card_type->name : '' }}" placeholder="Tên thương hiệu">                                   
        </div>
         @error('name')
            <p style="color:red; font-size: 13px; margin-left: 5px">{{ $message }}</p>
        @enderror
    </div>
   
</div>