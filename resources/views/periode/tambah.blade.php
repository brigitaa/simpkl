<x-app-layout>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manajemen Periode PKL</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Periode PKL</h6>
    </div>
    <div class="card-body">
    <form action="{{route('periode.store')}}" method="post">
    @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tanggal_mulai">Tanggal Mulai PKL<sup class="text-danger">*</sup></label>
                <div id="tanggal_mulai" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input type="text" class="form-control datepicker" name="tanggal_mulai" placeholder="Masukkan Tanggal Mulai">
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
                    <input type="text" class="form-control datepicker" name="tanggal_selesai" placeholder="Masukkan Tanggal Selesai" value="{{old('tanggal_selesai')}}">
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
            $(".datepicker").datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            });

            $("#tanggal_mulai").on('changeDate', function(selected) {
                var startDate = new Date(selected.date.valueOf());
                $("#tanggal_selesai").datepicker('setStartDate', startDate);
                if($("#tanggal_mulai").val() > $("#tanggal_selesai").val()){
                $("#tanggal_selesai").val($("#tanggal_mulai").val());
                }
            });
        });
        </script>
        <!-- <script type="text/javascript">
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
        </script> -->
    </form>
    </div>
</div>
@push('scripts')
<script src="{{asset('datapicker/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('datepicker/js/bootstap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('datapicker/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('datapicker/libraries/moment/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('datapicker/js/custom.js')}}" type="text/javascript"></script>
<script src="{{asset('datapicker/libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
@endpush
</x-app-layout>