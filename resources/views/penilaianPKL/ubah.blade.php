<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Penilaian PKL</h1>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Penilaian PKL</h6>
    </div>
    <div class="card-body">
    <form action="{{route('penilaianPKL.update', $penilaian->id)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Nama Lengkap Siswa<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_siswa" name="name" required value="{{$datasiswa->nama_siswa}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="kelas" class="col-sm-3 col-form-label">Kelas<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required value="{{$datakelas->nama_kelas}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="tahunajaran" class="col-sm-3 col-form-label">Tahun Ajaran<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_thn_ajaran" name="nama_thn_ajaran" required value="{{$tahunajaran->nama_thn_ajaran}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="kelas" class="col-sm-3 col-form-label">HP<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="no_telp" name="no_telp" required value="{{$datasiswa->no_telp}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="periode" class="col-sm-3 col-form-label">Periode PKL<sup class="text-danger">*</sup></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="tanggal_mulai" value="{{$dataperiode->tanggal_mulai}}" required readonly />
            </div>
            <div>
                <span class="input-group-text">s/d</span>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="tanggal_selesai" value="{{$dataperiode->tanggal_selesai}}" required readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="nama_dudi" class="col-sm-3 col-form-label">Nama DU/DI<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_dudi" required value="{{$datadudi->nama_dudi}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="alamat_dudi" class="col-sm-3 col-form-label">Alamat DU/DI<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="alamat_dudi" value="{{$datadudi->alamat_dudi}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="sertifikat" class="col-sm-3 col-form-label">Sertifikat PKL<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="sertifikat">
                <a href="{{route('penilaianPKL.file_sertifikat', $penilaian->id)}}">{{$penilaian->sertifikat}}</a>
                <div class="text-danger">
                    @error('sertifikat')
                        {{ $message }}
                    @enderror
                </div>
            </div>     
        </div>
        <div class="form-group row">
            <label for="nilai" class="col-sm-3 col-form-label">Nilai<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Masukkan total nilai dari DU/DI" value="{{$penilaian->nilai}}">
                <div class="text-danger">
                    @error('nilai')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('penilaianPKL.index')}}">Batalkan</a>
        </div>
    </form>  

    </div>
</div>
</x-app-layout>