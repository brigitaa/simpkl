<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pengajuan PKL</h1>
<a class="btn btn-primary mb-3" href="{{route('pengajuanPKL.lihat')}}"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Data Pengajuan PKL</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table width="100%" cellspacing="0">
                <tbody>
                    <tr>
                        <td valign="top">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td width="35%" style="font-weight:bold">ID Pengajuan</td>
                                        <td>: {{$pengajuan->id}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Nama Lengkap Siswa</td>
                                        <td>: {{$siswa->nama_siswa}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Nomor Induk Siswa (NIS)</td>
                                        <td>: {{$siswa->nis}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Nomor Induk Siswa Nasional (NISN)</td>
                                        <td>: {{$siswa->nisn}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Jenis Kelamin</td>
                                        <td>: {{$siswa->jeniskelamin}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">No. Telepon</td>
                                        <td>: {{$siswa->no_telp}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Periode PKL</td>
                                        <td>: {{$dataperiode->tanggal_mulai}} s/d {{$dataperiode->tanggal_selesai}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Nama DU/DI</td>
                                        <td>: {{$datadudi->nama_dudi}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Alamat DU/DI</td>
                                        <td>: {{$datadudi->alamat_dudi}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Surat Pernyataan Orang Tua</td>
                                        <td>: <a href="{{route('pengajuanPKL.file_pernyataanortu', $pengajuan->id)}}">{{$pengajuan->pernyataan_ortu}}</a></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Surat Pernyataan Siswa</td>
                                        <td>: <a href="{{route('pengajuanPKL.file_pernyataansiswa', $pengajuan->id)}}">{{$pengajuan->pernyataan_siswa}}</a></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Status Verifikasi Ketua Pokja PKL</td>
                                        <td>: 
                                            @if ($pengajuan->status_verif_pokja == 'Diproses')
                                                <span class="badge badge-warning">{{$pengajuan->status_verif_pokja}}</span>
                                            @elseif ($pengajuan->status_verif_pokja == 'Disetujui')
                                                <span class="badge badge-success">{{$pengajuan->status_verif_pokja}}</span>
                                            @else
                                                <span class="badge badge-danger">{{$pengajuan->status_verif_pokja}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Status Verifikasi Ketua Program Keahlian</td>
                                        <td>: 
                                            @if ($pengajuan->status_verif_kaprog == 'Diproses')
                                                <span class="badge badge-warning">{{$pengajuan->status_verif_kaprog}}</span>
                                            @elseif ($pengajuan->status_verif_kaprog == 'Disetujui')
                                                <span class="badge badge-success">{{$pengajuan->status_verif_kaprog}}</span>
                                            @else
                                                <span class="badge badge-danger">{{$pengajuan->status_verif_kaprog}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Status Surat Pengantar PKL</td>
                                        <td>: 
                                            @if ($pengajuan->status_surat == 'Diproses')
                                                <span class="badge badge-warning">{{$pengajuan->status_surat}}</span>
                                            @elseif ($pengajuan->status_surat == 'Selesai')
                                                <span class="badge badge-success">{{$pengajuan->status_surat}}</span>
                                            @else
                                                <span class="badge badge-danger">{{$pengajuan->status_surat}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Keterangan</td>
                                        <td>: {{$pengajuan->keterangan}}</td>
                                    </tr>
                    </tbody></table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</x-app-layout>