<?php require 'layouts/header.php'; ?>
<?php require '../config/config.php'; ?>
<?php 

if (!isset($_SESSION['adminname'])) {
  echo "<script>window.location.href='" . ADMINURL . "admins/login-admins.php';</script>";
}

$hotels = $conn->query("SELECT COUNT(*) as total FROM hotels");
$rooms = $conn->query("SELECT COUNT(*) as total FROM rooms");
$admins = $conn->query("SELECT COUNT(*) as total FROM admins");
$bookings = $conn->query("SELECT COUNT(*) as total FROM bookings");

$hotelsCount = $hotels->fetch(PDO::FETCH_ASSOC)['total'];
$roomsCount = $rooms->fetch(PDO::FETCH_ASSOC)['total'];
$adminsCount = $admins->fetch(PDO::FETCH_ASSOC)['total'];
$bookingsCount = $bookings->fetch(PDO::FETCH_ASSOC)['total'];

?>
            
      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Hotels</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of hotels: <?php echo $hotelsCount; ?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rooms</h5>

              <p class="card-text">number of rooms: <?php echo $roomsCount; ?></p>

            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>

              <p class="card-text">number of admins: <?php echo $adminsCount; ?></p>

            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Bookings</h5>

              <p class="card-text">number of bookings: <?php echo $bookingsCount; ?></p>

            </div>
          </div>
        </div>
      </div>
   
<?php require 'layouts/footer.php'; ?>