<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Siswa PKL</h1>
    <a class="btn btn-success mb-3" href="{{route('datasiswaPKL.impor')}}">Impor</a>
    <a class="btn btn-success mb-3" href="{{route('datasiswaPKL.create')}}">Tambah</a>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Siswa PKL</h6>
    </div>
    <div class="card-body">
        <div class="row">
                <div class="col-2">Kelas</div>
                <div class="col-2">Tahun Ajaran</div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control select2" id="filter_kelas">
                        <option value="">Semua</option>
                        @foreach($kelas as $key => $value)
                            <option value="{{$value->kode_kelas}}">{{$value->nama_kelas}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control select2" id="filter_tahunajaran">
                        <option value="">Semua</option>
                        @foreach($tahunajaran as $key => $value)
                            <option value="{{$value->kode_thn_ajaran}}">{{$value->nama_thn_ajaran}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <form action="">
                    <button id="filter" type="button" class="btn btn-primary">Filter</button>
            </div>
            <div class="col-1">
                <form action="">
                    <button id="reset" type="button" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered  table-responsive" id="tableSiswa" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($siswa as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->nis}}</td>
                        <td>{{$value->nisn}}</td>
                        <td>{{$value->nama_siswa}}</td>
                        <td>{{$value->nama_kelas}}</td>
                        <td>{{$value->nama_thn_ajaran}}</td>
                        <td>{{$value->alamat}}</td>
                        <td>{{$value->no_telp}}</td>
                        <td>
                            <form action="{{ route('datasiswaPKL.destroy',$value->id) }}" method="POST">
                                <a class="btn btn-warning btn-sm" href="{{route('datasiswaPKL.edit', $value->id)}}">Ubah</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
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