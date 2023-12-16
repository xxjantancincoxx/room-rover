<?php
include('layouts/header.php');
session_start();
require_once('backend/DBconn.php');

// Set the BASE_URL
$BASE_URL = 'http://localhost/room_rover/';

// Fetch room data from the database
// Define the number of rooms per page
$roomsPerPage = 4;

// Determine the current page (default to page 1 if not set)
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the offset based on the current page
$offset = ($page - 1) * $roomsPerPage;

// Fetch room data from the database with pagination
$sql = "SELECT * FROM tbl_listings where rooms_Available >=1 LIMIT :offset, :limit";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $roomsPerPage, PDO::PARAM_INT);
$stmt->execute();

// Fetch the results as an associative array
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<style>
  .card {
        position: relative;
        width: 300px;
        height: 300px;
        color: #2e2d31;
        background: #ffffff; /* Set background color to white */
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle box shadow for depth */
    }

.temporary_text {
  font-weight: bold;
  font-size: 24px;
  padding: 6px 12px;
  color: #f8f8f8;
}

.card_title {
  font-weight: bold;
}

.card_content {
  position: absolute;
  left: 0;
  bottom: 0;
    /* edit the width to fit card */
  width: 100%;
  padding: 20px;
  background: #f2f2f2;
  border-top-left-radius: 20px;
    /* edit here to change the height of the content box */
  transform: translateY(150px);
  transition: transform .25s;
}

.card_content::before {
  content: '';
  position: absolute;
  top: -47px;
  right: -45px;
  width: 100px;
  height: 100px;
  transform: rotate(-175deg);
  border-radius: 50%;
  box-shadow: inset 48px 48px #f2f2f2;
}

.card_title {
  color: #131313;
  line-height: 15px;
}

.card_subtitle {
  display: block;
  font-size: 14px;
  margin-top: 10px;
}

.card_description {
  font-size: 14px;
  opacity: 0;
  transition: opacity .5s;
}

.card:hover .card_content {
  transform: translateY(0);
}

.card:hover .card_description {
  opacity: 1;
  transition-delay: .25s;
}

.reserve{
  display: flex;
  justify-content: end;
  margin-top: .2rem;
}
.reserve-btn{
  display: none;
}

.card:hover .reserve-btn {
 position: relative;
 display: inline-block;
 cursor: pointer;
 outline: none;
 border: 0;
 vertical-align: middle;
 text-decoration: none;
 background: transparent;
 padding: 0;
 font-size: inherit;
 font-family: inherit;
}

.reserve-btn.learn-more {
 width: 9rem;
 height: auto;
}

.reserve-btn.learn-more .circle {
 transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
 position: relative;
 display: block;
 margin: 0;
 width: 2rem;
 height: 2rem;
 background: #282936;
 border-radius: 1.625rem;
}

.reserve-btn.learn-more .circle .icon {
 transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
 position: absolute;
 top: 0;
 bottom: 0;
 margin: auto;
 background: #fff;
}

.reserve-btn.learn-more .circle .icon.arrow {
 transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
 left: 0.225rem;
 width: 1.125rem;
 height: 0.125rem;
 background: none;
}

.reserve-btn.learn-more .circle .icon.arrow::before {
 position: absolute;
 content: "";
 top: -0.30rem;
 right: 0.0625rem;
 width: 0.625rem;
 height: 0.625rem;
 border-top: 0.125rem solid #fff;
 border-right: 0.125rem solid #fff;
 transform: rotate(45deg);
}

.reserve-btn.learn-more .button-text {
 transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
 position: absolute;
 top: 0;
 left: 0;
 right: 0;
 bottom: 0;
 padding: 0.4rem 0;
 margin: 0 0 0 1.85rem;
 color: #282936;
 font-weight: 700;
 line-height: 1.3;
 text-align: center;
 text-transform: uppercase;
}

.reserve-btn:hover .circle {
 width: 100%;
}

.reserve-btn:hover .circle .icon.arrow {
 background: #fff;
 transform: translate(1rem, 0);
}

.reserve-btn:hover .button-text {
 color: #fff;
}


#rs-btn {
    height: 2.8em;
    width: 9em;
    background: #FFFFFF;
    -webkit-animation: jello-horizontal 0.9s both;
    animation: jello-horizontal 0.9s both;
    border: 2px solid #000000;
    outline: none;
    color: #000000;
    font-size: 17px;
}

#rs-btn:hover {
    background: #656C74;
    color: #ffffff;
    animation: squeeze3124 0.9s both;
}

@keyframes squeeze3124 {
    0% {
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
    }

    30% {
        -webkit-transform: scale3d(1.25, 0.75, 1);
        transform: scale3d(1.25, 0.75, 1);
    }

    40% {
        -webkit-transform: scale3d(0.75, 1.25, 1);
        transform: scale3d(0.75, 1.25, 1);
    }

    50% {
        -webkit-transform: scale3d(1.15, 0.85, 1);
        transform: scale3d(1.15, 0.85, 1);
    }

    65% {
        -webkit-transform: scale3d(0.95, 1.05, 1);
        transform: scale3d(0.95, 1.05, 1);
    }

    75% {
        -webkit-transform: scale3d(1.05, 0.95, 1);
        transform: scale3d(1.05, 0.95, 1);
    }

    100% {
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
    }
}
.cards-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 5rem;
    }

    .card img {
    max-width: 100%;
    height: auto;
    /* transform: scale(1.21); Remove or adjust this line */
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination a {
    color: #fff;
    background-color: #656C74;
    padding: 8px 12px;
    margin: 0 4px;
    text-decoration: none;
    border-radius: 4px;
}

.pagination a:hover {
    background-color: #282936;
}


</style>

<body>
    <!-- ***** Loader ****** -->
    <?php include('layouts/loader.php') ?>
    
    <!-- ***** Navigation ****** -->
    <?php include('layouts/navigation.php') ?>

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" style="background-image: url(assets/images/bg3.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content">
                        <div class="message_1">
                            <i class="fa-solid fa-arrow-right"></i>
                            <h6>We got you everywhere</h6>
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        
                        <h2>Looking for Available Rooms?</h2>
                        <div class="main-white-button" style="margin-bottom:4rem">
                        <a type="button" class="btn btn-sm" id="rs-btn" href="../room_rover/login.php">
                               Browse now!</a>
                          
                        </div>
                        </div>
                        <div class="next-show" style="margin-left:-3%">
                            <i class="fa fa-arrow-up"></i>
                            <span>Scroll Up</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


<!-- ********* MAIN CONTENT ********* -->
<div class="main" style="height:auto; background-color:#656C74; padding:1rem; padding-bottom:5rem;">
    <div class="col-lg-12">
        <div class="section-heading">
            <h2 style="color:#FFFFFF">Available Rooms</h2>
        </div>
    </div>

    <div class="cards-container">
        <?php
        if (!empty($rooms)) {
            foreach ($rooms as $room) {
                ?>
                <article class="card">
                    <div class="temporary_text">
                        <?php
                        // Debugging statement
                        ?>
                        <img src="<?php echo $BASE_URL . 'backend/api/uploads/OWNER' . $room['owner_id'] . '/' . $room['pic']; ?>" alt="<?php echo $room['name']; ?>">
                    </div>

                    <div class="card_content">
                        <span class="card_title"><?php echo $room['name']; ?></span>
                        <span class="card_subtitle">Available Slot: <?php echo $room['rooms_Available']; ?></span>
                        <p class="card_description"><?php echo $room['location']; ?></p>
                        <div class="reserve">
                            <a href="../room_rover/login.php" class="learn-more reserve-btn">
                                <span class="circle" aria-hidden="true">
                                    <span class="icon arrow"></span>
                                </span>
                                <span class="button-text">Reserve</span>
                            </a>
                        </div>
                    </div>
                </article>
            <?php
            }
        } else {
            echo "No rooms available";
        }
        ?>
    </div>
    
    <!-- ********* END OF MAIN CONTENT ********* -->

    <!-- Pagination -->
    <div class="pagination">
        <?php
        // Calculate the total number of pages
        $totalPages = ceil(count($rooms) / $roomsPerPage);

        // Display pagination links
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=$i'>$i</a> ";
        }
        ?>
    </div>
</div>



    <!-- *** Footer *** -->
    <?php include('layouts/footer.php') ?>




  </body>
</html>