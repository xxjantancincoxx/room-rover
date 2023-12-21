$(document).ready(function () {
	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
	});

	if (window.location.href.includes("index.php?")) {
		$("#my-listings-sidebar").removeClass("active");
		$("#reviews-ratings-sidebar").removeClass("active");
		$("#reservations-sidebar").removeClass("active");
		$("#analytivs-reports-sidebar").removeClass("active");
		$("#dashboard-sidebar").addClass("active");
	}

	if (window.location.href.includes("my_listings.php?")) {
		$("#dashboard-sidebar").removeClass("active");
		$("#reviews-ratings-sidebar").removeClass("active");
		$("#reservations-sidebar").removeClass("active");
		$("#analytivs-reports-sidebar").removeClass("active");
		$("#my-listings-sidebar").addClass("active");
	}

	if (window.location.href.includes("reservations.php?")) {
		$("#dashboard-sidebar").removeClass("active");
		$("#reviews-ratings-sidebar").removeClass("active");
		$("#my-listings-sidebar").removeClass("active");
		$("#analytivs-reports-sidebar").removeClass("active");
		$("#reservations-sidebar").addClass("active");
	}

	if (window.location.href.includes("reviews_ratings.php?")) {
		$("#dashboard-sidebar").removeClass("active");
		$("#my-listings-sidebar").removeClass("active");
		$("#reservations-sidebar").removeClass("active");
		$("#analytivs-reports-sidebar").removeClass("active");
		$("#reviews-ratings-sidebar").addClass("active");
	}

	if (window.location.href.includes("analytics_reports.php?")) {
		$("#dashboard-sidebar").removeClass("active");
		$("#reviews-ratings-sidebar").removeClass("active");
		$("#reservations-sidebar").removeClass("active");
		$("#my-listings-sidebar").removeClass("active");
		$("#analytivs-reports-sidebar").addClass("active");
	}


	$(".components li").on("click", function () {
		$(".components li").removeClass("active");
		$(this).addClass("active");
	});
});

