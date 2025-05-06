 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-file"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-Raport</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.guru.index') }}">
            <span>Data Guru</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.peserta-didik.index') }}">
            <span>Data Siswa</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.kelas.index') }}">
            <span>Kelas</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.muatan-pelajaran.index') }}">
            <span>Muatan Pelajaran</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.profile.edit') }}">
            <span>Pengaturan</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
