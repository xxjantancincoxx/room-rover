<nav id="sidebar">
	<div class="sidebar-header" >
		<img class="logo" src="../assets/images/logorr.png" alt="">
		<span>Admin</span>
	</div>
	<ul class="list-unstyled components">
		<li class="active">
			<?php echo "<a href=\"index.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-list mr-2\"></i>Dashboard</p></a>"; ?>
			
		</li>
		<li>
			<?php echo "<a href=\"search_rooms.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-search mr-2\"></i>View Requests</p></a>" ?>
		</li>
		<li>
			<?php echo "<a href=\"my_reservations.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-home mr-2\"></i>Boarding Houses</p></a>" ?>
		</li>
		<li>
			<?php echo "<a href=\"review.php?session=" . $_SESSION["session"] . "\"><p><i class=\"fas fa-star mr-2\"></i>Reviews</p></a>" ?>
		</li>
	</ul>
</nav>