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
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            @if ($value->status_verif_nilai == 'Sudah diverifikasi')
                                <button type="submit" class="btn btn-warning btn-sm" disabled>Ubah</button>
                            @else
                                <a class="btn btn-warning btn-sm" href="{{route('penilaianPKL.edit', $value->id)}}">Ubah</a> 
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