<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen Tahun Ajaran</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Tahun Ajaran</h6>
    </div>
    <div class="card-body">
    <form action="{{route('tahunajaran.store')}}" method="post">
    @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nama_thn_ajaran">Kode<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="kode_thn_ajaran" name="kode_thn_ajaran" placeholder="Kode Tahun Ajaran" value="{{old('kode_thn_ajaran')}}">
                <div class="text-danger">
                    @error('kode_thn_ajaran')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="nama_thn_ajaran">Tahun Ajaran<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="nama_thn_ajaran" name="nama_thn_ajaran" placeholder="Tahun Ajaran" value="{{old('nama_thn_ajaran')}}">
                <div class="text-danger">
                    @error('nama_thn_ajaran')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        <div class="col text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('tahunajaran.index')}}">Batalkan</a>
        </div>
</form>
    

    </div>
</div>
</x-app-layout>