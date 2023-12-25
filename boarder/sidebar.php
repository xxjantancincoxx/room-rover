<nav id="sidebar" class="border border-right components">
	<div class="sidebar-header">
		<img class="logo" src="../assets/images/logorr.png" alt="">
		<span>Boarder</span>
	</div>
	<ul class="list-unstyled components">
		<li id="dashboard">
			<?php echo "<a href=\"index.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-list mr-2\"></i>Dashboard</p></a>"; ?>
		</li>
		<li id="searchRooms">
			<?php echo "<a href=\"search_rooms.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-search mr-2\"></i>Search Rooms</p></a>" ?>
		</li>
		<li id="myReservations">
			<?php echo "<a href=\"my_reservations.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-home mr-2\"></i>My Reservations</p></a>" ?>
		</li>
		<li id="reviews">
			<?php echo "<a href=\"review.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-star mr-2\"></i>Reviews</p></a>" ?>
		</li>
	</ul>
</nav>