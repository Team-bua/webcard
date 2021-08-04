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
                        <li id="cateId_114" class="cateId" onclick="BuycardGamePage.GetProductbyCateId(114)">
                            <a href="javascript:;">
                                <em>
                                    5% </em><img class="lazyload"
                                    src="{{ asset('dev/img/photos/devices.png') }}"
                                    style="max-width:85px;" alt="">
                            </a>
                        </li>
                        <li id="cateId_319" class="cateId" onclick="BuycardGamePage.GetProductbyCateId(319)">
                            <a href="javascript:;">
                                <em>
                                    3% </em><img class="lazyload"
                                    data-src="https://365.vtcpay.vn/media/Upload/Images/Category/GARENA-23-04-2021-14-55-53.png"
                                    style="max-width:85px;" alt="">
                            </a>
                        </li>
                        <li id="cateId_67" class="cateId" onclick="BuycardGamePage.GetProductbyCateId(67)">
                            <a href="javascript:;">
                                <em>
                                    3,5% </em><img class="lazyload"
                                    data-src="https://365.vtcpay.vn/media/Upload/Images/Category/ZING-23-04-2021-14-54-09.png"
                                    style="max-width:85px;" alt="">
                            </a>
                        </li>
                        <li id="cateId_615" class="cateId" onclick="BuycardGamePage.GetProductbyCateId(615)">
                            <a href="javascript:;">
                                <em>
                                    5% </em><img class="lazyload"
                                    data-src="https://365.vtcpay.vn/media/Upload/Images/Category/KUL-21-01-2021-15-07-40.png"
                                    style="max-width:85px;" alt="">
                            </a>
                        </li>
                        <li id="cateId_612" class="cateId" onclick="BuycardGamePage.GetProductbyCateId(612)">
                            <a href="javascript:;">
                                <em>
                                    5% </em><img class="lazyload"
                                    data-src="https://365.vtcpay.vn/media/Upload/Images/Category/GOSUCARD-21-01-2021-14-29-55.png"
                                    style="max-width:85px;" alt="">
                            </a>
                        </li>
                        <li id="cateId_608" class="cateId" onclick="BuycardGamePage.GetProductbyCateId(608)">
                            <a href="javascript:;">
                                <em>
                                    5% </em><img class="lazyload"
                                    data-src="https://365.vtcpay.vn/media/Upload/Images/Category/CARD_FUN-21-01-2021-14-32-46.png"
                                    style="max-width:85px;" alt="">
                            </a>
                        </li>
                        <li id="cateId_604" class="cateId" onclick="BuycardGamePage.GetProductbyCateId(604)">
                            <a href="javascript:;">
                                <em>
                                    5% </em><img class="lazyload"
                                    data-src="https://365.vtcpay.vn/media/Upload/Images/Category/Soha@BuyCard-21-01-2021-14-53-33.png"
                                    style="max-width:85px;" alt="">
                            </a>
                        </li>
                        <li id="cateId_606" class="cateId" onclick="BuycardGamePage.GetProductbyCateId(606)">
                            <a href="javascript:;">
                                <em>
                                    4,5% </em><img class="lazyload"
                                    data-src="https://365.vtcpay.vn/media/Upload/Images/Category/SCOIN_MOBILE_CARD-21-01-2021-14-07-31.png"
                                    style="max-width:85px;" alt="">
                            </a>
                        </li>
                        <li id="cateId_68" class="cateId" onclick="BuycardGamePage.GetProductbyCateId(68)">
                            <a href="javascript:;">
                                <em>
                                    4% </em><img class="lazyload"
                                    data-src="https://365.vtcpay.vn/media/Upload/Images/Category/GATE-28-10-2020-16-43-24.png"
                                    style="max-width:85px;" alt="">
                            </a>
                        </li>
                        <li id="cateId_458" class="cateId" onclick="BuycardGamePage.GetProductbyCateId(458)">
                            <a href="javascript:;">
                                <em>
                                    5% </em><img class="lazyload"
                                    data-src="https://365.vtcpay.vn/media/Upload/Images/Category/APPOTA@BuyCard-21-01-2021-15-08-17.png"
                                    style="max-width:85px;" alt="">
                            </a>
                        </li>
                        <li id="cateId_166" class="cateId" onclick="BuycardGamePage.GetProductbyCateId(166)">
                            <a href="javascript:;">
                                <em>
                                    6,5% </em><img class="lazyload"
                                    data-src="https://365.vtcpay.vn/media/Upload/Images/Category/ONCASH-21-01-2021-14-58-24.png"
                                    style="max-width:85px;" alt="">
                            </a>
                        </li>

                    </ul>
                    <h6 class="text_td_thegame_ud">Chọn mệnh giá và số lượng</h6>
                    <span class="text_td_thegame_luachon_ud" id="Provider"></span>
                    <ul class="list_all_menhgia_thegame_udrt" id="ul_Product">
                    </ul>
                    <div class="all_so_luong_the">
                        <b>Số lượng:</b>
                        <em class="subquan"><svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0">
                                <polygon fill="white"
                                    points="4.5 4.5 3.5 4.5 0 4.5 0 5.5 3.5 5.5 4.5 5.5 10 5.5 10 4.5"></polygon>
                            </svg></em>
                        <input type="text" id="quantity" name="" onkeypress="return utils.checkOnlyNumber(this, event);"
                            min="1" value="1">
                        <em class="addquan"><svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0">
                                <polygon fill="white"
                                    points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5">
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