<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen Status PKL</h1>

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

<!-- Content Row -->
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-7">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Status PKL</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Status PKL</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($statuspkl as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->nama_status_pkl}}</td>
                                <td>
                                <form action="{{ route('statusPKL.destroy',$value->id) }}" method="POST">
                                    <a class="btn btn-warning btn-sm" href="{{route('statusPKL.edit', $value->id)}}">Ubah</a>
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


    </div>

    <div class="col-lg-5">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Status PKL</h6>
            </div>
            <div class="card-body">
                <form action="{{route('statusPKL.store')}}" method="post">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="nama_status_pkl">Status PKL<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="nama_status_pkl" name="nama_status_pkl" placeholder="Status PKL" value="{{old('nama_status_pkl')}}">
                                <div class="text-danger">
                                    @error('nama_status_pkl')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

</x-app-layout>