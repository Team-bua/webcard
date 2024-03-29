@extends('layout_index.master')
@section('content')
    <link href="{{ asset('dev/css/style_all.min.20210101.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dev/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dev/css/style3.css') }}" rel="stylesheet" type="text/css" />
    <style>
        HTML CSS JSResult Skip Results Iframe EDIT ON * {
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            background: #2d2c41;
            font-family: 'Open Sans', Arial, Helvetica, Sans-serif, Verdana, Tahoma;
        }

        ul {
            list-style-type: none;
        }

        a {
            color: #b63b4d;
            text-decoration: none;
        }

        /** =======================
     * Contenedor Principal
     ===========================*/


        h1 {
            color: #FFF;
            font-size: 24px;
            font-weight: 400;
            text-align: center;
            margin-top: 80px;
        }

        h1 a {
            color: #c12c42;
            font-size: 16px;
        }

        .accordion {
            width: 100%;
            max-width: 360px;
            margin: 30px auto 20px;
            background: #FFF;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }

        .accordion .link {
            cursor: pointer;
            display: block;
            padding: 15px 15px 15px 42px;
            color: #4D4D4D;
            font-size: 14px;
            font-weight: 700;
            border-bottom: 1px solid #CCC;
            position: relative;
            -webkit-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .accordion li {
            margin-left: -40px;
        }

        .accordion li:last-child .link {
            border-bottom: 0;
        }

        .accordion li i {
            position: absolute;
            top: 16px;
            left: 12px;
            font-size: 18px;
            color: #595959;
            -webkit-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .accordion li i.uil-angle-down {
            right: 12px;
            left: auto;
            font-size: 16px;
        }

        .accordion li.open .link {
            color: #b63b4d;
        }

        .accordion li.open i {
            color: #b63b4d;
        }

        .accordion li.open i.uil-angle-down {
            -webkit-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            -o-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        /**
     * Submenu
     -----------------------------*/


        .submenu {
            display: none;
            background: #444359;
            font-size: 14px;
        }

        .submenu li {
            border-bottom: 1px solid #4b4a5e;
            margin-left: -40px;
        }

        .submenu a {
            display: block;
            text-decoration: none;
            color: #d9d9d9;
            padding: 12px;
            padding-left: 42px;
            -webkit-transition: all 0.25s ease;
            -o-transition: all 0.25s ease;
            transition: all 0.25s ease;
        }

        .submenu a:hover {
            background: #b63b4d;
            color: #FFF;
        }

        /* Resources1× 0.5× 0.25×Rerun */

    </style>
    <section class="wrapper bg-soft-primary" style="margin-top: -20px">
        @if (isset($index->banner_buy_card))
            <img src="{{ asset($index->banner_buy_card) }}" width="100%" height="400px" alt="">
        @endif
        <!-- /.container -->
    </section>
    <div class="all_nd_themgame_ud">

        <div class="al_chonthe_menhgia_tin">
            <form name="form" action="{{ route('buy_card') }}" method="get" id="form">
                <input style="display: none" type="text" name="card_id_info" id="card_id_info" value="">
                <input style="display: none" type="text" name="subject" id="subject" value="">
                <input style="display: none" type="text" name="quantity1" id="quantity1" value="1">
                <input style="display: none" type="text" id="discount" value="">
                <input style="display: none" type="text" id="discount_num" name="discount_num" value="">
                <input style="display: none" type="text" id="discount_code" name="discount_code" value="">
                <input id="discount_code_input2" type="hidden" class="form-control" style="width: 150px;" placeholder="Mã giảm giá. . . " value="0">
                <input id="discount_code_type2" type="hidden" class="form-control" style="width: 150px;" placeholder="Mã giảm giá. . . " value="0">
            </form>
            <div class="row" style="margin-top: 20px">
                <div class="col-lg-2 col-md-8 col-sm-12 col-xs-12">
                    <h6 class="text_td_thegame_ud" style="margin-top: 0px">Danh sách loại thẻ</h6>
                    <ul class="accordion" style="margin-top: -25px">
                        <li>
                            <div class="link" onclick="getAllCard()">Tất cả thẻ</div>
                        </li>
                    </ul>
                    <ul id="accordion" class="accordion" style="margin-top: -25px">
                        @if (isset($card_type))
                            @foreach ($card_type as $type)
                                <li>
                                    <div class="link" onclick='getCard("{{ $type->name }}")'>{{ $type->name }}<i
                                            class="uil uil-angle-down"></i></div>
                                    <ul class="submenu">
                                        @if (isset($arr_sub_card_type))
                                            @for ($i = 0; $i < count($arr_sub_card_type); $i++)
                                                @if (isset($arr_sub_card_type[$type->name . '-' . $i]))
                                                    <li><a href="#"
                                                            onclick="getCardDetail('{{ str_replace(' ', '', $arr_sub_card_type[$type->name . '-' . $i]) }}')">{{ $arr_sub_card_type[$type->name . '-' . $i] }}</a>
                                                    </li>
                                                @endif
                                            @endfor
                                        @endif
                                    </ul>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-7">
                            <h6 class="text_td_thegame_ud" style="margin-top: 0;">chọn loại thẻ</h6>
                        </div>
                        <div class="col-lg-5 ">
                            <input id="search_sub_card_type" type="text" class="form-control"
                                                style="margin-top: -20px " placeholder="Tìm kiếm. . . "></b>
                        </div>
                    </div>
                    <div class="tab-wrapper">
                        <ul class="list_all_the_game_udrt">
                            @if (isset($cards))
                                @foreach ($cards as $card)
                                    <li id="cateId_{{ $card->id }}"
                                        class="cateId {{ $card->card_type }} {{ str_replace(' ', '', $card->sub_card_type->name) }}">
                                        <a href="#" onclick="cate('{{ $card->id }}', '{{ $card->name }}')"
                                            class="cate" id="{{ $card->id }}">
                                            <img class="lazyload" src="{{ asset($card->image) }}"
                                                style="max-width:85px; height: 50px;" alt="">
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <h6 class="text_td_thegame_ud">Chọn mệnh giá và số lượng</h6>
                        <span class="text_td_thegame_luachon_ud" id="Provider"></span>
                        @if (isset($cards))
                            @foreach ($cards as $card)
                                <div class="cardInfo" id="card{{ $card->id }}" style="display: none">
                                    <ul class="list_all_menhgia_thegame_udrt" id="ul_Product">
                                        @for ($i = 0; $i < count(json_decode($card->price)); $i++)
                                            <li id="proId_{{ $i }}_{{ $card->id }}" class="proId">
                                                <a href="#"
                                                    onclick="card('{{ $i }}', '{{ json_decode($card->price)[$i] }}', '{{ $card->id }}', '{{ json_decode($card->discount)[$i] }}')"><b>{{ number_format(json_decode($card->price)[$i]) }}
                                                        VNĐ</b><span>Giá bán:
                                                        {{ number_format(json_decode($card->price)[$i] - (json_decode($card->price)[$i] * json_decode($card->discount)[$i]) / 100) }}
                                                        VNĐ</span></a>
                                            </li>
                                            <input type="hidden"
                                                id="discount_number_{{ $card->id }}_{{ json_decode($card->price)[$i] }}"
                                                value="{{ json_decode($card->discount)[$i] }}" name="discount_num">
                                        @endfor
                                    </ul>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="all_so_luong_the">
                        <b>Số lượng:</b>
                        <em class="subquan" onClick='decreaseCount(event, this)'><svg enable-background="new 0 0 10 10"
                                viewBox="0 0 10 10" x="0" y="0">
                                <polygon fill="white" points="4.5 4.5 3.5 4.5 0 4.5 0 5.5 3.5 5.5 4.5 5.5 10 5.5 10 4.5">
                                </polygon>
                            </svg></em>
                        <input type="text" id="quantity" name="" onkeypress="return utils.checkOnlyNumber(this, event);"
                            min="1" value="1" disabled="disabled">
                        <em class="addquan" id="123" onClick='increaseCount(event, this)'><svg
                                enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0">
                                <polygon fill="white"
                                    points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5">
                                </polygon>
                            </svg></em>
                    </div>
                    <div class="clear"></div>
                    <h6 class="text_td_thegame_ud" style="margin-bottom:0;"></h6>
                </div>
                <!--/column -->
                <div class="col-lg-3 col-md-8 col-sm-12 col-xs-12">
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
                                    <td>Giảm giá :</td>
                                    <td id="discount_num2"></td>
                                </tr>
                                <tr style="text-align: left">
                                    <td>Mã giảm giá :</td>
                                    <td><b><input id="discount_code_use" type="text" class="form-control"
                                                style="width: 150px;" placeholder="Mã giảm giá. . . "></b></td>

                                </tr>
                                <tr style="text-align: left">
                                    <td>Giảm giá (theo mã) :</td>
                                    <td id="discount_code2"></td>

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

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#select_sub_card_type').on('keyup', function() {
                var selected_sub_card = $('#select_sub_card_type').val();
                if (selected_sub_card == 0) {
                    $('.cateId').removeAttr("style");
                    $('.cardInfo').attr("style", "display:none");
                    $('#card_info').html('');
                    $('#quantity2').html('');
                    $('#discount_num2').html('');
                    $('#price').html('');
                    $('#total').html('');
                }
                else
                {
                    $('.cateId').attr("style", "display:none");
                    $('.cardInfo').attr("style", "display:none");
                    $('.' + selected_sub_card).removeAttr("style");
                    $('#card_info').html('');
                    $('#quantity2').html('');
                    $('#discount_num2').html('');
                    $('#price').html('');
                    $('#total').html('');
                }
            })

            $('#search_sub_card_type').on('keyup', function () {
                var keyword = $(this).val();
                console.log(keyword);

                $.ajax({
                    url: "{{ route('live.search.card') }}",
                    method: 'GET',
                    data: {
                        key: keyword,
                    },
                    success: function (data){
                        if(data.success == true){
                            $('.list_all_the_game_udrt').html(data.data_ul);
                        }

                    }
                })
            })

            $('#discount_code_use').on('keyup', function () {
                var discount_value = $('#discount_code_use').val();

                $.ajax({
                    url: "{{ route('check.discount.code') }}",
                    method: 'GET',
                    data: {
                        discount_code: discount_value
                          },
                    success: function (data)
                    {
                        if(data.success == true){
                            if(data.type == 'Cố định'){
                                $('#discount_code2').html(data.discount+' VNĐ');
                                $('#discount_code_input2').attr('value', data.discount.replace(',', ''));
                                $('#discount_code_type2').attr('value', 'VNĐ');

                                var price = $('#subject').val();
                                var quantity = $('#quantity1').val();
                                var discount_num = $('#discount_num').val();

                                if(discount_num == '' && price != ''){

                                    $('#total').html(Number( quantity * (price - data.discount.replace(',', ''))).toString().replace(
                                    /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
                                }
                                else if(discount_num != '' && price != ''){
                                    if((price * discount_num / 100) > data.discount.replace(',', '')){
                                        $('#total').html(Number( quantity * (price - price * discount_num / 100)).toString().replace(
                                        /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
                                    }
                                    else
                                    {
                                        $('#total').html(Number( quantity * (price - data.discount.replace(',', ''))).toString().replace(
                                        /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
                                    }
                                }

                            }
                            else if(data.type == 'Phần trăm')
                            {
                                $('#discount_code2').html(data.discount+' %');
                                $('#discount_code_input2').attr('value', data.discount.replace(',', ''));
                                $('#discount_code_type2').attr('value', '%');

                                var price = $('#subject').val();
                                var quantity = $('#quantity1').val();
                                var discount_num = $('#discount_num').val();

                                if(discount_num == '' && price != ''){

                                    $('#total').html(Number( quantity * (price - price * data.discount / 100)).toString().replace(
                                    /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
                                }
                                else if(discount_num != '' && price != ''){
                                    if((price * discount_num / 100) > (price * data.discount / 100)){
                                        $('#total').html(Number( quantity * (price - price * discount_num / 100)).toString().replace(
                                        /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
                                    }
                                    else
                                    {
                                        $('#total').html(Number( quantity * (price - price * data.discount / 100)).toString().replace(
                                        /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
                                    }
                                }
                            }

                        }
                        else
                        {
                            $('#discount_code2').html('');
                            $('#discount_code_input2').attr('value', '');
                            $('#discount_code_type2').attr('value', '');

                            var price = $('#subject').val();
                            var quantity = $('#quantity1').val();
                            var discount_num = $('#discount_num').val();

                            if(price != ''){
                                $('#total').html(Number( quantity * (price - price * discount_num / 100)).toString().replace(
                                /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
                            }
                        }
                    }
                })
            })

        })
        function getAllCard() {
            $('.cateId').removeAttr("style");
            $('.cardInfo').attr("style", "display:none");
            $('#card_info').html('');
            $('#quantity2').html('');
            $('#discount_num2').html('');
            $('#price').html('');
            $('#total').html('');
        }

        function getCard(name) {
            $('.cateId').attr("style", "display:none");
            $('.cardInfo').attr("style", "display:none");
            $('.' + name).removeAttr("style");
            $('#card_info').html('');
            $('#quantity2').html('');
            $('#discount_num2').html('');
            $('#price').html('');
            $('#total').html('');
        }

        function getCardDetail(name) {
            $('.cateId').attr("style", "display:none");
            $('.cardInfo').attr("style", "display:none");
            $('.' + name).removeAttr("style");
            $('#card_info').html('');
            $('#quantity2').html('');
            $('#discount_num2').html('');
            $('#price').html('');
            $('#total').html('');
        }

        function cate(number, name) {
            var card_id = number;
            $('.cate').removeAttr("style");
            $('#' + card_id + '').attr("style", "border: solid 2px #0475c5;");
            $('#price').html('');
            $('#total').html('');
            $('#discount').attr("value", '');
            $('.cardInfo').attr("style", "display:none");
            $('#card' + card_id + '').removeAttr("style");
            $('#card_id_info').attr("value", number);
            $('#card_info').html(name);
            $('#subject').attr("value", '');
            $('.ac_chon_mg_these').removeClass('ac_chon_mg_these');
        }

        function submitForm() {
            if ($('#card_id_info').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Vui lòng chọn loại thẻ',
                    showConfirmButton: false,
                    timer: 2000
                })
            } else if ($('#subject').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Vui lòng chọn mệnh giá',
                    showConfirmButton: false,
                    timer: 2000
                })
            } else {
                $('#discount_code').attr("value", $('#discount_code_use').val());
                $('#form').submit();
            }
        }

        function card(id, price, id_card, discount) {
            var quantity = $('#quantity1').val();
            var discount_code_value = $('#discount_code_input2').val();
            var discount_code_type = $('#discount_code_type2').val();

            $('.ac_chon_mg_these').removeClass('ac_chon_mg_these');
            $('#proId_' + id + '_' + id_card + '').attr('class', 'ac_chon_mg_these');
            $('#subject').attr("value", price);
            $('#discount').attr("value", price - price * discount / 100)
            $('#discount_num').attr("value", $('#discount_number_' + id_card + '_' + price + '').val());
            $('#price').html(Number(price).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');

            if(discount_code_value == 0 && discount_code_type == 0)
            {
                $('#total').html(Number(quantity * (price - price * discount / 100)).toString().replace(
                /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
            }
            else if(discount_code_value != 0 && discount_code_type == '%')
            {
                if((price * discount / 100) > (price * discount_code_value / 100))
                {
                    $('#total').html(Number(quantity * (price - price * discount / 100)).toString().replace(
                    /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
                }
                else
                {
                    $('#total').html(Number(quantity * (price - price * discount_code_value / 100)).toString().replace(
                    /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
                }
            }
            else if(discount_code_value != 0 && discount_code_type == 'VNĐ')
            {
                if((price * discount / 100) > discount_code_value)
                {
                    $('#total').html(Number(quantity * (price - price * discount / 100)).toString().replace(
                    /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
                }
                else
                {
                    $('#total').html(Number(quantity * (price - discount_code_value)).toString().replace(
                    /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ');
                }
            }

            $('#discount_num2').html($('#discount_number_' + id_card + '_' + price + '').val() + ' %');
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
            document.getElementById("total").innerHTML = Number(input.value * discount).toString().replace(
                /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ';
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
                document.getElementById("total").innerHTML = Number(input.value * discount).toString().replace(
                    /(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' VNĐ';
            }


        }

        $(function() {
            var Accordion = function(el, multiple) {
                this.el = el || {};
                this.multiple = multiple || false;

                // Variables privadas
                var links = this.el.find('.link');
                // Evento
                links.on('click', {
                    el: this.el,
                    multiple: this.multiple
                }, this.dropdown)
            }

            Accordion.prototype.dropdown = function(e) {
                var $el = e.data.el;
                $this = $(this),
                    $next = $this.next();

                $next.slideToggle();
                $this.parent().toggleClass('open');

                if (!e.data.multiple) {
                    $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
                };
            }

            var accordion = new Accordion($('#accordion'), false);
        });
    </script>
@stop
