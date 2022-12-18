<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pengajuan PKL</h1>
    {{-- <a class="btn btn-success mb-3" href="{{route('pengajuanPKL.ekspor')}}">Ekspor</a> --}}
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan PKL</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-2">Kelas</div>
            <div class="col-2">Tahun Ajaran</div>
        </div>
        <div class="row">
            <div class="col-2">
            <form action="{{route('pengajuanPKL.lihat')}}" method="GET">
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
                    <a class="btn btn-danger" href="{{route('pengajuanPKL.lihat')}}">Reset</a>
            </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="pengajuanTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Pengajuan PKL</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Tanggal Mulai PKL</th>
                        <th>Tanggal Selesai PKL</th>
                        <th>Nama DU/DI</th>
                        <th>Status POKJA PKL</th>
                        <th>Status Kaprog</th>
                        <th>Status Surat</th>
                        <th>Keterangan</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pengajuan as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->id}}</td>
                        <td>{{$value->nis}}</td>
                        <td>{{$value->nisn}}</td>
                        <td>{{$value->nama_siswa}}</td>
                        <td>{{$value->nama_kelas}}</td>
                        <td>{{$value->nama_thn_ajaran}}</td>
                        <td>{{$value->tanggal_mulai}}</td>
                        <td>{{$value->tanggal_selesai}}</td>
                        <td>{{$value->nama_dudi}}</td>
                        <td>
                            @if ($value->status_verif_pokja == 'Diproses')
                                <span class="badge badge-warning">{{$value->status_verif_pokja}}</span>
                            @elseif ($value->status_verif_pokja == 'Disetujui')
                                <span class="badge badge-success">{{$value->status_verif_pokja}}</span>
                            @else
                                <span class="badge badge-danger">{{$value->status_verif_pokja}}</span>
                            @endif
                        </td>
                        <td>
                            @if ($value->status_verif_kaprog == 'Diproses')
                                <span class="badge badge-warning">{{$value->status_verif_kaprog}}</span>
                            @elseif ($value->status_verif_kaprog == 'Disetujui')
                                <span class="badge badge-success">{{$value->status_verif_kaprog}}</span>
                            @else
                                <span class="badge badge-danger">{{$value->status_verif_kaprog}}</span>
                            @endif
                        </td>
                        <td>
                            @if ($value->status_surat == 'Diproses')
                                <span class="badge badge-warning">{{$value->status_surat}}</span>
                            @elseif ($value->status_surat == 'Selesai')
                                <span class="badge badge-success">{{$value->status_surat}}</span>
                            @else
                                <span class="badge badge-danger">{{$value->status_surat}}</span>
                            @endif
                        </td>
                        <td>{{$value->keterangan}}</td>
                        <td>{{$value->created_at}}</td>
                        <td>{{$value->updated_at}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-primary btn-sm" href="{{route('pengajuanPKL.showdetail', $value->id)}}">Detail</a>

                                @if (session('role') == 'Ketua Pokja PKL')
                                    @if ($value->status_verif_pokja == 'Diproses')
                                        <form action="{{ route('pengajuanPKL.terima_pengajuan_pokja',$value->id) }}" method="POST">
                                        @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Setuju</button>
                                        </form>
                        
                                        <form action="{{ route('pengajuanPKL.tolak_pengajuan_pokja',$value->id) }}" method="POST">
                                        @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                        </form>

                                    @else
                                        <form action="{{ route('pengajuanPKL.batal_pengajuan_pokja',$value->id) }}" method="POST">
                                        @csrf
                                            <button type="submit" class="btn btn-dark btn-sm">Batal</button>
                                            {{-- <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#keteranganModal">
                                                <i class="fas fa-fw fa-plus"></i>Keterangan
                                            </a> --}}
                                            <button type="button" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#keteranganModal" data-url="{{ route('pengajuanPKL.updateketerangan', $value->id) }}"
                                                data-value="{{ $value->keterangan }}"> <i class="fas fa-fw fa-plus"></i>Keterangan</button>
                                        </form>
                                    @endif
                                @endif

                                @if (session('role') == 'Kaprog')
                                    @if ($value->status_verif_kaprog == 'Diproses')
                                        <form action="{{ route('pengajuanPKL.terima_pengajuan_kaprog',$value->id) }}" method="POST">
                                        @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Setuju</button>
                                        </form>
                        
                                        <form action="{{ route('pengajuanPKL.tolak_pengajuan_kaprog',$value->id) }}" method="POST">
                                        @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                        </form>

                                    @else
                                        <form action="{{ route('pengajuanPKL.batal_pengajuan_kaprog',$value->id) }}" method="POST">
                                        @csrf
                                            <button type="submit" class="btn btn-dark btn-sm">Batal</button>
                                            <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#keteranganModal" data-url="{{ route('pengajuanPKL.updateketerangan', $value->id) }}"
                                                data-value="{{ $value->keterangan }}">
                                                <i class="fas fa-fw fa-plus"></i>Keterangan
                                            </a>
                                        </form>

                                    @endif
                                @endif

                                @if (session('role') == 'Tata Usaha')
                                    @if ($value->status_verif_pokja == 'Disetujui' && $value->status_verif_kaprog == 'Disetujui')
                                        <a class="btn btn-info btn-sm" id="cetak" href="{{ route('pengajuanPKL.create_surat_pengantar',$value->id) }}" target="_blank">Cetak</a>
                                    @else
                                        <button type="submit" class="btn btn-info btn-sm" disabled>Cetak</button>
                                    @endif
                                    @if ($value->status_surat == 'Diproses')
                                        <form action="{{ route('pengajuanPKL.surat_selesai',$value->id) }}" method="POST">
                                        @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                        </form>
                        
                                        <form action="{{ route('pengajuanPKL.surat_tidak_diproses',$value->id) }}" method="POST">
                                        @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Tidak dapat diproses</button>
                                        </form>

                                    @else
                                        <form action="{{ route('pengajuanPKL.surat_diproses',$value->id) }}" method="POST">
                                        @csrf
                                            <button type="submit" class="btn btn-dark btn-sm">Batal</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- Keterangan modal --}}
        <div class="modal fade" id="keteranganModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form method="POST">
            @method('PUT')
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Keterangan</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Keterangan<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="keterangan"
                                placeholder="Masukkan keterangan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button class="btn btn-danger" type="button"
                            data-dismiss="modal">Batalkan</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
 
        {{-- <script type="text/javascript">
            // $('#filter').on('click',function(){
            //     var selectedValue = $('#filter_kelas').val();
            //     var selectedValue2 = $('#filter_tahunajaran').val();
            //     table.column( 5 ) .search( selectedValue ) .draw();
            //     table.column( 6 ) .search( selectedValue2 ) .draw();
            // });

            // $('#reset').on('click',function(){
            //     $("#filter_kelas").prop('selectedIndex', 0).change();
            //     $("#filter_tahunajaran").prop('selectedIndex', 0).change();
            //     var selectedValue = $('#filter_kelas').val();
            //     var selectedValue2 = $('#filter_tahunajaran').val();
            //     table.column( 5 ) .search( selectedValue ) .draw();
            //     table.column( 6 ) .search( selectedValue2 ) .draw();
            // });
        </script> --}}
    </div>
</div>
@push('scripts')
<script>
    var table = $('#pengajuanTable').DataTable({
        "scrollX": true,
        dom: '<lfB<t>ip>',
        "responsive": true,
        orderable: [
            [16, "asc"]
        ],
        lengthMenu: [
            [ 10, 25, 50, 100, 1000, -1 ],
            [ '10', '25', '50', '100', '1000', 'All' ]
        ],
        columnDefs: [
            {
                "searchable": false,
                "orderable": false,
                "targets": 16,
            },
        ],
        buttons: [
            {
                extend: 'excel',
                text: 'Ekspor',
                title: "Data Pengajuan PKL SMKN 2 Balikpapan",
                className: "button-datatables",
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    },
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                }
            }
        ]
    });

    $('#keteranganModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var url = button.data('url') 
        var value = button.data('value') 
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('form').attr('action', url)
        modal.find('input[name="keterangan"]').val(value)
    });
</script>
@endpush
</x-app-layout>