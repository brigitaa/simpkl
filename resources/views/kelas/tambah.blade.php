<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen Kelas</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Kelas</h6>
    </div>
    <div class="card-body">
    <form action="{{route('kelas.store')}}" method="post">
    @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="kode_kelas">Kode<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="kode_kelas" name="kode_kelas" placeholder="Kode kelas" value="{{old('kode_kelas')}}">
                <div class="text-danger">
                    @error('kode_kelas')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="nama_kelas">Kelas<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Kelas" value="{{old('nama_kelas')}}">
                <div class="text-danger">
                    @error('nama_kelas')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="kompetensi_keahlian">Kompetensi Keahlian<sup class="text-danger">*</sup></label>
                <select id="kompetensi_keahlian" class="form-control" name="kompetensi_keahlian_id" required value="{{old('kompetensi_keahlian_id')}}">
                    <option value="">--Pilih--</option>
                    @foreach($kompetensi_keahlian as $key => $value)
                        <option value="{{$value->id}}">{{$value->nama_keahlian}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('kelas.index')}}">Batalkan</a>
        </div>
    </form>

    </div>
</div>
</x-app-layout>