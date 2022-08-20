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
            <table class="table table-bordered" id="keahlianTable" width="100%" cellspacing="0">
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
                <tbody>
                @foreach($kompetensi_keahlian as $value)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$value->kode_keahlian}}</td>
                        <td>{{$value->nama_keahlian}}</td>
                        <td>{{$value->created_at}}</td>
                        <td>{{$value->updated_at}}</td>
                        <td>
                        <form action="{{ route('kompetensikeahlian.destroy',$value->id) }}" method="POST">
                            <a class="btn btn-warning btn-sm" href="{{route('kompetensikeahlian.edit', $value->id)}}">Ubah</a>
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
    </div>
    
</div>
@push('scripts')
<script>
    var table = $('#keahlianTable').DataTable({
        "scrollX": true,
        dom: '<lfB<t>ip>',
        "responsive": true,
        orderable: [
            [5, "asc"]
        ],
        lengthMenu: [
            [ 10, 25, 50, 100, 1000, -1 ],
            [ '10', '25', '50', '100', '1000', 'All' ]
        ],
        columnDefs: [
            {
                "searchable": false,
                "orderable": false,
                "targets": 5,
            },
        ],
        buttons: [
            {
                extend: 'excel',
                text: 'Ekspor',
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    },
                    columns: [ 0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdf',
                text: 'Pdf',
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    },
                    columns: [ 0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all'
                    },
                    columns: [ 0, 1, 2, 3, 4]
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

