<nav id="sidebar">
	<div class="sidebar-header" >
		<img class="logo" src="../assets/images/logorr.png" alt="">
		<span>Owner</span>
	</div>
	<ul class="list-unstyled components">
		<li class="active">
			<?php echo "<a href=\"index.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-list mr-2\"></i>Dashboard</p></a>"; ?>
			
		</li>
		<li>
			<?php echo "<a href=\"my_listings.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-search mr-2\"></i>My Listings</p></a>" ?>
		</li>
		<li>
			<?php echo "<a href=\"reservations.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-home mr-2\"></i>Reservations</p></a>" ?>
		</li>
		<li>
			<?php echo "<a href=\"reviews_ratings.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-star mr-2\"></i>Reviews & Ratings</p></a>" ?>
		</li>
    <li>
			<?php echo "<a href=\"analytics_reports.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-search-plus mr-1\"></i>Analytics & Reports</p></a>" ?>
		</li>
	</ul>
</nav>