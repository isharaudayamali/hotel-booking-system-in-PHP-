<?php require '../layouts/header.php'; ?>
<?php require "../../config/config.php" ?>

<?php

// If already logged in, send user to home
if (isset($_SESSION['username'])) {
  echo "<script>window.location.href='" . APPURL . "';</script>";
  exit;
}

if (isset($_POST['submit'])) {
  if (empty($_POST['email']) || empty($_POST['password'])) {
    echo "<script >alert('one or more input are empty')</script>";
  } else {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // validation + secure lookup
    $login = $conn->prepare("SELECT * FROM admins WHERE email = :email LIMIT 1");
    $login->execute(['email' => $email]);
    $fetch = $login->fetch(PDO::FETCH_ASSOC);

    if ($login->rowCount() > 0) {

      if (password_verify($password, $fetch['mypassword'])) {

        $_SESSION['adminname'] = $fetch['adminname'];
        $_SESSION['admin_id'] = $fetch['id'];

        echo "<script>alert('Logged in successfully!'); window.location.href='".ADMINURL."/admin-panel';</script>";
        exit;

      } else {
        echo "<script>alert('email or password is wrong')</script>";
      }
    } else {
      echo "<script>alert('email or password is wrong')</script>";
    }
  }
}

?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mt-5">Login</h5>
        <form method="POST" class="p-auto" action="login-admins.php">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />

          </div>


          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />

          </div>



          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>


        </form>

      </div>
    </div>

    <?php require '../layouts/footer.php'; ?>