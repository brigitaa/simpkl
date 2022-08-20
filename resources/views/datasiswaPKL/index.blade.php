<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Siswa PKL</h1>
    <a class="btn btn-success mb-3" href="{{route('datasiswaPKL.impor')}}">Impor</a>
    <a class="btn btn-success mb-3" href="{{route('datasiswaPKL.create')}}">Tambah</a>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @endif

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
            <form action="{{route('datasiswaPKL.index')}}" method="GET">
                <div class="form-group">
                    <select class="form-control select2" id="filter_kelas" name="nama_kelas">
                        <option value="">Semua</option>
                        @foreach($kelas as $key => $value)
                            <option value="{{$value->nama_kelas}}">{{$value->nama_kelas}}</option>
                        @endforeach
                    </select>
                    <script>document.getElementById('filter_kelas').value = "<?php if (isset($_GET['nama_kelas']) && $_GET['nama_kelas']) echo $_GET['nama_kelas'];?>";</script>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control select2" id="filter_tahunajaran" name="nama_thn_ajaran">
                        <option value="">Semua</option>
                        @foreach($tahunajaran as $key => $value)
                            <option value="{{$value->nama_thn_ajaran}}">{{$value->nama_thn_ajaran}}</option>
                        @endforeach
                    </select>
                    <script>document.getElementById('filter_tahunajaran').value = "<?php if (isset($_GET['nama_thn_ajaran']) && $_GET['nama_thn_ajaran']) echo $_GET['nama_thn_ajaran'];?>";</script>
                </div>
            </div>
            <div>
                <button id="filter" type="submit" class="btn btn-primary">Filter</button>
            </div>
            <div class="col-1">
                {{-- <button id="reset" type="button" class="btn btn-danger">Reset</button> --}}
                <a class="btn btn-danger" href="{{route('datasiswaPKL.index')}}">Reset</a>
            </div>
            </form>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered" id="datasiswaTable" width="100%" cellspacing="0">
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
                        <th>Aksi</th>
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
                        <td>
                            <form action="{{ route('datasiswaPKL.destroy',$value->id) }}" method="POST">
                                <a class="btn btn-warning btn-sm" href="{{route('datasiswaPKL.edit', $value->id)}}">Ubah</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{-- <script type="text/javascript">
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
        </script> --}}
    </div>
</div>
@push('scripts')
<script>
    var table = $('#datasiswaTable').DataTable({
        "scrollX": true,
        dom: '<lfB<t>ip>',
        "responsive": true,
        orderable: [
            [7, "asc"]
        ],
        lengthMenu: [
            [ 10, 25, 50, 100, 1000, -1 ],
            [ '10', '25', '50', '100', '1000', 'All' ]
        ],
        columnDefs: [
            {
                "searchable": false,
                "orderable": false,
                "targets": 7,
            },
        ],
        buttons: [
            {
                extend: 'excel',
                text: 'Ekspor',
                title: "Data Siswa PKL SMKN 2 Balikpapan",
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    },
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'pdf',
                text: 'Pdf',
                title: "Data Siswa PKL SMKN 2 Balikpapan",
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    },
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                title: "Data Siswa PKL SMKN 2 Balikpapan",
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all'
                    },
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
        ],
        language: {
            "searchPlaceholder": "",
            "zeroRecords": "Tidak ditemukan data yang sesuai",
            "emptyTable": "Tidak terdapat data di tabel"
        }
    });
</script>
@endpush
</x-app-layout>