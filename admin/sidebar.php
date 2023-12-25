<nav id="sidebar" class="border-right">
	<div class="sidebar-header" >
		<img class="logo" src="../assets/images/logorr.png" alt="">
		<span>Admin</span>
	</div>
	<ul class="list-unstyled components">
		<?php $session = $_SESSION["session"]; ?>
		<li id="dashboard">
			<?php echo "<a href=\"index.php?session=" . $session . "\"><p><i class=\"fas fa-list mr-2\"></i>Dashboard</p></a>"; ?>
		</li>
		<li id="reviews">
			<?php echo "<a href=\"reviews.php?session=" . $session . "\"><p><i class=\"fa fa-star mr-2\"></i>Reviews</p></a>"; ?>
		</li>
		<li id="user-management">
			<?php echo "<a href=\"user_management.php?session=" . $session . "\"><p><i class=\"fa fa-users mr-2\"></i>User Management</p></a>"; ?>
		</li>
	</ul>
	
</nav>