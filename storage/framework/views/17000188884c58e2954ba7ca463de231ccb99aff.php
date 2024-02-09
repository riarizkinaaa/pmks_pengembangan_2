<header class="main-nav">

    <div class="sidebar-user text-center">
        <a href="user-profile.html">
            <p class="mb-0 font-roboto">selamat datang<?php echo e(Session::get('nama_kecamatan')); ?></p>
            <h6 class="mt-3 f-14 f-w-600 text-uppercase"><?php echo e(Auth::user()->username); ?></h6>
        </a>
        <?php if(Auth::user()->id_role ==1): ?>
        <p class="mb-0 font-roboto">Superadmin</p>
        <?php elseif(Auth::User()->id_role ==2): ?>
        <p class="mb-0 font-roboto">Pimpinan</p>
        <?php elseif(Auth::User()->id_role ==3): ?>
        <p class="mb-0 font-roboto">Verifikator</p>
        <?php elseif(Auth::User()->id_role ==4): ?>
        <p class="mb-0 font-roboto">Pendata</p>
        <?php endif; ?>
        
       
    </div>
    <nav class="mt-3">
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('dashboard_survior')); ?>" href="<?php echo e(route('dashboard_survior')); ?>"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <!-- <li class="sidebar-main-title">
                        <div>
                            <h6>Anak</h6>
                        </div>
                    </li> -->
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('anak_pendata.index')); ?>" href="<?php echo e(route('anak_pendata.index')); ?>"><i data-feather="user"></i><span>Data Anak</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('index')); ?>" href="<?php echo e(route('kontak')); ?>"><i data-feather="phone-call"></i><span>Kontak</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title  <?php echo e(routeActive('data_survior.index')); ?>" href="<?php echo e(route('data_survior.index')); ?>"><i data-feather="user"></i><span>Profile</span></a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header><?php /**PATH C:\Users\ASUS\Music\skripsi\pmks-anak-yatim\resources\views/layouts/survior/partials/sidebar.blade.php ENDPATH**/ ?>