@extends('layout_index.master')
@section('content')
<link href="{{ asset('dev/css/style_all.min.20210101.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dev/css/style2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dev/css/style3.css') }}" rel="stylesheet" type="text/css" />
<section class="wrapper bg-soft-primary" style="margin-top: -20px">
    <div class="container pt-5 pb-15 py-lg-17 py-xl-19 pb-xl-20 position-relative">
        <img class="position-lg-absolute col-12 col-lg-10 col-xl-11 col-xxl-10 px-lg-5 px-xl-0 ms-n5 ms-sm-n8 ms-md-n10 ms-lg-0 mb-md-4 mb-lg-0" src="{{ asset('dev/img/photos/devices.png') }}" srcset="{{ asset('dev/img/photos/devices@2x.png') }} 2x" data-cue="fadeIn" alt="" style="top: -1%; left: -21%;" />
        <div class="row gx-0 align-items-center">
            <div class="col-md-10 offset-md-1 col-lg-5 offset-lg-7 offset-xxl-6 ps-xxl-12 mt-md-n9 text-center text-lg-start" data-cues="slideInDown" data-group="page-title" data-delay="600">
                <h1 class="display-2 mb-4 mx-sm-n2 mx-md-0">Get all of your steps, exercise, sleep and meds in one place.</h1>
                <p class="lead fs-lg mb-7 px-md-10 px-lg-0">Sandbox is now available to download from both the App Store and Google Play Store.</p>
                <div class="d-flex justify-content-center justify-content-lg-start" data-cues="slideInDown" data-group="page-title-buttons" data-delay="900">
                    <span><a class="btn btn-primary btn-icon btn-icon-start rounded me-2"><i class="uil uil-apple"></i> App Store</a></span>
                    <span><a class="btn btn-green btn-icon btn-icon-start rounded"><i class="uil uil-google-play"></i> Google Play</a></span>
                </div>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<div class="xmodal"></div>

<div class="clear"></div>
<div class="all_nd_themgame_ud">

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
                <a href="javascript:;" id="btnPayment" class="link_thanhtoan_naptien">thanh toán ngay</a>
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