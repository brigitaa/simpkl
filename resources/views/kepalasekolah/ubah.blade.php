<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Kepala Sekolah</h1>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Kepala Sekolah</h6>
    </div>
    <div class="card-body">
    <form action="{{route('kepalasekolah.update', $kepalasekolah->id)}}" method="POST">
    @method('PUT')
    @csrf
        <div class="form-group row">
            <label for="nip" class="col-sm-3 col-form-label">NIP<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nip" name="nip" required value="{{$kepalasekolah->nip}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Nama Lengkap<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_kepsek" name="nama_kepsek" required value="{{$kepalasekolah->nama_kepsek}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="jabatan" name="jabatan" required value="{{$kepalasekolah->jabatan}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="pangkat_gol" class="col-sm-3 col-form-label">Pangkat Golongan<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="pangkat_gol" name="pangkat_gol" required value="{{$kepalasekolah->pangkat_gol}}">
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('kepalasekolah.index')}}">Batalkan</a>
        </div>
    </form>
    </div>
</div>
</x-app-layout>