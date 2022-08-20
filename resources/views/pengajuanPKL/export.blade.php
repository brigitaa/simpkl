<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
            <th>Created At</th>
            <th>Updated At</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pengajuan as $value)
        <tr>
            <td></td>
            <td>{{$value->id}}</td>
            <td>{{$value->nis}}</td>
            <td>{{$value->nisn}}</td>
            <td>{{$value->nama_siswa}}</td>
            <td>{{$value->nama_kelas}}</td>
            <td>{{$value->nama_thn_ajaran}}</td>
            <td>{{$value->tanggal_mulai}}</td>
            <td>{{$value->tanggal_selesai}}</td>
            <td>{{$value->nama_dudi}}</td>
            <td>{{$value->status_verif_pokja}}</td>
            <td>{{$value->status_verif_kaprog}}</td>
            <td>{{$value->created_at}}</td>
            <td>{{$value->updated_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>