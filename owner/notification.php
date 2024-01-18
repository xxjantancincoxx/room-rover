<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once('../backend/DBconn.php');
include('header.php');

$userId = $_SESSION['id'];

$terminate = "SELECT u.fullname, t.reason, t.date, tl.name FROM `terminate` t
              INNER JOIN `accounts` acc
              ON acc.id = t.boarder_id
              INNER JOIN `users` u
              ON u.session_id = acc.session_id
              INNER JOIN tbl_reservations tr
              ON tr.uid = t.boarder_id
              INNER JOIN tbl_listings tl
              ON tl.listing_id = tr.lid
              WHERE t.boarder_id = ( SELECT boarder_id FROM `terminate` WHERE owner_id = $userId)";

$terminate_temp = mysqli_query($conn, $terminate);

?>


<body>

  <div class="wrapper">
    <?php include('sidebar.php') ?>

    <div id="content">
      <?php include('../layouts/navbar.php') ?>

      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-12 col-xxl-12">
            <div class="row">
              <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Terminate</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table header-border" id="Orating">
                        <thead>
                          <tr>
                            <th>Boarder's Name</th>
                            <th>Listing Name</th>
                            <th>Reason</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (mysqli_num_rows($terminate_temp) >= 1) {
                            while ($row = mysqli_fetch_assoc($terminate_temp)) {
                              echo '<tr>';
                              echo '<td>' . $row['fullname'] . '</td>';
                              echo '<td>' . $row['name'] . '</td>';
                              echo '<td>' . $row['reason'] . '</td>';
                              echo '<td>' . date("d-m-Y", strtotime($row['date'])) . '</td>';
                              echo '</tr>';
                            }
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- SweetAlert JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#Orating').DataTable({});
      $('#reviewOwners').DataTable({});
    });
  </script>
</body>

</html>