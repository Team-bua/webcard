@extends('layout_index.master')
@section('content')
<link href="{{ asset('dev/css/style_all.min.20210101.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dev/css/style2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dev/css/style3.css') }}" rel="stylesheet" type="text/css" />

<div class="all_nd_themgame_ud" style="margin-top: -20px">

    <div class="al_chonthe_menhgia_tin">
        <form name="form" action="" method="get">
            <input type="text" name="subject" id="subject" value="">
        </form>
        <div class="row">
            <div class="col-lg-12 col-md-8 col-sm-12 col-xs-12" style="margin-top: 20px">
                <h6 class="text_td_thegame_ud" style="margin-top: 0;">chọn loại thẻ
                </h6>
                <div class="tab-wrapper">
                    <ul class="list_all_the_game_udrt">
                        @if(isset($cards))
                        @foreach($cards as $card)
                        <li id="cateId_{{$card->id}}" class="cateId" onclick="cate('{{ $card->id }}')">
                            <a href="#" onclick="cate('{{ $card->id}}')" class="cate" id="{{ $card->id }}">
                                <em>
                                    5% </em><img class="lazyload" src="{{ asset($card->image) }}" style="max-width:85px; height: 50px;" alt="">
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
                            <li id="proId_{{ $i }}" class="proId"><a href="#"><b>{{ json_decode($card->price)[$i] }}</b><span>Giá bán: {{ json_decode($card->price)[$i] - json_decode($card->price)[$i] * 5 / 100 }}</span></a></li>
                            @endfor
                        </ul>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="all_so_luong_the">
                    <b>Số lượng:</b>
                    <em class="subquan"><svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0">
                            <polygon fill="white" points="4.5 4.5 3.5 4.5 0 4.5 0 5.5 3.5 5.5 4.5 5.5 10 5.5 10 4.5"></polygon>
                        </svg></em>
                    <input type="text" id="quantity" name="" onkeypress="return utils.checkOnlyNumber(this, event);" min="1" value="1">
                    <em class="addquan"><svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0">
                            <polygon fill="white" points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5">
                            </polygon>
                        </svg></em>
                </div>
                <div class="clear"></div>
                <h6 class="text_td_thegame_ud" style="margin-bottom:0;"></h6>
                <a href="javascript:;" id="btnPayment" class="link_thanhtoan_naptien">Thanh toán ngay</a>
                <input type="hidden" id="productID" value="0" />
                <input type="hidden" id="hfCategoryId" value="161" />

            </div>

        </div>
    </div>

</div>

</div>
@endsection
@section('script')
<script>
    $('#proId_93').on('click', function() {
        $('.ac_chon_mg_these').removeClass('ac_chon_mg_these')
        $('#proId_93').attr('class', 'ac_chon_mg_these')
    });

    function cate(number) {
        var card_id = number;     
        $('.cate').removeAttr("style");
        $('#' + card_id + '').attr("style", "border: solid 2px #0475c5;");
        $('#subject').attr("value", card_id);
        $('.cardInfo').attr("style", "display:none");
        $('#card'+card_id+'').removeAttr("style");
    }
</script>
@stop