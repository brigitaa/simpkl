<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen DU/DI</h1>
    <a class="btn btn-success mb-3" href="{{route('dudi.create_dudisiswa')}}">Tambah</a>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar DU/DI</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama DU/DI</th>
                        <th>Alamat DU/DI</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($dudi as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->nama_dudi}}</td>
                        <td>{{$value->alamat_dudi}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</x-app-layout>