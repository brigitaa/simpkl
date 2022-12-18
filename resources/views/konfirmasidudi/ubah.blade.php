<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Konfirmasi Balasan DU/DI</h1>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Konfirmasi DU/DI</h6>
    </div>
    <div class="card-body">
    <form action="{{route('konfirmasidudi.update', $konfirmasidudi->id)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
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
            <label for="pengajuan" class="col-sm-4 col-form-label">ID Pengajuan PKL<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <select id="pengajuan" class="form-control" name="pengajuan_id">
                    <option value="" disabled>--Pilih--</option>
                    @foreach($datasiswa->pengajuan as $key => $value) 
                        @if ($value->id==$konfirmasidudi->pengajuan_id)
                            <option value="{{$value->id}}" selected>{{$value->id}}</option>    
                        @else
                            <option value="{{$value->id}}">{{$value->id}}</option>  
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="periode" class="col-sm-4 col-form-label">Periode PKL<sup class="text-danger">*</sup></label>
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
            <label for="nama_dudi" class="col-sm-4 col-form-label">Nama DU/DI<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_dudi" value="{{$datadudi->nama_dudi}}" required readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="alamat_dudi" class="col-sm-4 col-form-label">Alamat DU/DI<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="alamat_dudi" value="{{$datadudi->alamat_dudi}}" required readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="pernyataan_ortu" class="col-sm-4 col-form-label">Surat Balasan DU/DI<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="balasan_dudi">
                <a href="{{route('konfirmasidudi.file_balasandudi', $konfirmasidudi->id)}}">{{$konfirmasidudi->balasan_dudi}}</a>
            </div>
            <div class="text-danger">
                    @error('balasan_dudi')
                        {{ $message }}
                    @enderror
                </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-4 col-form-label">Status<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
                <select id="status_balasan_dudi" class="form-control" name="status_balasan_dudi">
                    <option value="" disabled>--Pilih--</option>
                    @if ($konfirmasidudi->status == "Disetujui")
                    <option value="Disetujui" selected>Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
                    @else
                    <option value="Disetujui">Disetujui</option>
                    <option value="Ditolak" selected>Ditolak</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('konfirmasidudi.lihat')}}">Batalkan</a>
        </div>
    </form>

    <script type="text/javascript">
        $('#pengajuan').change(function() {
            var id = $(this).val();
            var url = '{{ route("getPengajuan", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        $('#tanggal_mulai').val(response.tanggal_mulai);
                        $('#tanggal_selesai').val(response.tanggal_selesai);
                        $('#nama_dudi').val(response.nama_dudi);
                        $('#alamat_dudi').val(response.alamat_dudi);
                    }
                }
            });
        });
    </script>   

    </div>
</div>
</x-app-layout>