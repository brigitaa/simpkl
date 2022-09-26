<x-app-layout>
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Kaprog</h1>
    </div>
    <h6 class="font-weight-bold text-gray-800 mb-4">Selamat Datang di Sistem Informasi Manajemen Praktik Kerja Lapangan, {{ Auth::user()->name }} </h6>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">Periode PKL</div>
            </div>
            <div class="row">
                <div class="col-4">
                <form action="{{route('dashboard.kaprog')}}" method="GET">
                    <div class="form-group">
                        <select class="form-control select2" id="filter_periode" name="tanggal_mulai">
                            <option value="">Semua</option>
                            @foreach($periode as $key => $value)
                                <option value="{{Carbon\Carbon::parse($value->tanggal_mulai)->format('Y-m-d')}}">{{$value->tanggal_mulai}} s/d {{$value->tanggal_selesai}}</option>
                            @endforeach
                        </select>
                        <script>document.getElementById('filter_periode').value = "<?php if (isset($_GET['tanggal_mulai']) && $_GET['tanggal_mulai']) echo $_GET['tanggal_mulai'];?>";</script>
                    </div>
                </div>
                <div>
                    <button id="filter" type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-1">
                        <a class="btn btn-danger" href="{{route('dashboard.kaprog')}}">Reset</a>
                </div>
                </form>
            </div>
            <!-- Content Row -->
            <div class="row">

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Siswa PKL</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$siswa}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Pengajuan PKL</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalpengajuan}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-building fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pengajuan PKL disetujui</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pskaprog}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Konfirmasi Balasan DU/DI</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalkd}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Balasan DU/DI disetujui</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$kds}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Balasan DU/DI ditolak</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$kdt}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Penempatan PKL</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalpenempatan}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">PKL belum terlaksana</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pbt}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-hourglass-start fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">PKL sedang berlangsung</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$psb}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-hourglass-start fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">PKL sudah terlaksana</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pst}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
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