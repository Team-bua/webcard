@extends('layout_index.master')
@section('content')
<link href="{{ asset('dev/css/style_all.min.20210101.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dev/css/style2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dev/css/style3.css') }}" rel="stylesheet" type="text/css" />

<div class="all_nd_themgame_ud" style="margin-top: -20px">

    <div class="al_chonthe_menhgia_tin">
        <div class="row">
            <div class="col-lg-12 col-md-8 col-sm-12 col-xs-12" style="margin-top: 20px">
                <h6 class="text_td_thegame_ud" style="margin-top: 0;">chọn loại thẻ
                </h6>
                <ul class="list_all_the_game_udrt">
                    @if(isset($cards))
                    @foreach($cards as $card)
                    <li id="cateId_{{$card->id}}" class="cateId" onclick="cate('{{ $card->id }}')">
                        <a href="javascript:;">
                            <em>
                                5% </em><img class="lazyload" src="{{ asset($card->image) }}" style="max-width:85px;" alt="">
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
                <h6 class="text_td_thegame_ud">Chọn mệnh giá và số lượng</h6>
                <span class="text_td_thegame_luachon_ud" id="Provider"></span>
                <ul class="list_all_menhgia_thegame_udrt" id="ul_Product">
                    <li id="proId_206" class="proId ac_chon_mg_these"><a href="javascript:;"><b>10.000đ</b><span>Giá bán: 9.500đ</span></a></li>
                    <li id="proId_89" class="proId" ><a href="#" ><b>20.000đ</b><span>Giá bán: 19.000đ</span></a></li>
                    <li id="proId_90" class="proId"><a href="#"><b>50.000đ</b><span>Giá bán: 47.500đ</span></a></li>
                    <li id="proId_91" class="proId"><a href="#"><b>100.000đ</b><span>Giá bán: 95.000đ</span></a></li>
                    <li id="proId_92" class="proId"><a href="#"><b>200.000đ</b><span>Giá bán: 190.000đ</span></a></li>
                    <li id="proId_93" class="proId"><a href="#"><b>300.000đ</b><span>Giá bán: 285.000đ</span></a></li>
                    <li id="proId_94" class="proId"><a href="#"><b>500.000đ</b><span>Giá bán: 475.000đ</span></a></li>
                    <li id="proId_441" class="proId"><a href="#"><b>1.000.000đ</b><span>Giá bán: 950.000đ</span></a></li>
                    <li id="proId_1979" class="proId"><a href="#"><b>2.000.000đ</b><span>Giá bán: 1.900.000đ</span></a></li>
                    <li id="proId_1980" class="proId"><a href="#"><b>5.000.000đ</b><span>Giá bán: 4.750.000đ</span></a></li>
                    <li id="proId_1989" class="proId"><a href="#"><b>10.000.000đ</b><span>Giá bán: 9.500.000đ</span></a></li>
                </ul>
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

    function cate(number){
        $('#cateId_'+ number +'').focus(function(){
            console.log(123);
            $('#cateId_'+ number +'').attr('style', 'border: solid 2px #0475c5;')
        }); 
    }
    
</script>
@stop