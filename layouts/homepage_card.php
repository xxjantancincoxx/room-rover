<?php

require_once('backend/DBconn.php');

$listingsSql = "SELECT * FROM tbl_listings LIMIT 3";
$temp_result = mysqli_query($conn, $listingsSql);
?>

<div class="container mb-5">

  <div class="section-heading">
    <h2>Available Boarding Houses</h2>
  </div>

  <div class="row">
    <?php
    while ($row = mysqli_fetch_assoc($temp_result)) {
      $obj = json_decode($row["pic"]);
      $pic1 = null;
      foreach ($obj as $key => $value) {
        $pic1 = $value;
        break;
      }
      $src = "/room-rover/backend/api/uploads/OWNER" . $row['owner_id'] . "/" . $pic1;
    ?>
      <div class="col col-sm-4">
        <div class="card pb-0" style="width: 18rem;height: auto;">
          <img class="card-img-top border-bottom" width="286" height="180" src="<?php echo $src; ?>" alt="<?php echo $row["name"]; ?>">
          <div class="card-body pb-0 mb-0">
            <h5 class="card-title"><?php echo $row["name"]; ?></h5>
            <ul style="list-style-type:disc;">
              <li>Location: <?php echo $row["location"]; ?></li>
              <li>Price: <?php echo $row["price"]; ?></li>
              <li>Rooms Available: <?php echo $row["rooms_Available"]; ?></li>
              <li>Date: <?php echo $row["date_added"]; ?></li>

            </ul>
            
            <div style="position: absolute; bottom: 20; width: 85%;"><a href="login.php" class="btn btn-primary btn-block">View More Details</a></div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  <!-- Card deck -->
</div>