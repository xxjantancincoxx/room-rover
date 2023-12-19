// $(document).ready(function () {
//   $('#dtBasicExample').DataTable();
//   $('.dataTables_length').addClass('bs-select');
// });

$(document).ready(function () {
  $('#dtHorizontalVerticalExample').DataTable({
    "scrollX": true,
    "scrollY": 200,
  });
  $('.dataTables_length').addClass('bs-select');
});