<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen Guru</h1>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Guru</h6>
    </div>
    <div class="card-body">
    <form action="{{route('guru.update', $guru->id)}}" method="POST">
    @method('PUT')
    @csrf
        <div class="form-group row">
            <label for="nip" class="col-sm-2 col-form-label">NIP<sup class="text-danger">*</sup></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nip" name="nip" required value="{{$guru->nip}}">
            </div>
        </div>  
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Nama Lengkap<sup class="text-danger">*</sup></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_guru" name="nama_guru" required value="{{$guru->nama_guru}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="no_telp_guru" class="col-sm-2 col-form-label">No. Telepon<sup class="text-danger">*</sup></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="no_telp_guru" name="no_telp_guru" required value="{{$guru->no_telp_guru}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat<sup class="text-danger">*</sup></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat" name="alamat" required value="{{$guru->alamat}}">
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('guru.index')}}">Batalkan</a>
        </div>
    </form>
    </div>
</div>
</x-app-layout>