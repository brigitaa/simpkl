$(document).ready(function () {
    $('#dataTable').DataTable({
      "scrollX": true,
      buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    });
    $('.dataTables_length').addClass('bs-select');
});