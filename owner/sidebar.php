<nav id="sidebar" class="border border-right">
	<div class="sidebar-header" >
		<img class="logo" src="../assets/images/logorr.png" alt="">
		<span>Owner</span>
	</div>
	<ul class="list-unstyled components">
		<li id="dashboard-sidebar">
			<?php echo "<a href=\"index.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-list mr-1\"></i>Dashboard</p></a>"; ?>
			
		</li>
		<li id="my-listings-sidebar">
			<?php echo "<a href=\"my_listings.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-search mr-1\"></i>My Listings</p></a>" ?>
		</li>
		<li id="reservations-sidebar">
			<?php echo "<a href=\"reservations.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-home mr-1\"></i>Reservations</p></a>" ?>
		</li>
		<li id="reviews-ratings-sidebar">
			<?php echo "<a href=\"reviews_ratings.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-star mr-1\"></i>Reviews & Ratings</p></a>" ?>
		</li>
    <li id="analytivs-reports-sidebar">
			<?php echo "<a href=\"analytics_reports.php?session=" . $_SESSION["session"] . "\"><p class=\"pr-0\"><i class=\"fas fa-search-plus mr-1 pr-0\"></i>Analytics & Reports</p></a>" ?>
		</li>
    <li id="analytivs-reports-sidebar">
			<?php echo "<a href=\"notification.php?session=" . $_SESSION["session"] . "\"><p class=\"pr-0\"><i class=\"fas fa-bell mr-1 pr-0\"></i>Notifications</p></a>" ?>
		</li>
	</ul>
</nav>