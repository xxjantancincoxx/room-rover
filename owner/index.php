<!DOCTYPE html>
<html>
<?php

session_start();

if (isset($_SESSION["username"])) {
  if ($_SESSION["user_type"] === "boarder") {
      header("Location: /room-rover/boarder?session=" . $_SESSION["session"]);
      exit();
  } else if ($_SESSION["user_type"] === "owner") {
      header("Location: /room-rover/owner?session=" . $_SESSION["session"]);
      exit();
  } else if ($_SESSION["user_type"] === "admin") {
      header("Location: /room-rover/admin?session=" . $_SESSION["session"]);
      exit();
  }
}

if (!isset($_SESSION["id"])) {
  header("Location: ../login.php");
  exit();
}

require_once('../backend/DBconn.php');
include('header.php');
?>
<style>
  #content {
    width: 100%;
    padding: 20px;
    min-height: 100vh;
    transition: all 0.3s;
  }
</style>

<body>
  <div class="wrapper">

    <?php include('sidebar.php') ?>

    <div id="content">

      <?php include('../layouts/navbar.php') ?>
      <?php include('dashboard_content.php') ?>
    </div>
  </div>

</body>

</html>