<?php
session_start();
require_once('../DBconn.php');

if(isset($_FILES["listingpic"]) && isset($_FILES["ewallet_qr_code"])){
    $ewalletQrCode = $_FILES["ewallet_qr_code"];
    $image  = $_FILES["listingpic"];
    $folder = __DIR__."/uploads/OWNER".$_SESSION['id']."/";
    $target = $folder.$image["name"];
    $ewalletTarget = $folder.$ewalletQrCode["name"]; // Add this line to define $ewalletTarget

    if (!file_exists($folder)) {
        @mkdir($folder, 0755, true);
    }

    if (move_uploaded_file($image["tmp_name"], $target) && move_uploaded_file($ewalletQrCode["tmp_name"], $ewalletTarget)) {
        $li_name = $_POST['li_name'];
        $li_wal = $_POST['li_wal'];
        $ewalletQrCode = $ewalletQrCode['name'];
        $li_loc = $_POST['li_loc'];
        $price = $_POST['price'];
        $rooms = $_POST['rooms'];
        $pic = $image['name'];
        $we = $_POST['we'];
        $aircon = $_POST['aircon'];
        $wifi = $_POST['wifi'];
        $own_cr = $_POST['own_cr'];
        $date = date("F j, Y");

        $query = "INSERT into tbl_listings(name,e_wallet,qr_pic,location,owner_id,price,rooms_Available,is_aircon,free_water_electric,free_wifi,own_cr,pic,date_added) 
            VALUES (:li_name,:li_wal,:qr_pic,:li_loc,:owner_id,:price,:rooms_Available,:aircon,:we,:wifi,:own_cr,:pic,:date_added)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':li_name', $li_name, PDO::PARAM_STR);
        $stmt->bindParam(':li_wal', $li_wal, PDO::PARAM_STR);
        $stmt->bindParam(':qr_pic', $ewalletQrCode, PDO::PARAM_STR);
        $stmt->bindParam(':li_loc', $li_loc, PDO::PARAM_STR);
        $stmt->bindParam(':owner_id', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':rooms_Available', $rooms, PDO::PARAM_INT);
        $stmt->bindParam(':we', $we, PDO::PARAM_INT);
        $stmt->bindParam(':wifi', $wifi, PDO::PARAM_INT);
        $stmt->bindParam(':aircon', $aircon, PDO::PARAM_INT);
        $stmt->bindParam(':own_cr', $own_cr, PDO::PARAM_INT);
        $stmt->bindParam(':pic', $pic, PDO::PARAM_STR);
        $stmt->bindParam(':date_added', $date, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt) {
            echo json_encode(array(
                "error" => 0,
                "message" => "Success"
            ));
        } else {
            echo json_encode(array(
                "error" => 1,
                "message" => "Query Error!"
            ));
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
?>
