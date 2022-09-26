<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen Status PKL</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Status PKL</h6>
    </div>
    <div class="card-body">
    <form action="{{route('statusPKL.update', $statuspkl->id)}}" method="POST">
    @method('PUT')
    @csrf
        <div class="form-group">
            <label for="nama_status_pkl">Status PKL<sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" id="nama_status_pkl" name="nama_status_pkl" required value="{{$statuspkl->nama_status_pkl}}">
        </div>
        <div class="col text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('statusPKL.index')}}">Batalkan</a>
        </div>
</form>
    

    </div>
</div>
</x-app-layout>