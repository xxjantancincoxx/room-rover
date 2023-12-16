<?php $active_page = basename($_SERVER['PHP_SELF']); ?>
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li <?php echo ($active_page == "index.php" ? "class='mm-active'" : "") ?>><a class="ai-icon" href="index.php" aria-expanded="false">
                    <i class="fa-solid fa-chart-line"></i>
                    <span class="nav-text" style="<?php echo ($active_page == "index.php" ? "font-weight:bold; color:black" : "") ?>">Dashboard</span>
                </a>
            </li>
            <li><a class="ai-icon" href="search_rooms.php" aria-expanded="false">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="nav-text" style="<?php echo ($active_page == "search_rooms.php" ? "font-weight:bold; color:black" : "") ?>">Search Rooms</span>
                </a>
            </li>
            <li><a class="ai-icon" href="my_reservations.php" aria-expanded="false">
                    <i class="fa-solid fa-house-circle-check"></i>
                    <span class="nav-text" style="<?php echo ($active_page == "my_reservations.php" ? "font-weight:bold; color:black" : "") ?>">My Reservations</span>
                </a>
            </li>
            <li><a class="ai-icon" href="review.php" aria-expanded="false">
                    <i class="fa-solid fa-star-half-stroke"></i>
                    <span class="nav-text" style="<?php echo ($active_page == "review.php" ? "font-weight:bold; color:black" : "") ?>">Review</span>
                </a>
            </li>
        </ul>
        <div class="add-menu-sidebar">
            <img src="../assets/images/calendar.png" alt="" class="mr-3">
            <p class="	font-w500 mb-0">RoomRover helps you to manage your Reservation online.</p>
        </div>
        <div class="copyright">
            <p><strong>RoomRover | Owner</strong> Capstone Project 2023</p>
            <p>Developed by  •| D3V</p>
        </div>
    </div>
</div>