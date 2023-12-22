<?php
session_start();
require_once('../DBconn.php');

if (isset($_FILES["listingpic"]) && isset($_FILES["ewallet_qr_code"])) {

  $folder = __DIR__ . "/uploads/OWNER" . $_SESSION['id'] . "/";
  $total = count($_FILES['listingpic']['name']);
  $listing_pic_array = array();

  for ($i = 0; $i < $total; $i++) {


    // //Get the temp file path
    $tmpFilePath = $_FILES['listingpic']['tmp_name'][$i];

    // //Make sure we have a file path
    if ($tmpFilePath != "") {
      //Setup our new file path

      $newFilePath = $folder . $_FILES['listingpic']['name'][$i];

      //   //Upload the file into the temp dir
      if (move_uploaded_file($tmpFilePath, $newFilePath)) {
        $listing_pic_array["name" . $i] = $_FILES['listingpic']['name'][$i];
      }
    }
  }

  $ewalletQrCode = $_FILES["ewallet_qr_code"];
  $ewalletTarget = $folder . $ewalletQrCode["name"]; // Add this line to define $ewalletTarget

  if (!file_exists($folder)) {
    @mkdir($folder, 0755, true);
  }

  if ($loop_counter === $loop_counter && move_uploaded_file($ewalletQrCode["tmp_name"], $ewalletTarget)) {
    $li_name = $_POST['li_name'];
    $li_wal = $_POST['li_wal'];
    $ewalletQrCode = $ewalletQrCode['name'];
    $li_loc = $_POST['li_loc'];
    $price = $_POST['price'];
    $rooms = $_POST['rooms'];
    $pic = json_encode($listing_pic_array);
    $we = $_POST['we'];
    $aircon = $_POST['aircon'];
    $wifi = $_POST['wifi'];
    $own_cr = $_POST['own_cr'];
    $owner_id = $_SESSION["id"];
    $date = date("F j, Y");

    $query = "INSERT into tbl_listings(name,e_wallet,qr_pic,location,rooms_Available,owner_id,price,is_aircon,free_water_electric,free_wifi,own_cr,pic,date_added) 
            VALUES ('$li_name','$li_wal','$ewalletQrCode','$li_loc','$rooms','$owner_id','$price','$aircon','$we','$wifi','$own_cr','$pic','$date');";

    if (mysqli_query($conn, $query) === TRUE) {
      echo "Success!";
      header("Location: ../../owner/index.php?session=" . $_SESSION["session_id"]);
      exit();
    } else {
      echo "Failed!";
    }
  } else {
    echo json_encode(array(
      "error" => 1,
      "message" => "File upload Error"
    ));
  }
} else {
  echo "error";
}
