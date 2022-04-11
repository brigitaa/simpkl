<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Siswa PKL</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Siswa PKL</h6>
    </div>
    <div class="card-body">
    <form action="{{route('datasiswaPKL.update', $siswa->id)}}" method="POST">
    @method('PUT')
    @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nis">NIS<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="nis" name="nis" required value="{{$siswa->nis}}">
                <div class="text-danger">
                    @error('nis')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="nisn">NISN<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="nisn" name="nisn" required value="{{$siswa->nisn}}">
                <div class="text-danger">
                    @error('password')
                        {{ $nisn }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="nama">Nama Lengkap<sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" id="inputAddress" name="nama" required value="{{$siswa->nama_siswa}}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="jeniskelamin">Jenis Kelamin<sup class="text-danger">*</sup></label>
                <select id="jeniskelamin" class="form-control" name="jeniskelamin" required value="{{$siswa->jeniskelamin}}">
                    <option value="" disabled>--Pilih--</option>
                    @if ($siswa->jeniskelamin=="Laki-laki")
                    <option value="Laki-laki" selected>Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                    @else
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan" selected>Perempuan</option>
                    @endif
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="kelas">Kelas<sup class="text-danger">*</sup></label>
                <select id="kelas" class="form-control" name="kode_kelas">
                    <option value="" disabled>--Pilih--</option>
                    @foreach($kelas as $key => $value)
                    @if ($value->kode_kelas==$siswa->kode_kelas)
                        <option value="{{$value->kode_kelas}}" selected>{{$value->nama_kelas}}</option>
                    @else
                        <option value="{{$value->kode_kelas}}">{{$value->nama_kelas}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
            <label for="tahunajaran">Tahun Ajaran<sup class="text-danger">*</sup></label>
                <select id="tahunajaran" class="form-control" name="kode_thn_ajaran">
                    <option value="" disabled>--Pilih--</option>
                    @foreach($tahunajaran as $key => $value)
                    @if ($value->kode_thn_ajaran==$siswa->kode_thn_ajaran)
                        <option value="{{$value->kode_thn_ajaran}}" selected>{{$value->nama_thn_ajaran}}</option>
                    @else
                        <option value="{{$value->kode_thn_ajaran}}">{{$value->nama_thn_ajaran}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputZip">No. Telepon<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="notelp" name="no_telp" required numeric value="{{$siswa->no_telp}}">
                <div class="text-danger">
                    @error('no_telp')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat<sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" id="alamat" name="alamat" required value="{{$siswa->alamat}}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="email">Email<sup class="text-danger">*</sup></label>
                <input type="email" class="form-control" id="email" name="email" required value="{{$user->email}}">
                <div class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="username">Username<sup class="text-danger">*</sup></label>
                <input type="username" class="form-control" id="username" name="username" required value="{{$user->username}}">
                <div class="text-danger">
                    @error('username')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
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