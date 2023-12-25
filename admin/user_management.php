<!DOCTYPE html>
<html lang="en">
<?php

session_start();
require_once('../backend/DBconn.php');

include('header.php')
?>
<style>
  ul {
    list-style: none !important;
  }

  .tab-switcher {
    display: inline-block !important;
    cursor: pointer !important;
    margin-right: 25px !important;
  }
</style>

<body>
  <div class="wrapper">

    <?php include('sidebar.php') ?>

    <div id="content">

      <?php include('navbar.php') ?>

      <div>
        <ul class="pl-0">
          <li class="btn btn-md btn-secondary  tab-switcher" data-tab-index="0" tabindex="0">
            Pending Owners
          </li>
          <li class="btn btn-md btn-secondary  tab-switcher" data-tab-index="1" tabindex="0">
            Active Owners
          </li>
          <li class="btn btn-md btn-secondary  tab-switcher" data-tab-index="2" tabindex="0">
            Deactivated Owners
          </li>
        </ul>
        <div id="allTabsContainer">
          <div class="tab-container" data-tab-index="0">
            <?php include("pending.php"); ?>
          </div>
          <div class="tab-container" data-tab-index="1" style="display:none;">
            <?php include("active.php"); ?>
          </div>
          <div class="tab-container" data-tab-index="2" style="display:none;">
            <?php include("deactivate.php"); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Success Updating Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger closeModal" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
</body>

<script>
  $(document).ready(function() {
    $('#reviewsTable').DataTable({});

    $('#pendingTable').DataTable({});
    $('#deactivateTable').DataTable({});

  });

  $(".closeModal").click(function() {
    location.reload();
  });

  $(".approve").click(function(e) {
    $.post("../backend/api/update_status.php", {
        status: "approve",
        id: e.target.previousElementSibling.value
      },
      function(data, status) {
        jQuery.noConflict();
        $('#myModal').modal('show');
      });
  });

  $(".deactivate").click(function(e) {
    $.post("../backend/api/update_status.php", {
        status: "deactivate",
        id: e.target.previousElementSibling.value
      },
      function(data, status) {
        jQuery.noConflict();
        $('#myModal').modal('show');
      });
  });

  $(".activate").click(function(e) {
    $.post("../backend/api/update_status.php", {
        status: "activate",
        id: e.target.previousElementSibling.value
      },
      function(data, status) {
        jQuery.noConflict();
        $('#myModal').modal('show');
      });
  });
</script>

</html>