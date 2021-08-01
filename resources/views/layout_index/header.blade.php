<header class="wrapper">
<nav class="navbar classic navbar-expand-lg navbar-light navbar-bg-light">
	<div class="container flex-lg-row flex-nowrap align-items-center">
	<div class="navbar-brand w-100"><a href="start.html"><img src="{{ asset('dev/img/logo.png') }}" srcset="{{ asset('dev/img/logo@2x.png') }} 2x" alt="" /></a></div>
	<div class="navbar-collapse offcanvas-nav">
		<div class="offcanvas-header d-lg-none d-xl-none">
		<a href="start.html"><img src="{{ asset('dev/img/logo-light.png') }}" srcset="{{ asset('dev/img/logo-light@2x.png') }} 2x" alt="" /></a>
		<button type="button" class="btn-close btn-close-white offcanvas-close offcanvas-nav-close" aria-label="Close"></button>
		</div>
		<ul class="navbar-nav">
		<li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Trang chủ</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="{{ route('card') }}">Mua thẻ</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="#">Hướng dẫn</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="#">Về chúng tôi</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="#">Liên hệ</a>
		</li>
		</ul>
		<!-- /.navbar-nav -->
	</div>
	<!-- /.navbar-collapse -->
	<div class="navbar-other ms-lg-4" style="margin-bottom:5px">
		<ul class="navbar-nav flex-row align-items-center ms-auto" data-sm-skip="true">
		<li class="nav-item ms-lg-0">
			<a href="{{ route('signin') }}"><img src="{{ asset('dev/img/person-fill.svg') }}" width="20px" height="20px" alt=""></a>
		</li>
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