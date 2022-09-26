<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Konfirmasi Balasan DU/DI</h1>
    <a class="btn btn-success mb-3" href="{{route('konfirmasidudi.create')}}">Tambah</a>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Konfirmasi DU/DI</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>ID Pengajuan PKL</th>
                        <th>Tanggal Mulai PKL</th>
                        <th>Tanggal Selesai PKL</th>
                        <th>Nama DU/DI</th>
                        <th>Surat Balasan DU/DI</th>
                        <th>Status</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                @foreach($konfirmasidudi as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->nis}}</td>
                        <td>{{$value->nisn}}</td>
                        <td>{{$value->nama_siswa}}</td>
                        <td>{{$value->pengajuan_id}}</td>
                        <td>{{$value->tanggal_mulai}}</td>
                        <td>{{$value->tanggal_selesai}}</td>
                        <td>{{$value->nama_dudi}}</td>
                        <td>
                            <a href="{{route('konfirmasidudi.file_balasandudi', $value->id)}}">{{$value->balasan_dudi}}</a>
                        </td>
                        <td>
                            @if ($value->status == 'Disetujui')
                                <span class="badge badge-success">{{$value->status}}</span>
                            @else
                                <span class="badge badge-danger">{{$value->status}}</span>
                            @endif
                        </td>
                        {{-- <td>
                            <form action="{{ route('konfirmasidudi.destroy',$value->id) }}" method="POST">
                                <a class="btn btn-warning btn-sm" href="{{route('konfirmasidudi.edit', $value->id)}}">Ubah</a>
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</x-app-layout>