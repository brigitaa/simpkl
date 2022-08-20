<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Siswa PKL</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Siswa PKL</h6>
    </div>
    <div class="card-body">
    <form action="{{route('datasiswaPKL.store')}}" method="post">
    @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nis">NIS<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" value="{{old('nis')}}">
                <div class="text-danger">
                    @error('nis')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="nisn">NISN<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukkan NISN" value="{{old('nisn')}}">
                <div class="text-danger">
                    @error('nisn')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="nama">Nama Lengkap<sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="{{old('name')}}">
            <div class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="jeniskelamin">Jenis Kelamin<sup class="text-danger">*</sup></label>
                <select id="jeniskelamin" class="form-control" name="jeniskelamin" value="{{old('jeniskelamin')}}">
                    <option value="">--Pilih--</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <div class="text-danger">
                    @error('jeniskelamin')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="kelas">Kelas<sup class="text-danger">*</sup></label>
                <select id="kelas" class="form-control" name="kode_kelas" value="{{old('kode_kelas')}}">
                    <option value="">--Pilih--</option>
                    @foreach($kelas as $key => $value)
                        <option value="{{$value->kode_kelas}}">{{$value->nama_kelas}}</option>
                    @endforeach
                </select>
                <div class="text-danger">
                    @error('kode_kelas')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="tahunajaran">Tahun Ajaran<sup class="text-danger">*</sup></label>
                <select id="tahunajaran" class="form-control" name="kode_thn_ajaran" value="{{old('kode_thn_ajaran')}}">
                    <option value="">--Pilih--</option>
                    @foreach($tahunajaran as $key => $value)
                        <option value="{{$value->kode_thn_ajaran}}">{{$value->nama_thn_ajaran}}</option>
                    @endforeach
                </select>
                <div class="text-danger">
                    @error('kode_thn_ajaran')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="inputZip">No. Telepon</label>
                <input type="text" class="form-control" id="notelp" name="no_telp" placeholder="08xxxxxx" value="{{old('no_telp')}}">
                {{-- <div class="text-danger">
                    @error('no_telp')
                        {{ $message }}
                    @enderror
                </div> --}}
            </div>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat<sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="{{old('alamat')}}">
            <div class="text-danger">
                    @error('alamat')
                        {{ $message }}
                    @enderror
                </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="email">Email<sup class="text-danger">*</sup></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="contoh@example.com" value="{{old('email')}}">
                <div class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="username">Username<sup class="text-danger">*</sup></label>
                <input type="username" class="form-control" id="username" name="username" placeholder="Masukkan Username" value="{{old('username')}}">
                <div class="text-danger">
                    @error('username')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="password">Password<sup class="text-danger">*</sup></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                <div class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="col text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('datasiswaPKL.index')}}">Batalkan</a>
        </div>
</form>
    

    </div>
</div>
</x-app-layout>