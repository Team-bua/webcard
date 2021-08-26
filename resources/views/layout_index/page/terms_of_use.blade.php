@extends('layout_index.master')
@section('content')
    <section class="wrapper bg-light">
        <div class="container pt-8 pt-md-10">
            <div class="page-news-detail-wrap">
                <div class="page-news-detail">
                    <div class="row-1">
                        <div class="top-article is-full">
                            <div class="text">
                                <h3><a href="#" style="color: black">ĐIỀU KHOẢN SỬ DỤNG </a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row-2">
                        <div class="content is-full">
                            <p><b>Chào mừng quý khách đến với mintritel.com.&nbsp;</b></p>
                            <p><span style="font-weight: 400;">Khi bạn truy cập vào trang web của chúng tôi có nghĩa là bạn
                                    đã đồng ý với các điều khoản này. Chúng tôi có quyền thay đổi, chỉnh sửa, thêm hoặc lược
                                    bỏ bất kỳ phần nào trong Quy định và Điều kiện sử dụng, vào bất cứ lúc nào. Các thay đổi
                                    có hiệu lực ngay khi được đăng trên trang web mà không cần thông báo trước. Và khi bạn
                                    tiếp tục sử dụng trang web, sau khi các thay đổi về Quy định và Điều kiện được đăng tải,
                                    có nghĩa là bạn chấp nhận với những thay đổi đó. Bạn vui lòng kiểm tra thường xuyên để
                                    cập nhật những thay đổi của chúng tôi.</span></p>
                            <p><b>I/ Dịch Vụ Của mintritel.com</b></p>
                            <p><span style="font-weight: 400;">mintritel thực hiện hoạt động và vận hành, cung cấp các dịch vụ
                                    trực tuyến về quà tặng thông qua việc triển khai giới thiệu các sản phẩm, dịch vụ và
                                    thực hiện các chương trình bán hàng, chương trình khuyến mại cho các sản phẩm, dịch vụ
                                    theo uỷ quyền của các thương nhân, tổ chức, cá nhân có hoạt động thương mại hợp pháp
                                    (sau đây gọi chung là “nhà bán hàng”) trên cơ sở Hợp đồng, Thoả thuận với mintritel và không
                                    trái với quy định của pháp luật hiện hành.</span></p>
                            <p><span style="font-weight: 400;">Để có thể sử dụng đầy đủ tiện ích dịch vụ trên mintritel, bạn cần
                                    phải đăng ký tạo lập một tài khoản sử dụng và cung cấp cho mintritel một số thông tin cá
                                    nhân nhất định bao gồm mà không giới hạn bởi địa chỉ email để phục vụ cho việc liên lạc
                                    giao tiếp giữa bạn và mintritel cũng như những người sử dụng khác sau này.</span></p>
                            <p><span style="font-weight: 400;">Các thông tin cá nhân của bạn sẽ được bảo quản và xử lý một
                                    cách bảo mật theo Chính Sách Bảo Mật của mintritel.</span></p>
                            <p><span style="font-weight: 400;">Bạn phải bảo vệ mật khẩu của mình và giám sát việc sử dụng
                                    các tài khoản của mình, bạn hiểu và đồng ý rằng bạn là người chịu trách nhiệm mọi thông
                                    tin cá nhân có liên quan kể cả việc sử dụng tài khoản của mìnhvà bạn phải chịu hoàn toàn
                                    trách nhiệm đối với bất cứ ai được bạn cho phép truy cập vào tài khoản của mình.</span>
                            </p>
                            <p><span style="font-weight: 400;">Bạn có thể đặt mua hàng hóa, dịch vụ theo đúng giá và quy
                                    chuẩn theo đúng cam kết của Nhà bán hàng hợp pháp đã công bố trên mintritel và việc đặt mua
                                    này của bạn sẽ tùy thuộc vào chấp thuận một phần hoặc toàn bộ điều kiện đặt hàng này của
                                    mintritel.</span></p>
                            <p><span style="font-weight: 400;">Việc chấp thuận này của mintritel chỉ có hiệu lực ràng buộc khi
                                    bạn đã thanh toán hoặc các thông tin về thanh toán của bạn đã được xác nhận.</span></p>
                            <p><b>II/ Điều Khoản Về Sử Dụng Dịch Vụ</b></p>
                            <p><b>2.1. Quy trình Đặt Mua Và Thanh Toán</b></p>
                            <p><span style="font-weight: 400;">Khi có nhu cầu mua hàng, sử dụng dịch vụ trên mintritel, quý
                                    khách có thể liên hệ với mintritel thông qua các kênh sau:</span></p>
                            <p><span style="font-weight: 400;">– Hotline: 1900 299 232</span></p>
                            <p><span style="font-weight: 400;">– E-mail:</span> <span
                                    style="font-weight: 400;">mintritel@gmail.com</span></p>
                            <p><span style="font-weight: 400;">– Facebook: https://www.facebook.com/mintritel.vn/</span></p>
                            <p><b>2.2. Quy trình nhận hàng:</b></p>
                            <p><span style="font-weight: 400;">Khách hàng sẽ trang thông tin cá nhân để xem mã thẻ</span></p>
                            <p><span style="font-weight: 400;">Hướng dẫn sử dụng mintritel, vui lòng xem</span><a
                                    href="#">
                                    <span style="font-weight: 400;">tại đây</span></a><span
                                    style="font-weight: 400;">.</span></p>
                            {{-- <p><b>2.3. Quy trình giao nhận vận chuyển:</b></p>
                            <p><span style="font-weight: 400;">Khách hàng sau khi thanh toán trực tuyến sẽ gửi Voucher điện
                                    tử cho người nhận quà tặng qua email hoặc số điện thoại..</span></p>
                            <p><span style="font-weight: 400;">Sau đó người nhận được Voucher điện tử sẽ đem đến các Địa
                                    Điểm sử dụng Voucher Điện Tử để đổi lấy sản phẩm, sử dụng dịch vụ.</span></p>
                            <p><span style="font-weight: 400;">Do vậy, về nguyên tắc Sàn Giao Dịch không phải thực hiện vận
                                    chuyển sản phẩm đến Khách hàng.</span></p>
                            <p><span style="font-weight: 400;">Đối với các sản phẩm có áp dụng giao hàng, việc giao hàng sẽ
                                    do bên đối tác, thương nhân, cá nhân mintritel hợp tác đảm nhiệm.</span></p>
                            <p><b>2.4. Thời hạn của sử dụng của thẻ, đường dẫn (link) quà tặng mintritel:</b></p>
                            <p>Thời hạn sử dụng của thẻ/ đường dẫn quà tặng mintritel là một năm kể từ ngày thẻ/ đường dẫn quà
                                tặng mintritel được phát hành.</p>
                            <p>Trường hợp khách hàng có yêu cầu gia hạn thời gian sử dụng thẻ/ đường dẫn quà tặng mintritel cần
                                được thông báo ít nhất 30 ngày trước thời điểm hết hạn của thẻ/ đường dẫn quà tặng mintritel.
                                Thời gian gia hạn thời gian sử dụng tối đa là thêm 30 ngày tính từ ngày hết hạn của thẻ/
                                đường dẫn quà tặng mintritel.</p>
                            <p><b>2.5. Chính sách đổi trả sản phẩm/dịch vụ:</b></p>
                            <p><span style="font-weight: 400;">Sau khi bạn đã thanh toán các sản phẩm, dịch vụ đã đặt mua,
                                    chúng tôi sẽ không chấp nhận bất kỳ yêu cầu tạm ngưng hoặc hủy bỏ các sản phẩm, dịch vụ
                                    đã đặt mua, hoặc hoàn tiền, hoặc thay đổi dịch vụ.</span></p>
                            <p><span style="font-weight: 400;">Sau khi bạn nhận sản phẩm, dịch vụ từ các Địa Điểm sử dụng
                                    Voucher điện tử, bạn có thể đổi trả sản phẩm, dịch vụ theo quy chế, quy định của Nhà Bán
                                    Hàng cung cấp sản phẩm, dịch vụ đó.</span></p>
                            <p><span style="font-weight: 400;">Voucher Điện Tử do mintritel phát hành cho khách hàng không có
                                    giá trị quy đổi ra tiền mặt.</span></p> --}}
                            <p><b>III/ Điều Khoản Áp Dụng</b></p>
                            <p><span style="font-weight: 400;">mintritel có quyền và có thể thay đổi Quy chế này bằng cách thông
                                    báo cho tất cả các Khách hàng và Nhà bán hàng, đối tượng sử dụng dịch vụ mintritel ít nhất 5
                                    ngày trước khi áp dụng những thay đổi đó.</span></p>
                            <p><span style="font-weight: 400;">Việc thành viên tiếp tục sử dụng dịch vụ sau khi Quy chế sửa
                                    đổi được công bố và thực thi đồng nghĩa với việc thành viên đã chấp nhận Quy chế sửa đổi
                                    này.</span></p>
                            <p><span style="font-weight: 400;">Khách hàng và Nhà bán hàng tham gia mintritel có trách nhiệm tuân
                                    theo quy chế hiện hành khi giao dịch trên website.</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
