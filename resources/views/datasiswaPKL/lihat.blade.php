<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Siswa PKL</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Siswa PKL</h6>
    </div>
    <div class="card-body">
        <div class="row">
                <div class="col-2">Kelas</div>
                <div class="col-2">Tahun Ajaran</div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control select2" id="filter_kelas">
                        <option value="">Semua</option>
                        @foreach($kelas as $key => $value)
                            <option value="{{$value->nama_kelas}}">{{$value->nama_kelas}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control select2" id="filter_tahunajaran">
                        <option value="">Semua</option>
                        @foreach($tahunajaran as $key => $value)
                            <option value="{{$value->nama_thn_ajaran}}">{{$value->nama_thn_ajaran}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <form action="">
                    <button id="filter" type="button" class="btn btn-primary">Filter</button>
            </div>
            <div class="col-1">
                <form action="">
                    <button id="reset" type="button" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($siswa as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->nis}}</td>
                        <td>{{$value->nisn}}</td>
                        <td>{{$value->nama_siswa}}</td>
                        <td>{{$value->nama_kelas}}</td>
                        <td>{{$value->nama_thn_ajaran}}</td>
                        <td>{{$value->alamat}}</td>
                        <td>{{$value->no_telp}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $('#filter').on('click',function(){
                var selectedValue = $('#filter_kelas').val();
                var selectedValue2 = $('#filter_tahunajaran').val();
                table.column( 4 ) .search( selectedValue ) .draw();
                table.column( 5 ) .search( selectedValue2 ) .draw();
            });

            $('#reset').on('click',function(){
                $("#filter_kelas").prop('selectedIndex', 0).change();
                $("#filter_tahunajaran").prop('selectedIndex', 0).change();
                var selectedValue = $('#filter_kelas').val();
                var selectedValue2 = $('#filter_tahunajaran').val();
                table.column( 4 ) .search( selectedValue ) .draw();
                table.column( 5 ) .search( selectedValue2 ) .draw();
            });
        </script>
    </div>
</div>

</x-app-layout>