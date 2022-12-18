<x-login-layout>
    <div class="text-center">
        <img src="{{ asset('img/smk2.png') }}" width="75">
    </div>
    <h5 class="text-center mt-2" style="color: #4e73df;"> Sistem Informasi Manajemen Praktik Kerja Lapangan <br>SMK Negeri 2 Balikpapan </h5>
    @if ($message = Session::get('fail'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @endif
    
    {{-- message reset password --}}
    @if (Session::has('message')) 
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }} 
        </div>
    @endif
    
    <form action="{{route('auth.login')}}" method="post">
    @csrf
        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="username" class="form-control" id="username" name="username" placeholder="Masukkan username" required autofocus>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            <div class="text-left">
                <a href="{{ route('auth.lupapassword') }}">Lupa Password?</a>
            </div>
        </div>
        
        <div class="text-center">
            <button class="btn btn-block btn-primary" style="background-color: #4e73df; color:white" type="submit">Masuk</button>
        </div>
    </form>
</x-login-layout>