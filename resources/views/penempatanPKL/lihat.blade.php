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
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>