<ul class="navbar-nav bg-white sidebar accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/smk2.png') }}" alt="" width="40" height="39"
                class="d-inline-block align-text-TOP">
        </div>
       <div class="sidebar-brand-text mx-3">SIM PKL</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @if (session('role') == 'Admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-light py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Master</h6>
                <a class="collapse-item" href="{{url('datasiswaPKL')}}">Siswa PKL</a>
                <a class="collapse-item" href="cards.html">Guru Monitoring</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('datasiswaPKL')}}">
        <i class="fas fa-fw fa-users"></i>
            <span>Data Siswa PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('tahunajaran')}}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Manajemen Tahun Ajaran</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('manajemenuser')}}">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>Manajemen User</span></a>
    </li>
    @endif

    @if (session('role') == 'Ketua Pokja PKL')
    <li class="nav-item">
        <a class="nav-link" href="{{route('datasiswaPKL.lihat')}}">
            <i class="fa-solid fa-screen-users"></i>
            <span>Daftar Siswa PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-light py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Master</h6>
                <a class="collapse-item" href="{{url('datasiswaPKL')}}">Siswa PKL</a>
                <a class="collapse-item" href="cards.html">Guru Monitoring</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('tahunajaran')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Manajemen Tahun Ajaran</span></a>
    </li>
    @endif

    @if (session('role') == 'Kaprog')
    <li class="nav-item">
        <a class="nav-link" href="{{route('datasiswaPKL.index')}}">
            <i class="fa-solid fa-screen-users"></i>
            <span>Daftar Siswa PKL</span></a>
    </li>
    @endif

    @if (session('role') == 'Tata Usaha')
    <li class="nav-item">
        <a class="nav-link" href="{{route('datasiswaPKL.index')}}">
            <i class="fa-solid fa-screen-users"></i>
            <span>Daftar Siswa PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-light py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Master</h6>
                <a class="collapse-item" href="{{url('datasiswaPKL')}}">Siswa PKL</a>
                <a class="collapse-item" href="cards.html">Guru Monitoring</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('tahunajaran')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Manajemen Tahun Ajaran</span></a>
    </li>
    @endif

    @if (session('role') == 'Siswa')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengajuan PKL</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-light py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengajuan PKL</h6>
                <a class="collapse-item" href="#">Form Pengajuan PKL</a>
                <a class="collapse-item" href="#">Daftar Pengajuan PKL</a>
                <a class="collapse-item" href="#">Konfirmasi Pengajuan PKL</a>
            </div>
        </div>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>