<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Penempatan PKL</h1>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Penempatan PKL</h6>
    </div>
    <div class="card-body">
    <form action="{{route('penempatanPKL.update', $penempatan->id)}}" method="POST" enctype="multipart/form-data">
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
            <label for="nama_guru" class="col-sm-3 col-form-label">Guru Monitoring<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_guru" value="{{$dataguru->nama_guru}}" readonly />
            </div>
        </div>
        <div class="form-group row">
            <label for="status_pkl" class="col-sm-3 col-form-label">Status PKL<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <select id="nama_status_pkl" class="form-control" name="status_pkl_id" required>
                    <option value="" disabled>--Pilih--</option>
                    @foreach($statuspkl as $key => $value)
                        @if ($value->id==$penempatan->status_pkl_id)
                            <option value="{{$value->id}}" selected>{{$value->nama_status_pkl}}</option>
                        @else
                            <option value="{{$value->id}}">{{$value->nama_status_pkl}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('penempatanPKL.index')}}">Batalkan</a>
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