<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen Ketua Program Keahlian</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Ketua Program Keahlian</h6>
    </div>
    <div class="card-body">
    <form action="{{route('kaprog.update', $kaprog->id)}}" method="POST">
    @method('PUT')
    @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nip">NIP<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="nip" name="nip" required value="{{$kaprog->nip}}">
                <div class="text-danger">
                    @error('nip')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="nama">Nama Lengkap<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="nama" name="name" required value="{{$user->name}}">
                <div class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Email<sup class="text-danger">*</sup></label>
                <input type="email" class="form-control" id="email" name="email" required value="{{$user->email}}">
                <div class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="kompetensi_keahlian">Kompetensi Keahlian<sup class="text-danger">*</sup></label>
                <select id="kompetensi_keahlian" class="form-control" name="kompetensi_keahlian_id">
                    <option value="" disabled>--Pilih--</option>
                    @foreach($kompetensi_keahlian as $key => $value)
                    @if ($value->id==$kaprog->kompetensi_keahlian_id)
                        <option value="{{$value->id}}" selected>{{$value->nama_keahlian}}</option>
                    @else
                        <option value="{{$value->id}}">{{$value->nama_keahlian}}</option>
                    @endif
                    @endforeach
                </select>
                <div class="text-danger">
                    @error('nama_keahlian')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="username">Username<sup class="text-danger">*</sup></label>
                <input type="username" class="form-control" id="username" name="username" required value="{{$user->username}}">
                <div class="text-danger">
                    @error('username')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="passoword">Password<sup class="text-danger">*</sup></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                <div class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="col text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('kaprog.index')}}">Batalkan</a>
        </div>
</form>
    

    </div>
</div>
</x-app-layout>