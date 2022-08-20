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
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Pengajuan PKL</h6>
    </div>
    <div class="card-body">
    <form action="{{route('pengajuanPKL.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label">Nama Lengkap Siswa<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_siswa" name="name" required value="{{$datasiswa->nama_siswa}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="nis" class="col-sm-4 col-form-label">Nomor Induk Siswa (NIS)<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nis" required value="{{$datasiswa->nis}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="nisn" class="col-sm-4 col-form-label">Nomor Induk Siswa Nasional (NISN)<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nisn" required value="{{$datasiswa->nisn}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="jeniskelamin" class="col-sm-4 col-form-label">Jenis Kelamin<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="jeniskelamin" required value="{{$datasiswa->jeniskelamin}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="kelas" class="col-sm-4 col-form-label">Kelas<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="kelas" required value="{{$datakelas->nama_kelas}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="tahunajaran" class="col-sm-4 col-form-label">Tahun Ajaran<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="tahunajaran" required value="{{$tahunajaran->nama_thn_ajaran}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="periode" class="col-sm-4 col-form-label">Periode PKL<sup class="text-danger">*</sup></label>
            <div class="col-sm-3">
                <select id="tanggal_mulai" class="form-control" name="periode_id" value="{{old('tanggal_mulai')}}" required>
                    <option value="">--Pilih--</option>
                    @foreach($periode as $key => $value)
                        <option value="{{$value->id}}">{{$value->tanggal_mulai}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <span class="input-group-text">s/d</span>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="tanggal_selesai" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="nama_dudi" class="col-sm-4 col-form-label">Nama DU/DI<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <select id="nama_dudi" class="form-control" name="dudi_id" value="{{old('nama_dudi')}}" required>
                    <option value="">--Pilih--</option>
                    @foreach($dudi as $key => $value)
                        <option value="{{$value->id}}">{{$value->nama_dudi}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="alamat_dudi" class="col-sm-4 col-form-label">Alamat DU/DI<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Masukkan alamat DU/DI" id="alamat_dudi" disabled="disabled" />
            </div>
        </div>
        <div class="form-group row">
            <label for="pernyataan_ortu" class="col-sm-4 col-form-label">Surat Pernyataan Orang Tua<sup class="text-danger">*</sup></label>
            <div class="col-sm-4">
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="pernyataan_ortu">
                <div class="text-danger">
                    @error('pernyataan_ortu')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <a class="btn btn-primary btn-sm" href="{{route('pengajuanPKL.pernyataanortu')}}">
                <i class="fas fa-download"></i> Download Template</a>
            </div>
        </div>
        <div class="form-group row">
            <label for="pernyataan_siswa" class="col-sm-4 col-form-label">Surat Pernyataan Siswa<sup class="text-danger">*</sup></label>
            <div class="col-sm-4">
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="pernyataan_siswa">
                <div class="text-danger">
                    @error('pernyataan_siswa')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <a class="btn btn-primary btn-sm" href="{{route('pengajuanPKL.pernyataansiswa')}}">
                <i class="fas fa-download"></i> Download Template</a>
            </div>
        </div>
        <div class="form-group row">
            <label for="status_verif_pokja" class="col-sm-4 col-form-label">Status Verifikasi Ketua Pokja PKL<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <select id="status_verif_pokja" class="form-control" name="status_verif_pokja" value="{{old('status_verif_pokja')}}">
                    <option value="" disabled>--Pilih--</option>
                    <option value="Diproses" selected>Diproses</option>
                    <option value="Diterima" disabled>Diterima</option>
                    <option value="Ditolak" disabled>Ditolak</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="status_verif_kaprog" class="col-sm-4 col-form-label">Status Verifikasi Ketua Program Keahlian<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <select id="status_verif_kaprog" class="form-control" name="status_verif_kaprog" value="{{old('status_verif_kaprog')}}">
                    <option value="" disabled>--Pilih--</option>
                    <option value="1" selected>Diproses</option>
                    <option value="2" disabled>Disetujui</option>
                    <option value="3" disabled>Ditolak</option>
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col text-right">
                <button type="submit" class="btn btn-block btn-success">Simpan</button>
            </div>
        </div>
    </form>
    
    <script type="text/javascript">
        $('#tanggal_mulai').change(function() {
            var id = $(this).val();
            var url = '{{ route("getPeriode", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        $('#tanggal_selesai').val(response.tanggal_selesai);
                    }
                }
            });
        });

        $('#nama_dudi').change(function() {
            var id = $(this).val();
            var url = '{{ route("getDudi", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        $('#alamat_dudi').val(response.alamat_dudi);
                    }
                }
            });            
        });
    </script>    

    </div>
</div>
</x-app-layout>