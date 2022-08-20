<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Guru Monitoring</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Guru Monitoring</h6>
    </div>
    <div class="card-body">
    <form action="{{route('gurumonitoring.update', $gurumonitoring->id)}}" method="POST">
    @method('PUT')
    @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="nama_dudi">Nama DU/DI<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="nama_dudi" name="nama_dudi" readonly value="{{$datadudi->nama_dudi}}">
            </div>
            <div class="form-group col-md-4">
                <label for="tanggal_mulai">Tanggal Mulai PKL<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="tanggal_mulai" name="tanggal_mulai" readonly value="{{$dataperiode->tanggal_mulai}}">
            </div>
            <div class="form-group col-md-4">
                <label for="tanggal_selesai">Tanggal Selesai PKL<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="tanggal_selesai" name="tanggal_selesai" readonly value="{{$dataperiode->tanggal_selesai}}">
            </div>
        </div>
        <div class="form-group">
            <label for="guru">Guru Monitoring<sup class="text-danger">*</sup></label>
            <select id="guru" class="form-control" name="guru_id">
                <option value="">--Pilih--</option>
                @foreach($guru as $key => $value)
                    @if ($value->id==$gurumonitoring->guru_id)
                        <option value="{{$value->id}}" selected>{{$value->nama_guru}}</option>
                    @else
                        <option value="{{$value->id}}">{{$value->nama_guru}}</option>
                    @endif
                @endforeach
            </select>
            <div class="text-danger">
                @error('nama_guru')
                    {{ $message }}
                @enderror
            </div>
        </div>
        
        <div class="text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('gurumonitoring.index')}}">Batalkan</a>
        </div>
    </form>

    </div>
</div>
</x-app-layout>