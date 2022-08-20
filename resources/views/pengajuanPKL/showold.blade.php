<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pengajuan PKL</h1>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Data Pengajuan PKL</h6>
    </div>
    <div class="card-body">
    <a class="btn btn-primary mb-3" href="{{route('pengajuanPKL.lihat')}}"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
    <form action="{{route('pengajuanPKL.update', $pengajuan->id)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label">Nama Lengkap Siswa</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_siswa" name="name" required value="{{$siswa->nama_siswa}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="nis" class="col-sm-4 col-form-label">Nomor Induk Siswa (NIS)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nis" required value="{{$siswa->nis}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="nisn" class="col-sm-4 col-form-label">Nomor Induk Siswa Nasional (NISN)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nisn" required value="{{$siswa->nisn}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="jeniskelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="jeniskelamin" required value="{{$siswa->jeniskelamin}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="periode" class="col-sm-4 col-form-label">Periode PKL</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="tanggal_mulai" value="{{$dataperiode->tanggal_mulai}}" readonly />
            </div>
            <div class="input-group-append">
                <span class="input-group-text">s/d</span>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="tanggal_selesai" value="{{$dataperiode->tanggal_selesai}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="nama_dudi" class="col-sm-4 col-form-label">Nama DU/DI</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_dudi" value="{{$datadudi->nama_dudi}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="alamat_dudi" class="col-sm-4 col-form-label">Alamat DU/DI</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="alamat_dudi" value="{{$datadudi->alamat_dudi}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="pernyataan_ortu" class="col-sm-4 col-form-label">Surat Pernyataan Orang Tua</label>
            <div class="col-sm-4">
                <a href="{{route('pengajuanPKL.file_pernyataanortu', $pengajuan->id)}}">{{$pengajuan->pernyataan_ortu}}</a>
            </div>
            <div class="col-sm-4">
                <a class="btn btn-primary btn-sm" href="{{route('pengajuanPKL.pernyataanortu')}}">
                <i class="fas fa-download"></i> Download Template</a>
            </div> 
        </div>
        <div class="form-group row">
            <label for="pernyataan_siswa" class="col-sm-4 col-form-label">Surat Pernyataan Siswa</label>
            <div class="col-sm-4">
                <a href="{{route('pengajuanPKL.file_pernyataansiswa', $pengajuan->id)}}">{{$pengajuan->pernyataan_siswa}}</a>
            </div>
            <div class="col-sm-4">
                <a class="btn btn-primary btn-sm" href="{{route('pengajuanPKL.pernyataansiswa')}}">
                <i class="fas fa-download"></i> Download Template</a>
            </div>
        </div>
        <div class="form-group row">
            <label for="status_verif_pokja" class="col-sm-4 col-form-label">Status Verifikasi Ketua Pokja PKL</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="status_verif_pokja" value="{{$pengajuan->status_verif_pokja}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="status_verif_kaprog" class="col-sm-4 col-form-label">Status Verifikasi Ketua Program Keahlian</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="status_verif_kaprog" value="{{$pengajuan->status_verif_kaprog}}" readonly />
            </div>
        </div>
    </form>
    </div>
</div>
</x-app-layout>