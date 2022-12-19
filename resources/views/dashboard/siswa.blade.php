<x-app-layout>
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Siswa</h1>
    </div>
    <h6 class="font-weight-bold text-gray-800 mb-4">Selamat Datang di Sistem Informasi Manajemen Praktik Kerja Lapangan, {{ Auth::user()->name }} </h6>
    @if ($siswa)
        <div class="alert alert-danger">
            Harap isi data orang tua / wali siswa pada halaman ubah profil
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
        </div>
        <div class="card-body">
            <!-- Content Row -->
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pengajuan PKL</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pengajuan}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Pengajuan PKL disetujui Ketua Pokja PKL</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pspokja}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-dark shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Jumlah Pengajuan PKL disetujui Ketua Program Keahlian</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pskaprog}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-double fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</x-app-layout>