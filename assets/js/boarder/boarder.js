// $(document).ready(function () {
//   $('#dtBasicExample').DataTable();
//   $('.dataTables_length').addClass('bs-select');
// });

$(document).ready(function () {
    // $("#my-listing-div").hide();
  
    $('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
    });
  
    if (window.location.href.includes("index.php?")) {
      $("#searchRooms").removeClass("active");
      $("#myReservations").removeClass("active");
      $("#reviews").removeClass("active");
      $("#dashboard").addClass("active");
    }
  
    if (window.location.href.includes("search_rooms.php?")) {
        $("#dashboard").removeClass("active");
        $("#myReservations").removeClass("active");
        $("#reviews").removeClass("active");
        $("#searchRooms").addClass("active");
    }
  
    if (window.location.href.includes("my_reservations.php?")) {
        $("#dashboard").removeClass("active");
        $("#searchRooms").removeClass("active");
        $("#reviews").removeClass("active");
        $("#myReservations").addClass("active");
    }
  
    if (window.location.href.includes("review.php?")) {
        $("#dashboard").removeClass("active");
        $("#searchRooms").removeClass("active");
        $("#myReservations").removeClass("active");
        $("#reviews").addClass("active");
    }
  
    $(".components li").on("click", function () {
        $(".components li").removeClass("active");
        $(this).addClass("active");
      });
  
  });
  
  