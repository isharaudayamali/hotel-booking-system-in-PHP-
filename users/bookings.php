<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>

<?php

if(!isset($_SESSION['user_id'])){
    echo "<script>window.location.href = '".APPURL."';</script>";
}

if (!isset($_SESSION['user_id'])) {
    $id = $_GET['id'];
    
    if($_SESSION['id'] != $id){
        echo "<script>window.location.href = '".APPURL."';</script>";
    }
}

// Check if user is logged in
if (isset($_GET['id'])) {
    $id=$_GET['id'];

    $bookings = $conn->query("SELECT * FROM bookings WHERE user_id = '$id'");
    $bookings->execute();
    $allBookings = $bookings->fetchAll(PDO::FETCH_OBJ);
} else {
    echo "<script>window.location.href = '".APPURL."/404.php';</script>";
}
?>
<div class="container">
  <?php if(count($allBookings) > 0): ?>
    <h2 class="mt-5 text-center">My Bookings</h2>
<table class="table mt-5">
  <thead>
    <tr>
      
      <th scope="col">check in</th>
      <th scope="col">check out</th>
      <th scope="col">email</th>
      <th scope="col">phone number</th>
      <th scope="col">full name</th>
      <th scope="col">hotel name</th>
      <th scope="col">room name</th>
      <th scope="col">status</th>
      <th scope="col">payment</th>
      <th scope="col">create at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($allBookings as $booking): ?>
    <tr>
      <td><?php echo $booking->check_in; ?></td>
      <td><?php echo $booking->check_out; ?></td>
      <td><?php echo $booking->email; ?></td>
      <td><?php echo $booking->phone_number; ?></td>
      <td><?php echo $booking->full_name; ?></td>
      <td><?php echo $booking->hotel_name; ?></td>
      <td><?php echo $booking->room_name; ?></td>
      <td><?php echo $booking->status; ?></td>
      <td><?php echo $booking->payment; ?></td>
      <td><?php echo $booking->create_at; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
    <div class="alert alert-primary mt-5" role="alert">No Bookings Found</div>
<?php endif; ?>

</div>

<?php require "../includes/footer.php" ?>
