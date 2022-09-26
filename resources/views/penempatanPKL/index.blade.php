<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Penempatan PKL</h1>
    {{-- <a class="btn btn-success mb-3" href="{{route('konfirmasidudi.create')}}">Tambah</a> --}}

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Penempatan PKL</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-2">Kelas</div>
            <div class="col-2">Tahun Ajaran</div>
        </div>
        <div class="row">
            <div class="col-2">
            <form action="{{route('penempatanPKL.index')}}" method="GET">
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
                    {{-- <button id="reset" type="button" class="btn btn-danger">Reset</button> --}}
                    <a class="btn btn-danger" href="{{route('penempatanPKL.index')}}">Reset</a>
            </div>
            </form>
        </div>
     
        <div class="table-responsive">
            <table class="table table-bordered" id="penempatanTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>HP</th>
                        <th>Periode PKL</th>
                        <th>Nama DU/DI</th>
                        <th>Alamat DU/DI</th>
                        <th>Guru Monitoring</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($penempatan as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->nama_siswa}}</td>
                        <td>{{$value->nama_kelas}}</td>
                        <td>{{$value->nama_thn_ajaran}}</td>
                        <td>{{$value->no_telp}}</td>
                        <td>{{Carbon\Carbon::parse($value->tanggal_mulai)->format('d-m-Y')}} s/d {{Carbon\Carbon::parse($value->tanggal_selesai)->format('d-m-Y')}}</td>
                        <td>{{$value->nama_dudi}}</td>
                        <td>{{$value->alamat_dudi}}</td>
                        <td>{{$value->nama_guru}}</td>
                        <td>
                            @if ($value->nama_status_pkl == 'Belum terlaksana')
                                <span class="badge badge-danger">{{$value->nama_status_pkl}}</span>
                            @elseif ($value->nama_status_pkl == 'Sedang berlangsung')
                                <span class="badge badge-warning">{{$value->nama_status_pkl}}</span>
                            @elseif ($value->nama_status_pkl == 'Sudah terlaksana')
                                <span class="badge badge-success">{{$value->nama_status_pkl}}</span>
                            @else
                                <span class="badge badge-secondary">{{$value->status_verif_kaprog}}</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{route('penempatanPKL.edit', $value->id)}}">Ubah</a>
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
    var table = $('#penempatanTable').DataTable({
        "scrollX": true,
        dom: '<lfB<t>ip>',
        "responsive": true,
        orderable: [
            [10, "asc"]
        ],
        lengthMenu: [
            [ 10, 25, 50, 100, 1000, -1 ],
            [ '10', '25', '50', '100', '1000', 'All' ]
        ],
        columnDefs: [
            {
                "searchable": false,
                "orderable": false,
                "targets": 10,
            },
        ],
        buttons: [
            {
                extend: 'excel',
                text: 'Ekspor',
                title: "Data Penempatan PKL SMKN 2 Balikpapan",
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    },
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            }, {
                extend: 'pdf',
                text: 'Pdf',
                title: "Data Penempatan PKL SMKN 2 Balikpapan",
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    },
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                title: "Data Penempatan PKL SMKN 2 Balikpapan",
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    },
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            }
        ]
    });
</script>
@endpush
</x-app-layout>