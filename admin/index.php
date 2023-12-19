<!DOCTYPE html>
<html lang="en">
<?php

session_start();

$_SESSION["username"] = "Juan";
$_SESSION["session"] = session_create_id(true);

// if (!isset($_SESSION["session_id"])) {
//     header("Location: ../index.php");
//     exit();
// }

include('header.php')
?>

<body>
    <div class="wrapper">

        <?php include('sidebar.php') ?>

        <div id="content">

            <?php include('../layouts/navbar.php') ?>

            <!-- < ?php include('dashboard_content.php') ?> -->
        </div>
    </div>
    <style ></style>
</body>

</html>