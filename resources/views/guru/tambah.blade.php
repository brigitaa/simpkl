<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen Guru</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Guru</h6>
    </div>
    <div class="card-body">
    <form action="{{route('guru.store')}}" method="post">
    @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">NIP<sup class="text-danger">*</sup></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" value="{{old('nip')}}">
                <div class="text-danger">
                    @error('nip')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="nis" class="col-sm-2 col-form-label">Nama Lengkap<sup class="text-danger">*</sup></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_guru" name="nama_guru" placeholder="Nama Lengkap" value="{{old('nama_guru')}}">
                <div class="text-danger">
                    @error('nama_guru')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_telp" class="col-sm-2 col-form-label">No. Telepon<sup class="text-danger">*</sup></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="no_telp_guru" name="no_telp_guru" placeholder="08xxxxxxxxxx" value="{{old('no_telp_guru')}}">
                <div class="text-danger">
                    @error('no_telp_guru')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat<sup class="text-danger">*</sup></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="{{old('alamat')}}">
                <div class="text-danger">
                    @error('alamat')
                        {{ $message }}
                    @enderror
                </div>
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