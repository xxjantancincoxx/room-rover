$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    $(".components li").on("click", function () {
        $(".components li").removeClass("active");
        $(this).addClass("active");
    });
});

