<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pengajuan PKL</h1>
    {{-- <a class="btn btn-success mb-3" href="{{route('pengajuanPKL.create')}}">Tambah</a> --}}

    @if ($konfirmasidudi)
        <font color="red">Ajuan PKL Anda telah disetujui oleh DU/DI</font><br>
        <button type="submit" class="btn btn-success mb-3" disabled>Tambah</button>
    @else
        <font color="grey">Silahkan mengisi form tambah pengajuan PKL</font><br>
        <a class="btn btn-success mb-3" href="{{route('pengajuanPKL.create')}}">Tambah</a>
    @endif
    

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Riwayat Pengajuan PKL</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Pengajuan PKL</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Tanggal Mulai PKL</th>
                        <th>Tanggal Selesai PKL</th>
                        <th>Nama DU/DI</th>
                        <th>Pernyataan Orang Tua</th>
                        <th>Pernyataan Siswa</th>
                        <th>Status POKJA PKL</th>
                        <th>Status Kaprog</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pengajuan as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->id}}</td>
                        <td>{{$value->nis}}</td>
                        <td>{{$value->nisn}}</td>
                        <td>{{$value->nama_siswa}}</td>
                        <td>{{$value->tanggal_mulai}}</td>
                        <td>{{$value->tanggal_selesai}}</td>
                        <td>{{$value->nama_dudi}}</td>
                        <td>
                            <a href="{{route('pengajuanPKL.file_pernyataanortu', $value->id)}}">{{$value->pernyataan_ortu}}</a>
                        </td>
                        <td>
                            <a href="{{route('pengajuanPKL.file_pernyataansiswa', $value->id)}}">{{$value->pernyataan_siswa}}</a>
                        </td>
                        <td>{{$value->status_verif_pokja}}</td>
                        <td>{{$value->status_verif_kaprog}}</td>
                        <td>
                            @if ($value->status_verif_pokja != 'Diproses' || $value->status_verif_kaprog != 'Diproses')
                                <button type="submit" class="btn btn-warning btn-sm" disabled>Ubah</button>
                                <button type="submit" class="btn btn-danger btn-sm" disabled>Hapus</button>
                            @else
                                <form action="{{ route('pengajuanPKL.destroy',$value->id) }}" method="POST">
                                    <a class="btn btn-warning btn-sm" href="{{route('pengajuanPKL.edit', $value->id)}}">Ubah</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
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

</x-app-layout>