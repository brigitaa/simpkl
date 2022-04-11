<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Siswa PKL</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Impor Data Siswa PKL</h6>
    </div>
    <div class="card-body">
    <div class="row">
        <div class="col-12">
            <p> Download file template impor berikut : 
                <a class="btn btn-primary btn-sm" href="{{route('datasiswaPKL.downloadfile')}}">
                <i class="fas fa-download"></i> Download Template</a>
            </p>
        </div>
    </div>
        <form action="{{route('datasiswaPKL.import')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                      <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-ban"></i> Error!</h4>
                          @foreach($errors->all() as $error)
                          {{ $error }} <br>
                          @endforeach      
                      </div>
                    </div>
                </div>
                @endif
            <div class="form-group">
                <label for="exampleFormControlFile1">File Impor Data Siswa PKL<sup class="text-danger">*</sup></label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
                <div class="text-danger">
                    @error('file')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="col text-right">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a class="btn btn-danger" href="{{route('datasiswaPKL.index')}}">Batalkan</a>
            </div>
        </form>
    

    </div>
</div>
</x-app-layout>