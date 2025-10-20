<?php require '../layouts/header.php'; ?>
<?php require "../../config/config.php" ?>

<?php

if (isset($_GET['id'])) {


  $hotel_id = $_GET['id'];

  $hotel = $conn->prepare("SELECT * FROM hotels WHERE id = :id LIMIT 1");
  $hotel->execute([":id" => $hotel_id]);

  $hotel = $hotel->fetch(PDO::FETCH_ASSOC);

  if (isset($_POST['submit'])) {
    if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['location'])) {
      echo "<script>alert('Please fill in all fields.');</script>";
    } else {
      $name = $_POST['name'];
      $description = $_POST['description'];
      $location = $_POST['location'];

      $update = $conn->prepare("UPDATE hotels SET name = :name, description = :description, location = :location WHERE id = :id");

      $update->execute([
        ":name" => $name,
        ":description" => $description,
        ":location" => $location,
        ":id" => $hotel_id
      ]);

      echo "<script>alert('Status updated successfully!'); window.location.href='show-hotels.php';</script>";
      exit;
    }
  }
}
?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Hotel</h5>
          <form method="POST" action="update-hotels.php?id=<?php echo $hotel_id; ?>" >
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" value="<?php echo $hotel['name']; ?>" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?php echo $hotel['description']; ?></textarea>
                </div>

                <div class="form-outline mb-4 mt-4">
                  <label for="exampleFormControlTextarea1">Location</label>

                  <input type="text" name="location" id="form2Example1" class="form-control" value="<?php echo $hotel['location']; ?>" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
 
 <?php require '../layouts/footer.php'; ?>