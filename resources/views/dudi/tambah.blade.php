<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen DU/DI</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data DU/DI</h6>
    </div>
    <div class="card-body">
    <form action="{{route('dudi.store')}}" method="post">
    @csrf
        <div class="form-group">
            <label for="nama_dudi">Nama DU/DI<sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" id="nama_dudi" name="nama_dudi" placeholder="Nama DU/DI" value="{{old('nama_dudi')}}">
            <div class="text-danger">
                    @error('nama_dudi')
                        {{ $message }}
                    @enderror
                </div>
        </div>
        <div class="form-group">
            <label for="alamat_dudi">Alamat DU/DI<sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" id="alamat_dudi" name="alamat_dudi" placeholder="Alamat DU/DI" value="{{old('alamat_dudi')}}">
            <div class="text-danger">
                    @error('alamat_dudi')
                        {{ $message }}
                    @enderror
                </div>
        </div>
        <div class="col text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('dudi.index')}}">Batalkan</a>
        </div>
    </form>
    
    </div>
</div>
</x-app-layout>