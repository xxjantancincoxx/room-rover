// $(document).ready(function () {
//   $('#dtBasicExample').DataTable();
//   $('.dataTables_length').addClass('bs-select');
// });

$(document).ready(function () {
  // $("#my-listing-div").hide();

  $('#dtHorizontalVerticalExample').DataTable({
    "scrollX": true,
    "scrollY": 200,
  });
  $('.dataTables_length').addClass('bs-select');

  // $("#sidebar-my-listings").click(function(){
  //   $("#dashboard-content-div").hide(1000);
  //   $("#my-listing-div").show(1000);
  // });
});

