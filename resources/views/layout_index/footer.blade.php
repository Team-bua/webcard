<footer class="bg-dark text-inverse">
<div class="container py-13 py-md-15">
	<div class="row gy-6 gy-lg-0">
	<div class="col-md-4 col-lg-4">
		<div class="widget">
		<img class="mb-4" src="{{ asset(json_decode($index->image_logo)[0]) }}" width="{{ json_decode($index->image_logo)[1] }}px" height="{{ json_decode($index->image_logo)[2] }}px" alt="" />
		<p class="mb-4">Giấy Chứng nhận ĐKKD số 0315396644, cấp ngày 19/11/2018 tại Hồ Chí Minh </p>
		<nav class="nav social social-white">
			<a href="#"><i class="uil uil-twitter"></i></a>
			<a href="#"><i class="uil uil-facebook-f"></i></a>
			<a href="#"><i class="uil uil-dribbble"></i></a>
			<a href="#"><i class="uil uil-instagram"></i></a>
			<a href="#"><i class="uil uil-youtube"></i></a>
		</nav>
		<!-- /.social -->
		</div>
		<!-- /.widget -->
	</div>
	<!-- /column -->
	<div class="col-md-4 col-lg-4">
		<div class="widget">
		<h4 class="widget-title text-white mb-3">Liên hệ</h4>
		<address class="pe-xl-15 pe-xxl-17"><i class="uil uil-location-pin-alt"></i> {{ $index->address_contact }}</address>
		<i class="uil uil-envelope"></i><a href="mailto:{{ $index->email_contact }}"> {{ $index->email_contact }}</a><br> <i class="uil uil-phone-volume"></i> {{ $index->phone_contact }}
		</div>
		<!-- /.widget -->
	</div>
	<!-- /column -->
	<div class="col-md-4 col-lg-4">
		<div class="widget">
		<h4 class="widget-title text-white mb-3">Tìm hiểu thêm</h4>
		<ul class="list-unstyled mb-0">
			<li><a href="{{ route('contact') }}">Hỗ trợ 24/7</a></li>
			<li><a href="{{ route('termOfUse') }}">Điều khoản sử dụng</a></li>
			<li><a href="{{ route('privacy') }}">Chính sách bảo mật</a></li>
		</ul>
		</div>
		<!-- /.widget -->
	</div>
	<!-- /column -->
	</div>
	<div class="footer-copyright-area section-space--pb_30" style="margin-top: 20px">
			<div class="row align-items-center">
				<div class="col-md-8 text-md-left">
					<span class="copyright-text">© Bản quyền thuộc về Công ty TNHH Thương Mại & Dịch Vụ Viễn Thông Minh Trí Tel</span>
				</div>
			</div>
	</div>
	<!--/.row -->
</div>
<!-- /.container -->
</footer>