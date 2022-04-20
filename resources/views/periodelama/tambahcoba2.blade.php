<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen Periode PKL</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Periode PKL</h6>
    </div>
    <div class="card-body">
    <form action="#" method="post">
    <!-- @csrf -->
        <div class="form-group">
            <label for="tanggal_selesai">Periode Tanggal PKL<sup class="text-danger">*</sup></label>
                <div class="input-group">
                    <input type="text" id="startdate" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#startdate" autocomplete="off" />
                    <div class="input-group-append">
                        <span class="input-group-text">s/d</span>
                    </div>
                    <input type="text" id="enddate" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#enddate" autocomplete="off" />
                </div>
        </div>
        <div class="col text-right">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-danger" href="{{route('periode.index')}}">Batalkan</a>
        </div>
        <script type="text/javascript">
	        $(function(){
		        $("#tanggal_mulai").datepicker({
                    useCurrent: false,
			        autoclose: true,
			        dateFormat: 'DD/MM/YYYY'
		        }).datepicker('update', new Date());

                $("#tanggal_selesai").datepicker({
                    useCurrent: false,
			        autoclose: true,
			        dateFormat: 'DD/MM/YYYY'
		        }).datepicker('update', new Date());
	        });
        </script>
    </form>
    </div>
</div>
</x-app-layout>