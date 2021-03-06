<header class="wrapper">
<nav class="navbar classic navbar-expand-lg navbar-light navbar-bg-light">
	<div class="container flex-lg-row flex-nowrap align-items-center">
	<div class="navbar-brand w-100"><a href="{{ route('index') }}"><img src="{{ asset(json_decode($index->image_logo)[0]) }}" width="{{ json_decode($index->image_logo)[1] }}px" height="{{ json_decode($index->image_logo)[2] }}px" alt="" /></a></div>
	<div class="navbar-collapse offcanvas-nav">
		<div class="offcanvas-header d-lg-none d-xl-none">
		<a href="start.html"><img src="{{ asset('dev/img/logo-light.png') }}" alt="" /></a>
		<button type="button" class="btn-close btn-close-white offcanvas-close offcanvas-nav-close" aria-label="Close"></button>
		</div>
		<ul class="navbar-nav">
		<li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Trang chủ</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="{{ route('card') }}">Mua thẻ</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="{{ route('news') }}">Tin tức</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
		</li>
		</ul>
		<!-- /.navbar-nav -->
	</div>
	<!-- /.navbar-collapse -->
	<div class="navbar-other ms-lg-4" style="margin-bottom:5px;">
		<ul class="navbar-nav flex-row align-items-center ms-auto" data-sm-skip="true">
		@if (Auth::check())
			@if (Auth::user()->role	 == 1)
				<li class="nav-item ms-lg-0">
					<a href="{{ route('admin')}}"><img src="{{ asset('dev/img/person-fill.svg') }}" width="20px" height="20px" alt=""></a>			
				</li>
				<li class="nav-item ms-lg-0" style="width: 120px">
					<a href="{{ route('admin') }}"><b style="color: black; font-size: 13px; margin-left: 5px" data-toggle="tooltip" data-placement="top" title="Thông tin">{{ Auth::user()->name }}</b></a>					
					<a href="{{ route('logout') }}">
						<img src="{{ asset('dev/img/logout.svg') }}" width="20px" height="20px" alt="" style="margin-left: 10px" data-toggle="tooltip" data-placement="top" title="Đăng xuất">
					</a>
				</li>			
			@else
				<li class="nav-item ms-lg-0">
					<a href="{{ route('profile', Auth::user()->id) }}"><img src="{{ asset('dev/img/person-fill.svg') }}" width="20px" height="20px" alt=""></a>			
				</li>
				<li class="nav-item ms-lg-0" style="width: 120px">
					<a href="{{ route('profile', Auth::user()->id) }}"><b style="color: black; font-size: 13px; margin-left: 5px" data-toggle="tooltip" data-placement="top" title="Thông tin">{{ Auth::user()->name }}</b></a>					
					<a href="{{ route('logout') }}">
						<img src="{{ asset('dev/img/logout.svg') }}" width="20px" height="20px" alt="" style="margin-left: 10px" data-toggle="tooltip" data-placement="top" title="Đăng xuất">
					</a>
				</li>
			@endif
		@else
			<li class="nav-item ms-lg-0">
				<a href="{{ route('signin') }}"><img src="{{ asset('dev/img/person-fill.svg') }}" width="20px" height="20px" data-toggle="tooltip" data-placement="top" title="Đăng nhập" alt=""></a>			
			</li>
		@endif
		<li class="nav-item ms-lg-0">
			<div class="navbar-hamburger d-lg-none d-xl-none ms-auto"><button class="hamburger animate plain" data-toggle="offcanvas-nav"><span></span></button></div>
		</li>
		</ul>
		<!-- /.navbar-nav -->
	</div>
	<!-- /.navbar-other -->
	</div>
	<!-- /.container -->
</nav>
<!-- /.offcanvas-info -->
</header>
<!-- /header -->