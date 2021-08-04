<nav style="margin-top: 15px" class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
    <div class="container-fluid py-1">
        <nav aria-label="breadcrumb">
            <h3 class="text-white font-weight-bolder ms-2">Thông tin</h3>
        </nav>
    </div>
</nav>
<!-- End Navbar -->
<div class="container-fluid">
    <div class="page-header min-height-300 border-radius-xl mt-4">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden" style="margin-top: 50px;">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ asset(Auth::user()->avatar ? Auth::user()->avatar : 'dashboard/assets/img/no_img.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                       {{ Auth::user()->name }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        Số dư : {{ Auth::user()->point }} VNĐ
                    </p>
                </div>
            </div>
    </div>
</div>