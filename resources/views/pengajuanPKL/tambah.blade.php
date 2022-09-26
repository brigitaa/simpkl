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
            <label for="name" class="col-sm-4 col-form-label">Nama Lengkap Siswa</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_siswa" name="name" required value="{{$datasiswa->nama_siswa}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="nis" class="col-sm-4 col-form-label">Nomor Induk Siswa (NIS)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nis" required value="{{$datasiswa->nis}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="nisn" class="col-sm-4 col-form-label">Nomor Induk Siswa Nasional (NISN)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nisn" required value="{{$datasiswa->nisn}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="jeniskelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="jeniskelamin" required value="{{$datasiswa->jeniskelamin}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="periode" class="col-sm-4 col-form-label">Periode PKL</label>
            <div class="col-sm-3">
                <select id="tanggal_mulai" class="form-control" name="periode_id" value="{{old('tanggal_mulai')}}" required>
                    <option value="">--Pilih--</option>
                    @foreach($periode as $key => $value)
                        <option value="{{$value->id}}">{{$value->tanggal_mulai}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">s/d</span>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="tanggal_selesai" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="nama_dudi" class="col-sm-4 col-form-label">Nama DU/DI</label>
            <div class="col-sm-8">
                <select id="nama_dudi" class="form-control" name="dudi_id" value="{{old('nama_dudi')}}" required>
                    <option value="">--Pilih--</option>
                    @foreach($dudi as $key => $value)
                        <option value="{{$value->id}}">{{$value->nama_dudi}}</option>
                    @endforeach
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="otherdudi" name="nama_dudi" placeholder="Nama DU/DI lainnya" style='display:none;' />
            </div>
        </div>
        <div class="form-group row">
            <label for="alamat_dudi" class="col-sm-4 col-form-label">Alamat DU/DI</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Masukkan alamat DU/DI" name="alamat_dudi" id="alamat_dudi" disabled="disabled" />
            </div>
        </div>
        <div class="form-group row">
            <label for="pernyataan_ortu" class="col-sm-4 col-form-label">Surat Pernyataan Orang Tua</label>
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
            <label for="pernyataan_siswa" class="col-sm-4 col-form-label">Surat Pernyataan Siswa</label>
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
                        $("[name='alamat_dudi']").val(response.alamat_dudi);
                    }
                }
            });            
        });

        $(function () {
            // $("#nama_dudi").change(function () {
            //     if ($(this).val() == "Lainnya") {
            //         $("#otherdudi").show();
            //     } else {
            //         $("#otherdudi").hide();
                    
            //     }
            // });

        $("#nama_dudi").change(function () {
            if ($(this).val() == "Lainnya") {
                $("#otherdudi").show();
                $("#alamat_dudi").removeAttr("disabled");
                $('#alamat_dudi').val('');
            } else {
                $("#otherdudi").hide();
                // $("#otherdudi").attr("disabled", "disabled");
                $("#alamat_dudi").attr("disabled", "disabled");
                
            }
        });
        
    });

    </script>    

    </div>
</div>
</x-app-layout>