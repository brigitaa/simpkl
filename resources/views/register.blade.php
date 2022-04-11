<x-login-layout>
    <div class="text-center">
        <img src="img/smk2.png" width="75">
    </div>
    <h5 class="text-center mt-2" style="color: #3E689A;"> Sistem Informasi Manajemen Praktik Kerja Lapangan <br>SMK Negeri 2 Balikpapan </h5>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

    <form action="{{route('auth.register')}}" method="post">
    @csrf
        <div class="mb-2">
            <label for="nama" class="form-label">Nama<sup class="text-danger">*</sup></label>
            <input type="nama" class="form-control" id="nama" name="name" placeholder="Masukkan nama" value="{{old('name')}}">
            <div class="text-danger">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="mb-2">
            <label for="username" class="form-label">Username<sup class="text-danger">*</sup></label>
            <input type="username" class="form-control" id="username" name="username" placeholder="Masukkan username" value="{{old('username')}}">
            <div class="text-danger">
                @error('username')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="mb-2">
            <label for="email" class="form-label">Email<sup class="text-danger">*</sup></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" value="{{old('email')}}">
            <div class="text-danger">
                @error('email')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password<sup class="text-danger">*</sup></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <div class="text-danger">
                @error('password')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-primary btn-block btn-md" type="submit">Daftar Akun</button>
        </div>
        <br>Sudah punya akun? <a href="{{url('/')}}">Masuk</a>
    </form>
</x-login-layout>