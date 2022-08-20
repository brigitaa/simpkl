{{-- <!-- Core plugin JavaScript-->
<script src="{{asset('template')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
{{-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> --}}


{{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>  
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js   "></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script> --}}

{{-- <script src="{{asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('template/js/sb-admin-2.min.js')}}"></script> --}}

<!-- Page level plugins -->
{{-- <script src="{{asset('template/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('datapicker/js/jquery.min.js')}}"></script>
<script src="{{ asset('datepicker')}}/js/bootstap.min.js"></script>
<script src="{{asset('datapicker/js/bootstrap.min.js')}}"></script>
<script src="{{asset('datapicker/js/bootstrap.min.js')}}"></script>
<script src="{{asset('datapicker/libraries/moment/moment.min.js')}}"></script>
<script src="{{asset('datapicker/js/custom.js')}}"></script>
<script src="{{asset('datapicker/libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script> -->
<script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script> --}}

<!-- Page level custom scripts -->
{{-- <script src="{{asset('template/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('template/js/demo/chart-pie-demo.js')}}"></script>
<script src="{{asset('template/js/demo/datatables-demo.js')}}"></script>
@stack('scripts') --}}

<!-- Bootstrap core JavaScript-->

<script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

{{-- datatables --}}
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js   "></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

{{-- datepicker --}}

        
<!-- Custom scripts for all pages-->
<script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('template/js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('template/js/demo/datatables-demo.js')}}"></script>


<!-- Core plugin JavaScript-->
<script src="{{asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
@stack('scripts')