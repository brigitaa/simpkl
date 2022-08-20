<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Kepala Sekolah</h1>
    <a class="btn btn-warning mb-3" href="{{route('kepalasekolah.edit', $kepalasekolah->id)}}">Ubah</a>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Data Kepala Sekolah</h6>
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
                                        <td width="20%" style="font-weight:bold">NIP</td>
                                        <td>: {{$kepalasekolah->nip}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Nama Lengkap</td>
                                        <td>: {{$kepalasekolah->nama_kepsek}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Jabatan</td>
                                        <td>: {{$kepalasekolah->jabatan}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold">Pangkat Golongan</td>
                                        <td>: {{$kepalasekolah->pangkat_gol}}</td>
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