<x-login-layout>
    <div class="text-center">
        <img src="{{ asset('img/smk2.png') }}" width="75">
    </div>
    <h6 class="text-center mt-2" style="color: #4e73df"> Sistem Informasi Manajemen Praktik Kerja Lapangan <br>SMK Negeri 2 Balikpapan </h6>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    
    <h4 class="text-center">Lupa Password?</h4>
    <form action="{{ route('post.lupapassword') }}" method="POST">
    @csrf
        <div class="form-group">
            <label for="email_address" class="form-label">Email</label>
            <input type="email" id="email_address" class="form-control" name="email" placeholder="Masukkan email" required autofocus>
        </div>
        <div>      
            <button type="submit" class="btn btn-block btn-sm" style="background-color: #4e73df; color:white">
                Send Password Reset Link
            </button>
        </div>
    </form>
</x-login-layout>