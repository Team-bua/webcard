@extends('layout_index.master')
@section('content')
<link href="{{ asset('dev/css/style_all.min.20210101.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dev/css/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dev/css/style3.css') }}" rel="stylesheet" type="text/css" />

<section class="wrapper bg-soft-primary" style="margin-top: -20px">
    <figure class="position-absoute" style="bottom: 0; left: 0; z-index: 2;"><img src="{{ asset('dev/img/photos/banner_index.jpg') }}" alt=""></figure>
    <!-- /.container -->
  </section>
<div class="all_nd_themgame_ud">

    <div class="al_chonthe_menhgia_tin">
        <form name="form" action="{{ route('buy_card') }}" method="get" id="form">
            <input type="text" name="card_id_info" id="card_id_info" value="">
            <input type="text" name="subject" id="subject" value="">
            <input type="text" name="quantity1" id="quantity1" value="1">
            <input type="text" name="discount" id="discount" value="">
        </form>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="margin-top: 20px">
                <h6 class="text_td_thegame_ud" style="margin-top: 0;">chọn loại thẻ
                </h6>
                <div class="tab-wrapper">
                    <ul class="list_all_the_game_udrt">
                        @if(isset($cards))
                        @foreach($cards as $card)
                        <li id="cateId_{{$card->id}}" class="cateId">
                            <a href="#" onclick="cate('{{ $card->id}}', '{{ $card->name }}')" class="cate" id="{{ $card->id }}">
                                @if($card->discount != 0)<em>{{ $card->discount }} %</em>@endif<img class="lazyload" src="{{ asset($card->image) }}" style="max-width:85px; height: 50px;" alt="">
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    <h6 class="text_td_thegame_ud">Chọn mệnh giá và số lượng</h6>
                    <span class="text_td_thegame_luachon_ud" id="Provider"></span>
                    @if(isset($cards))
                    @foreach($cards as $card)
                    <div class="cardInfo" id="card{{$card->id}}" style="display: none" >
                        <ul class="list_all_menhgia_thegame_udrt" id="ul_Product">
                            @for($i = 0; $i < count(json_decode($card->price)); $i++)
                            <li id="proId_{{ $i }}_{{$card->id}}" class="proId"><a href="#" onclick="card('{{ $i }}', '{{ json_decode($card->price)[$i] }}', '{{$card->id}}', '{{ $card->discount }}')"><b>{{ number_format(json_decode($card->price)[$i]) }} VNĐ</b><span>Giá bán: {{ number_format(json_decode($card->price)[$i] - json_decode($card->price)[$i] * $card->discount / 100) }} VNĐ</span></a></li>
                            @endfor
                        </ul>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="all_so_luong_the">
                    <b>Số lượng:</b>
                    <em class="subquan" onClick='decreaseCount(event, this)'><svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0">
                            <polygon fill="white" points="4.5 4.5 3.5 4.5 0 4.5 0 5.5 3.5 5.5 4.5 5.5 10 5.5 10 4.5"></polygon>
                        </svg></em>
                    <input type="text" id="quantity" name="" onkeypress="return utils.checkOnlyNumber(this, event);" min="1" value="1" disabled="disabled">
                    <em class="addquan" id="123" onClick='increaseCount(event, this)'><svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0">
                            <polygon fill="white" points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5">
                            </polygon>
                        </svg></em>
                </div>
                <div class="clear"></div>
                <h6 class="text_td_thegame_ud" style="margin-bottom:0;"></h6>

            </div>
            <div class="col-lg-4 col-md-8 col-sm-12 col-xs-12" style="margin-top: 20px">
                <h6 class="text_td_thegame_ud" style="margin-top: 0;">Chi tiết giao dịch</h6>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <tbody class="text-center">
                                <tr style="text-align: left">
                                    <td>Loại thẻ :</td>
                                    <td id="card_info"></td>
                                </tr>
                                <tr style="text-align: left">
                                    <td>Mệnh giá :</td>
                                    <td id="price"></td>
                                </tr>
                                <tr style="text-align: left">
                                    <td>Số lượng :</td>
                                    <td id="quantity2"></td>
                                </tr>
                                <tr style="text-align: left">
                                    <td><b>Tổng tiền :</b></td>
                                    <td id="total"></td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <a href="#" onClick='submitForm()' class="link_thanhtoan_naptien">Thanh toán ngay</a>

            </div>

        </div>
    </div>

</div>

</div>
@endsection
@section('script')
<script>
    function cate(number, name) {
        var card_id = number;     
        $('.cate').removeAttr("style");
        $('#' + card_id + '').attr("style", "border: solid 2px #0475c5;");
        $('#price').html('');
        $('#total').html('');
        $('#discount').attr("value", '');
        $('.cardInfo').attr("style", "display:none");
        $('#card'+card_id+'').removeAttr("style");
        $('#card_id_info').attr("value", number);
        $('#card_info').html(name);
        $('#subject').attr("value", '');
        $('.ac_chon_mg_these').removeClass('ac_chon_mg_these');
    }

    function submitForm() {
        $('#form').submit();
    }

    function card(id, price, id_card, discount) {
        var quantity = $('#quantity1').val();
        $('.ac_chon_mg_these').removeClass('ac_chon_mg_these');
        $('#proId_'+id+'_'+id_card+'').attr('class', 'ac_chon_mg_these');
        $('#subject').attr("value", price);
        $('#discount').attr("value",price - price * discount / 100)
        $('#price').html(Number(price - price * discount / 100).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
        $('#total').html(Number(quantity * (price - price * discount / 100)).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
        $('#quantity2').html(quantity);
    }

    function increaseCount(a, b) {
        var discount = document.getElementById("discount").value;
        var price = document.getElementById("subject").value;
        var input = b.previousElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        input.value = value;
        document.getElementById("quantity1").value = input.value;
        document.getElementById("quantity2").innerHTML = input.value;
        document.getElementById("total").innerHTML = Number(input.value * discount).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ';
    }

    function decreaseCount(a, b) {
        var discount = document.getElementById("discount").value;
        var price = document.getElementById("subject").value;
        var input = b.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 1) {
            value = isNaN(value) ? 0 : value;
            value--;
            input.value = value;
        document.getElementById("quantity1").value = input.value;
        document.getElementById("quantity2").innerHTML = input.value;
        document.getElementById("total").innerHTML = Number(input.value * discount).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ';
    }

    
}
</script>
@stop