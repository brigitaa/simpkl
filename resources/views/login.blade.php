<x-login-layout>
    <div class="text-center">
        <img src="img/smk2.png" width="75">
    </div>
    <h5 class="text-center mt-2" style="color: #3E689A;"> Sistem Informasi Manajemen Praktik Kerja Lapangan <br>SMK Negeri 2 Balikpapan </h5>
    @if ($message = Session::get('fail'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @endif
    <!-- @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
    @endif -->
    <form action="{{route('auth.login')}}" method="post">
    @csrf
        <div class="mb-2">
            <label for="username" class="form-label">Username</label>
            <input type="username" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
        </div>
        <div class="text-center">
            <button class="btn btn-primary btn-block btn-md" type="submit">Masuk</button>
        </div>
    </form>
</x-login-layout>