<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<style>
	.sticky {
  position: fixed;
  top: 0;
  width: 100%;
	border-bottom: 2px #656c74 solid;
}
</style>
    
<header class="header-area sticky" id="top">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav class="main-nav">
					<a href="index.html" class="logo">Room<em>Rover</em></a>
					<ul class="nav">
						<li><a href="index.php" class="<?php if ($current_page == 'index.php') echo 'active' ?>" id="hover-nav">Home</a></li>
						<!-- <li><a href="rooms.php" class="< ?php if ($current_page == 'rooms.php') echo 'active' ?>" id="hover-nav">Rooms</a></li>  -->
						<div class="user_auth">
								<li style="display:flex; align-items:center; gap:7px"><a href="login.php" class="<?php if ($current_page == 'login.php') echo 'active' ?>" id="hover-nav">Login</a> | <a href="select_user_type.php" class="<?php if ($current_page == 'signup.php' || $current_page == 'select_user_type.php') echo 'active' ?>" id="hover-nav">Signup</a></li>
						</div>
					</ul>
				</nav>
			</div>
		</div>
    </div>
</header>