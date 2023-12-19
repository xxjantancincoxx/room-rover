<nav class="navbar navbar-expand-lg">
  <button type="button" id="sidebarCollapse" class="btn border border-dark">
		<i class="fas fa-align-left"></i>
	</button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-secondary" style="right:0;padding-right: 40px;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user-alt"></i>&nbsp;&nbsp;<?php echo $_SESSION["username"] ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <?php echo "<a class=\"dropdown-item\" href=\"profile.php?sesion=" . $_SESSION["session"] . "\">Profile</a>"; ?>
          <a class="dropdown-item text-danger" href="../backend/logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>