<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-cog"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin DISC</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_dashboard' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>admin_dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <!-- Nav Item - My Profile -->
    <li class="nav-item <?php echo ($this->uri->segment(2) == 'profile' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>admin_user/profile">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil Saya</span></a>
    </li>

    <!-- Nav Item - Users -->
    <li class="nav-item <?php echo ($this->uri->segment(2) == 'user_list' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>admin_user/user_list">
            <i class="fas fa-fw fa-users"></i>
            <span>User Web</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Test
    </div>

    <!-- Nav Item - Test Qeustion Collpapse -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_test' ? 'active' : ''); ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages1">
            <i class="fas fa-fw fa-question"></i>
            <span>Soal</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo site_url(); ?>admin_test">List Soal</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin_test/add_question">Tambah Soal</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Payment -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_payment' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>admin_payment">
            <i class="far fa-fw fa-credit-card"></i>
            <span>Pembayaran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->