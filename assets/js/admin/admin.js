$(document).ready(function () {


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

  var previousActiveTabIndex = 0;

  $(".tab-switcher").on('click keypress', function (event) {
    // event.which === 13 means the "Enter" key is pressed

    if ((event.type === "keypress" && event.which === 13) || event.type === "click") {

      var tabClicked = $(this).data("tab-index");

      if (tabClicked != previousActiveTabIndex) {
        $("#allTabsContainer .tab-container").each(function () {
          if ($(this).data("tab-index") == tabClicked) {
            $(".tab-container").hide();
            $(this).show();
            previousActiveTabIndex = $(this).data("tab-index");
            return;
          }
        });
      }
    }
  });
});

