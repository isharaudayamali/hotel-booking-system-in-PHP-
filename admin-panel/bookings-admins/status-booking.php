<?php require '../layouts/header.php'; ?>
<?php require "../../config/config.php" ?>

<?php

if (isset($_GET['id'])) {


  $hotel_id = $_GET['id'];

  if (isset($_POST['submit'])) {
    if (!isset($_POST['status']) || $_POST['status'] === '' || $_POST['status'] === 'Choose Status') {
      echo "<script>alert('Please select a valid status.');</script>";
    } else {
      $status = $_POST['status'];

      $update = $conn->prepare("UPDATE bookings SET status = :status WHERE id = :id");

      $update->execute([
        ":status" => $status,
        ":id" => $hotel_id
      ]);

      echo "<script>alert('Status updated successfully!'); window.location.href='show-bookings.php';</script>";
      exit;
    }
  }
}
?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Update Status</h5>
        <form method="POST" action="status-booking.php?id=<?php echo $hotel_id; ?>" enctype="multipart/form-data">
          <!-- Email input -->
          <select name="status" style="margin-top: 15px;" class="form-control">
            <option>Choose Status</option>
            <option value="pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Cancelled">Cancelled</option>
            <option value="Completed">Completed</option>
          </select>


          <!-- Submit button -->
          <button style="margin-top: 10px;" type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


        </form>

      </div>
    </div>
  </div>
</div>

<?php require '../layouts/footer.php'; ?>