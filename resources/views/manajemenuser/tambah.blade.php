<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen User</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data User</h6>
    </div>
    <div class="card-body">
    <form action="{{route('manajemenuser.store')}}" method="post">
    @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Nama<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nama user" value="{{old('name')}}">
                <div class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="email" name="email" placeholder="contoh@example.com" value="{{old('email')}}">
                <div class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="username">Username<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" value="{{old('username')}}">
                <div class="text-danger">
                    @error('username')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="passoword">Password<sup class="text-danger">*</sup></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                <div class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="role">Role<sup class="text-danger">*</sup></label>
                <select id="role" class="form-control" name="role_id" value="{{old('role_id')}}">
                    <option value="">--Pilih--</option>
                    @foreach($role as $key => $value)
                        <option value="{{$value->id}}">{{$value->nama_role}}</option>
                    @endforeach
                </select>
                <div class="text-danger">
                    @error('kode_kelas')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="col text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('manajemenuser.index')}}">Batalkan</a>
        </div>
</form>
    

    </div>
</div>
</x-app-layout>