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
    
    <h4 class="text-center">Reset Password</h4>
    <form action="{{ route('post.resetpassword') }}" method="POST">
    @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email_address">Email</label>
            <input type="text" id="email_address" class="form-control" name="email" value="{{$email->email}}" disabled>
        </div>

        <div class="form-group">
            <label for="password">Password<sup class="text-danger">*</sup></label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan password" required autofocus>
            <div class="text-danger">
                <small>
                    @error('password')
                        {{ $message }}
                    @enderror
                </small>
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm">Konfirmasi Password<sup class="text-danger">*</sup></label>
            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="Masukkan konfirmasi password" required autofocus>
        </div>
        <div>      
            <button type="submit" class="btn btn-block btn-sm" style="background-color: #4e73df; color:white">
                Reset Password
            </button>
        </div>
    </form>
</x-login-layout>