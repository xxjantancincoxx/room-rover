<?php $active_page = basename($_SERVER['PHP_SELF']); ?>
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li <?php echo ($active_page == "index.php" ? "class='mm-active'" : "") ?>><a class="ai-icon" href="index.php" aria-expanded="false">
                    <i class="fa-solid fa-chart-line"></i>
                    <span class="nav-text" style="<?php echo ($active_page == "index.php" ? "font-weight:bold; color:black" : "") ?>">Dashboard</span>
                </a>
            </li>
            <li><a class="ai-icon" href="my_listings.php" aria-expanded="false">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span class="nav-text" style="<?php echo ($active_page == "my_listings.php" || "add_listing.php" ? "font-weight:bold; color:black" : "") ?>">My Listings</span>
                </a>
            </li>
            <li><a class="ai-icon" href="reservations.php" aria-expanded="false">
                    <i class="fa-solid fa-house-circle-check"></i>
                    <span class="nav-text" style="<?php echo ($active_page == "reservations.php" ? "font-weight:bold; color:black" : "") ?>">Reservations</span>
                </a>
            </li>
            <li><a class="ai-icon" href="reviews_ratings.php" aria-expanded="false">
                    <i class="fa-solid fa-star-half-stroke"></i>
                    <span class="nav-text" style="<?php echo ($active_page == "reviews_ratings.php" ? "font-weight:bold; color:black" : "") ?>">Reviews & Ratings</span>
                </a>
            </li>
            <!-- <li><a class="ai-icon" href="messages.php" aria-expanded="false">
                    <i class="fa-solid fa-envelope"></i>
                    <span class="nav-text" style="<?php echo ($active_page == "messages.php" ? "font-weight:bold; color:black" : "") ?>">Messages</span>
                </a>
            </li> -->
            <li><a href="analytics_reports.php" class="ai-icon" aria-expanded="false">
                    <i class="fa-solid fa-magnifying-glass-chart"></i>
                    <span class="nav-text" style="<?php echo ($active_page == "analytics_reports.php" ? "font-weight:bold; color:black" : "") ?>">Analytics & Reports</span>
                </a>
            </li>
        </ul>
        <div class="add-menu-sidebar">
            <img src="../assets/images/calendar.png" alt="" class="mr-3">
            <p class="	font-w500 mb-0">RoomRover helps you to manage your boarding house online.</p>
        </div>
        <div class="copyright">
            <p><strong>RoomRover | Owner</strong> Capstone Project 2023</p>
            <p>Developed by  •| D3V</p>
        </div>
    </div>
</div>