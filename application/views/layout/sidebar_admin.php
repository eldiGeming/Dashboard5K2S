<!-- partial:partials/_sidebar.html -->
<div class="container-scroller">
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile border-bottom">
        <a href="#" class="nav-link flex-column">
         
          <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
              <!-- Menampilkan nama pengguna dari session -->
              <span class="font-weight-semibold mb-1 mt-2 text-center"><?php echo $username; ?></span>
              <!-- Menampilkan role pengguna dari session -->
              <span class="text-secondary icon-sm text-center">
                <?php 
                if ($role == 1) {
                    echo 'Admin';
                } else {
                    // Ambil nama kelas langsung dari data['kelas'] jika ada
                    if (!empty($kelas)) {
                        // Ambil nama kelas pertama (sesuaikan jika user bisa memiliki lebih dari satu kelas)
                        echo 'Koordinator Kelas ' . $kelas[0]->nama_kelas;
                    } else {
                        echo '(Belum Ada Kelas)';
                    }
                }
                ?>
            </span>

            </span>
          </div>
        </a>
      </li>
      <li class="nav-item pt-3">
        <!-- <a class="nav-link d-block" href="index.html">
          <img class="sidebar-brand-logo" src="<?= base_url('assets/images/logo.svg'); ?>" alt="" />
          <img class="sidebar-brand-logomini" src="<?= base_url('assets/images/logo-mini.svg'); ?>" alt="" />
        </a>
        <form class="d-flex align-items-center" action="#">
          <div class="input-group">
            <div class="input-group-prepend">
              <i class="input-group-text border-0 mdi mdi-magnify"></i>
            </div>
            <input type="text" class="form-control border-0" placeholder="Search" />
          </div>
        </form> -->
      </li>
      <li class="pt-2 pb-1">
        <span class="nav-item-head">Menu</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('dashboard'); ?>">
          <i class="mdi mdi-home-outline menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('competition'); ?>">
          <i class="mdi mdi-trophy menu-icon"></i>
          <span class="menu-title">Penilaian Kompetisi</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('class'); ?>">
          <i class="mdi mdi-book-variant menu-icon"></i>
          <span class="menu-title">Kelas Saya</span>
        </a>
      </li>

    </ul>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
    <div id="theme-settings" class="settings-panel">
      <i class="settings-close mdi mdi-close"></i>
      <p class="settings-heading">SIDEBAR SKINS</p>
      <div class="sidebar-bg-options selected" id="sidebar-default-theme">
        <div class="img-ss rounded-circle bg-light border mr-3"></div>Default
      </div>
      <div class="sidebar-bg-options" id="sidebar-dark-theme">
        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
      </div>
      <p class="settings-heading mt-2">HEADER SKINS</p>
      <div class="color-tiles mx-0 px-4">
        <div class="tiles default primary"></div>
        <div class="tiles success"></div>
        <div class="tiles warning"></div>
        <div class="tiles danger"></div>
        <div class="tiles info"></div>
        <div class="tiles dark"></div>
        <div class="tiles light"></div>
      </div>
    </div>
    <!-- partial -->
    <!-- partial:partials/_navbar.html -->
		<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<div class="navbar-menu-wrapper d-flex align-items-stretch">
				<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
					<span class="mdi mdi-chevron-double-left"></span>
				</button>
				<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
					<a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
				</div>
				<ul class="navbar-nav navbar-nav-right">
					<li class="nav-item nav-logout d-none d-md-block me-3">
						<?php echo anchor(
                  'Dashboard/logout', 
                  '<i class="mdi mdi-logout"></i> Logout',
                  ['class' => 'nav-link btn btn-sm']
              ); ?>
					</li>
				</ul>
				<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
					<span class="mdi mdi-menu"></span>
				</button>
			</div>
		</nav>
