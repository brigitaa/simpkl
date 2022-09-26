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
    @if ((session('role') == 'Admin') || (session('role') == 'Ketua Pokja PKL') || (session('role') == 'Tata Usaha'))
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @endif
    @if (session('role') == 'Kaprog')
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.kaprog')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @endif
    @if (session('role') == 'Siswa')
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.siswa')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @endif

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
                <a class="collapse-item" href="{{url('datasiswaPKL')}}">Data Siswa PKL</a>
                <a class="collapse-item" href="{{url('kaprog')}}">Manajemen Kaprog</a>
                <a class="collapse-item" href="{{url('manajemenuser')}}">Manajemen User</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUmum"
            aria-expanded="true" aria-controls="collapseUmum">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Data Umum</span>
        </a>
        <div id="collapseUmum" class="collapse" aria-labelledby="headingUmum" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Umum</h6>
                <a class="collapse-item" href="{{url('kepalasekolah')}}">Data Kepala Sekolah</a>
                <a class="collapse-item" href="{{url('guru')}}">Data Guru</a>
                <a class="collapse-item" href="{{url('tahunajaran')}}">Tahun Ajaran</a>
                <a class="collapse-item" href="{{url('kompetensikeahlian')}}">Kompetensi Keahlian</a>
                <a class="collapse-item" href="{{url('kelas')}}">Kelas</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('statusPKL')}}">
            <i class="fas fa-fw fa-hourglass-half"></i>
            <span>Data Status PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('periode')}}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Manajemen Periode PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('dudi')}}">
            <i class="fas fa-fw fa-building"></i>
            <span>Manajemen DU/DI</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('pengajuanPKL.lihat')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>Daftar Pengajuan PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('konfirmasidudi.lihat')}}">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Daftar Konfirmasi DU/DI</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('gurumonitoring')}}">
            <i class="fas fa-fw fa-user-clock"></i>
            <span>Data Guru Monitoring</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('penempatanPKL')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>Daftar Penempatan PKL</span></a>
    </li>
    @endif

    @if (session('role') == 'Ketua Pokja PKL')
    <li class="nav-item">
        <a class="nav-link" href="{{route('datasiswaPKL.lihat')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Daftar Siswa PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('statusPKL')}}">
            <i class="fas fa-fw fa-hourglass-half"></i>
            <span>Data Status PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('periode')}}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Manajemen Periode PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('dudi')}}">
            <i class="fas fa-fw fa-building"></i>
            <span>Manajemen DU/DI</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('pengajuanPKL.lihat')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>Daftar Pengajuan PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('konfirmasidudi.lihat')}}">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Daftar Konfirmasi DU/DI</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('gurumonitoring')}}">
            <i class="fas fa-fw fa-user-clock"></i>
            <span>Data Guru Monitoring</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('penempatanPKL')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>Daftar Penempatan PKL</span></a>
    </li>
    @endif

    @if (session('role') == 'Kaprog')
    <li class="nav-item">
        <a class="nav-link" href="{{route('datasiswaPKL.lihat')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Daftar Siswa PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('pengajuanPKL.lihat')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>Daftar Pengajuan PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('konfirmasidudi.lihat')}}">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Daftar Konfirmasi DU/DI</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('penempatanPKL')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>Daftar Penempatan PKL</span></a>
    </li>
    @endif

    @if (session('role') == 'Tata Usaha')
    <li class="nav-item">
        <a class="nav-link" href="{{route('datasiswaPKL.lihat')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Daftar Siswa PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('pengajuanPKL.lihat')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>Daftar Pengajuan PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('konfirmasidudi.lihat')}}">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Daftar Konfirmasi DU/DI</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('gurumonitoring')}}">
            <i class="fas fa-fw fa-user-clock"></i>
            <span>Data Guru Monitoring</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('penempatanPKL')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>Daftar Penempatan PKL</span></a>
    </li>
    @endif

    @if (session('role') == 'Siswa')
    <li class="nav-item">
        <a class="nav-link" href="{{url('pengajuanPKL')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>Pengajuan PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('konfirmasidudi.index')}}">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Konfirmasi Balasan DU/DI</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('penempatanPKL.lihat')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>Penempatan PKL</span></a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>