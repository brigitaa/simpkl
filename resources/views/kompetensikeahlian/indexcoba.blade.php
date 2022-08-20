<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen Kompetensi Keahlian</h1>
    <a class="btn btn-success mb-3" href="{{route('kompetensikeahlian.create')}}">Tambah</a>

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
        <h6 class="m-0 font-weight-bold text-primary">Daftar Kompetensi Keahlian</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="keahlian_table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Kompetensi Keahlian</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
            
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#keahlian_table').DataTable({
                        processing : true,
                        serverSide : true,
                        "scrollX": true,
                        ajax : {
                            url: "{{route('kompetensikeahlian.get_data_keahlian')}}",
                            type: 'GET'
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_Row_Index',
                                orderable: false, 
                                searchable: false
                            }, {
                                data: 'kode_keahlian',
                                name: 'kode_keahlian'
                            }, {
                                data: 'nama_keahlian',
                                name: 'nama_keahlian'
                            }, {
                                data: 'created_at'
                            }, {
                                data: 'updated_at'
                            }, {
                                data: 'aksi'
                            }],
                    });
                });
            </script>
        </div>
    </div>
</div>

</x-app-layout>