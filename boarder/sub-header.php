<?php
require_once('../backend/DBconn.php');

// Assuming $_SESSION['id'] contains the session ID
$session_id = $_SESSION['id'];

// Query to get the username based on the session ID
$sql = "SELECT username FROM accounts WHERE id = '$session_id'";
$temp_result = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($temp_result);

// Check if a user was found
if ($result["username"]) {
    $username = $result['username'];
}
?>
<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        <?php
                            switch($current_page){
                                case "index.php":
                                    echo("Dashboard");
                                    break;
                                case "search_rooms.php":
                                    echo("Search for Rooms");
                                    break;
                                case "my_reservations.php":
                                    echo("My Reservations");
                                    break;
                                case "review.php":
                                    echo("My Reviews");
                                    break;
                            }
                        ?>
                    </div>
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                        <i class="fa fa-user fa-2xl" aria-hidden="true"></i>
                            <div class="header-info">
                                <span class="text-black"><strong><?php echo $username; ?></strong></span>
                                <p class="fs-12 mb-0">Boarder</p>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="profile.php" class="dropdown-item ai-icon">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="ml-2">Profile </span>
                            </a>
                            <a href="../backend/logout.php" class="dropdown-item ai-icon">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="ml-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>