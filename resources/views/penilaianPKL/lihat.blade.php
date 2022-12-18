<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Penilaian PKL</h1>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Penilaian PKL</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-2">Kelas</div>
            <div class="col-2">Tahun Ajaran</div>
        </div>
        <div class="row">
            <div class="col-2">
            <form action="{{route('penilaianPKL.lihat')}}" method="GET">
                <div class="form-group">
                    <select class="form-control select2" id="filter_kelas" name="nama_kelas">
                        <option value="">Semua</option>
                        @foreach($kelas as $key => $value)
                            <option value="{{$value->nama_kelas}}">{{$value->nama_kelas}}</option>
                        @endforeach
                    </select>
                    <script>document.getElementById('filter_kelas').value = "<?php if (isset($_GET['nama_kelas']) && $_GET['nama_kelas']) echo $_GET['nama_kelas'];?>";</script>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control select2" id="filter_tahunajaran" name="nama_thn_ajaran">
                        <option value="">Semua</option>
                        @foreach($tahunajaran as $key => $value)
                            <option value="{{$value->nama_thn_ajaran}}">{{$value->nama_thn_ajaran}}</option>
                        @endforeach
                    </select>
                    <script>document.getElementById('filter_tahunajaran').value = "<?php if (isset($_GET['nama_thn_ajaran']) && $_GET['nama_thn_ajaran']) echo $_GET['nama_thn_ajaran'];?>";</script>
                </div>
            </div>
            <div>
                    <button id="filter" type="submit" class="btn btn-primary">Filter</button>
            </div>
            <div class="col-1">
                    <a class="btn btn-danger" href="{{route('penilaianPKL.lihat')}}">Reset</a>
            </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="penilaianTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Periode PKL</th>
                        <th>Nama DU/DI</th>
                        <th>Alamat DU/DI</th>
                        <th>Sertifikat</th>
                        <th>Nilai</th>
                        <th>Status Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($penilaian as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->nama_siswa}}</td>
                        <td>{{$value->nama_kelas}}</td>
                        <td>{{$value->nama_thn_ajaran}}</td>
                        <td>{{Carbon\Carbon::parse($value->tanggal_mulai)->format('d-m-Y')}} s/d {{Carbon\Carbon::parse($value->tanggal_selesai)->format('d-m-Y')}}</td>
                        <td>{{$value->nama_dudi}}</td>
                        <td>{{$value->alamat_dudi}}</td>
                        <td>
                            <a href="{{route('penilaianPKL.file_sertifikat', $value->id)}}">{{$value->sertifikat}}</a>
                        </td>
                        <td>{{$value->nilai}}</td>
                        <td>
                            @if ($value->status_verif_nilai == 'Sudah diverifikasi')
                                <span class="badge badge-success">{{$value->status_verif_nilai}}</span>
                            @else
                                <span class="badge badge-danger">{{$value->status_verif_nilai}}</span>
                            @endif
                        </td>
                        <td>
                            @if ($value->status_verif_nilai == 'Belum diverifikasi')
                                <form action="{{ route('penilaianPKL.verifikasi_nilai',$value->id) }}" method="POST">
                                @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Verifikasi</button>
                                </form>
    
                            @else
                                <form action="{{ route('penilaianPKL.batal_verifikasi_nilai',$value->id) }}" method="POST">
                                @csrf
                                    <button type="submit" class="btn btn-dark btn-sm">Batal</button>
                                </form>

                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var table = $('#penilaianTable').DataTable({
        "scrollX": true,
        dom: '<lfB<t>ip>',
        "responsive": true,
        orderable: [
            [8, "asc"]
        ],
        lengthMenu: [
            [ 10, 25, 50, 100, 1000, -1 ],
            [ '10', '25', '50', '100', '1000', 'All' ]
        ],
        columnDefs: [
            {
                "searchable": false,
                "orderable": false,
                "targets": 8,
            },
        ],
        buttons: [
            {
                extend: 'excel',
                text: 'Ekspor',
                title: "Data Penilaian PKL SMKN 2 Balikpapan",
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    },
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            }, {
                extend: 'pdf',
                text: 'Pdf',
                title: "Data Penilaian PKL SMKN 2 Balikpapan",
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    },
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                title: "Data Penilaian PKL SMKN 2 Balikpapan",
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    },
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            }
        ]
    });
</script>
@endpush
</x-app-layout>