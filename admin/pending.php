<?php 

$sqlQueryActive = "SELECT * FROM accounts, users where users.session_id = accounts.session_id and user_type = 'owner' and status = 'pending';";
$runQueryActive = mysqli_query($conn, $sqlQueryActive);

?>
<div class="row">
  <div class="col-xl-12 col-xxl-12">
    <div class="row">
      <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Pending</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table header-border" id="pendingTable">
                <thead>
                  <tr>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (mysqli_num_rows($runQueryActive) >= 1) {
                    while ($row = mysqli_fetch_assoc($runQueryActive)) {
                      echo '<tr>';
                      echo '<td>' . $row['fullname'] . '</td>';
                      echo '<td>' . $row['email'] . '</td>';
                      echo '<td>' . '<button class="btn btn-sm btn-secondary approve">Approve</button>' . '</td>';
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