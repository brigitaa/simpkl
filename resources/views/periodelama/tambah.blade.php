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
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tanggal_mulai">Tanggal Mulai PKL<sup class="text-danger">*</sup></label>
                <div id="tanggal_mulai" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input type="text" class="form-control" name="tanggal_mulai" placeholder="Masukkan Tanggal Mulai">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-fw fa-calendar"></i></span>
                    </div>
                </div>
                <div class="text-danger">
                    @error('tanggal_mulai')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="tanggal_selesai">Tanggal Selesai PKL<sup class="text-danger">*</sup></label>
                <div id="tanggal_selesai" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input type="text" class="form-control" name="tanggal_selesai" placeholder="Masukkan Tanggal Selesai" onfocus="(this.type='date')" value="{{old('tanggal_selesai')}}">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-fw fa-calendar"></i></span>
                    </div>
                </div>
                <div class="text-danger">
                    @error('tanggal_selesai')
                        {{ $message }}
                    @enderror
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