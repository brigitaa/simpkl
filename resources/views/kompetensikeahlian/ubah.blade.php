<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen Kompetensi Keahlian</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Kompetensi Keahlian</h6>
    </div>
    <div class="card-body">
    <form action="{{route('kompetensikeahlian.update', $kompetensi_keahlian->id)}}" method="POST">
    @method('PUT')
    @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="kode_keahlian">Kode<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="kode_keahlian" name="kode_keahlian"
                    required value="{{$kompetensi_keahlian->kode_keahlian}}">
                <div class="text-danger">
                    @error('kode_keahlian')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="nama_thn_ajaran">Kompetensi Keahlian<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="nama_keahlian" name="nama_keahlian"
                    required value="{{$kompetensi_keahlian->nama_keahlian}}">
                <div class="text-danger">
                    @error('nama_keahlian')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        <div class="col text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('kompetensikeahlian.index')}}">Batalkan</a>
        </div>
</form>
    

    </div>
</div>
</x-app-layout>