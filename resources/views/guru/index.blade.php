<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen Guru</h1>
    <a class="btn btn-success mb-3" href="{{route('guru.create')}}">Tambah</a>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Guru</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIP</th>
                        <th>Nama Lengkap</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($guru as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->nip}}</td>
                        <td>{{$value->nama_guru}}</td>
                        <td>{{$value->no_telp_guru}}</td>
                        <td>{{$value->alamat}}</td>
                        <td>
                            <form action="{{ route('guru.destroy',$value->id) }}" method="POST">
                                <a class="btn btn-warning btn-sm" href="{{route('guru.edit', $value->id)}}">Ubah</a>
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</x-app-layout>