<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Profil</h1>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

@if (session('role') != 'Siswa')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Profil</h6>
    </div>
    <div class="card-body">
    <form action="{{route('profil.update', $user->id)}}" method="POST">
    @method('PUT')
    @csrf
        @if (session('role') == 'Kaprog')
        <div class="form-group row">
            <label for="nip" class="col-sm-2 col-form-label">NIP<sup class="text-danger">*</sup></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nip" name="nip" required value="{{$kaprog->nip}}">
            </div>
        </div>
        @endif
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Nama Lengkap<sup class="text-danger">*</sup></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" required value="{{$user->name}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">Username<sup class="text-danger">*</sup></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" required value="{{$user->username}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email<sup class="text-danger">*</sup></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" disabled value="{{$user->email}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password">
                <small class="form-text text-muted">Dikosongkan jika tidak ingin merubah password.</small>
                <div class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('dashboard.index')}}">Batalkan</a>
        </div>
    </form>
    </div>
</div>

@elseif (session('role') == 'Siswa')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Profil</h6>
    </div>
    <div class="card-body">
        <form action="{{route('profil.update', $user->id)}}" method="POST">
        @method('PUT')
        @csrf
            <h6 class="mb-3 font-weight-bold text-primary">Data Diri</h6>
            <div class="form-group row">
                <label for="nis" class="col-sm-4 col-form-label">Nomor Induk Siswa (NIS)<sup class="text-danger">*</sup></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nis" name="nis" disabled value="{{$siswa->nis}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Nomor Induk Siswa Nasional (NISN)<sup class="text-danger">*</sup></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="nisn" disabled value="{{$siswa->nisn}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Nama Lengkap<sup class="text-danger">*</sup></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" disabled value="{{$user->name}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="jeniskelamin" class="col-sm-4 col-form-label">Jenis Kelamin<sup class="text-danger">*</sup></label>
                <div class="col-sm-8">
                    <select id="jeniskelamin" class="form-control" name="jeniskelamin" disabled value="{{$siswa->jeniskelamin}}">
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
            </div>
            <div class="form-group row">
                <label for="no_telp" class="col-sm-4 col-form-label">No. Telepon<sup class="text-danger">*</sup></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="no_telp" name="no_telp" required value="{{$siswa->no_telp}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-4 col-form-label">Alamat<sup class="text-danger">*</sup></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="alamat" name="alamat" required value="{{$siswa->alamat}}">
                </div>
            </div>

            <h6 class="mb-3 font-weight-bold text-primary">Data Orang Tua / Wali Siswa</h6>
            <div class="form-group row">
                <label for="nama_ortu" class="col-sm-4 col-form-label">Nama Orang Tua / Wali Siswa<sup class="text-danger">*</sup></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nis" name="nama_ortu" required placeholder="Nama Orang Tua / Wali Siswa" value="{{$siswa->nama_ortu}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="pekerjaan_ortu" class="col-sm-4 col-form-label">Pekerjaan<sup class="text-danger">*</sup></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="pekerjaan_ortu" name="pekerjaan_ortu" required placeholder="Pekerjaan" value="{{$siswa->pekerjaan_ortu}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat_ortu" class="col-sm-4 col-form-label">Alamat<sup class="text-danger">*</sup></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="alamat_ortu" name="alamat_ortu" required placeholder="Alamat" value="{{$siswa->alamat_ortu}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4"></div>
                <div class="form-inline">
                    <label for="rt_ortu" class="col-sm-2 col-form-label">RT<sup class="text-danger">*</sup></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="rt_ortu" name="rt_ortu" placeholder="RT" value="{{$siswa->rt_ortu}}">
                    </div>
                </div>
                <div class="form-inline">
                    <label for="norumah_ortu" class="col-sm-2 col-form-label">No.<sup class="text-danger">*</sup></label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" id="norumah_ortu" name="norumah_ortu" placeholder="Nomor Rumah" value="{{$siswa->norumah_ortu}}">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4"></div>
                <div class="form-inline">
                    <label for="kelurahan_ortu" class="col-sm-3 col-form-label">&nbsp;&nbsp;Kelurahan<sup class="text-danger">*</sup></label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" id="kelurahan_ortu" name="kelurahan_ortu" placeholder="Kelurahan" value="{{$siswa->kelurahan_ortu}}">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="hp_ortu" class="col-sm-4 col-form-label">Telp/Hp<sup class="text-danger">*</sup></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="hp_ortu" name="hp_ortu" required value="{{$siswa->hp_ortu}}">
                </div>
            </div>

            <h6 class="mb-3 font-weight-bold text-primary">Data Akun</h6>
            <div class="form-group row">
                <label for="username" class="col-sm-4 col-form-label">Username<sup class="text-danger">*</sup></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="username" name="username" required value="{{$user->username}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email<sup class="text-danger">*</sup></label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" required value="{{$user->email}}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" name="password">
                    <small class="form-text text-muted">Dikosongkan jika tidak ingin merubah password.</small>
                    <div class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a class="btn btn-danger" href="{{route('dashboard.index')}}">Batalkan</a>
            </div>
        </form>
    </div>
</div>
@endif

</x-app-layout>