<?php require_once '../config/config.php'; ?>
<?php require_once '../includes/header.php'; ?>

<?php

//rooms by hotel id

if (isset($_GET['id'])) {

	$id = $_GET['id'];

	$getRooms = $conn->query("SELECT * FROM rooms WHERE status = 1 AND hotel_id = '$id'");
	$getRooms->execute();

	$getAllRooms = $getRooms->fetchAll(PDO::FETCH_OBJ);
}

//get room by id
if (isset($_GET['id'])) {
	$room_id = $_GET['id'];

	$room = $conn->query("SELECT * FROM rooms WHERE status = 1 AND id = '$room_id'");
	$room->execute();

	$singleRoom = $room->fetch(PDO::FETCH_OBJ);

	//utilities
	$utilities = $conn->query("SELECT * FROM utilities WHERE room_id = '$room_id'");
	$utilities->execute();

	$allUtilities = $utilities->fetchAll(PDO::FETCH_OBJ);

	if (isset($_POST['submit'])) {


		// 1. Check for empty fields first
		if (empty($_POST['email']) or empty($_POST['full_name']) or empty($_POST['phone_number']) or empty($_POST['check_in']) or empty($_POST['check_out'])) {
			echo "<script>alert('Please fill in all fields.')</script>";
		} else {
			// 2. Get today's date (at the beginning of the day) and the input dates as timestamps
			$today_ts = strtotime('today');
			$check_in_ts = strtotime($_POST['check_in']);
			$check_out_ts = strtotime($_POST['check_out']);

			// 3. Perform clear and reliable date validation
			if ($check_in_ts < $today_ts) {
				// Check-in date cannot be in the past
				echo "<script>alert('Check-in date cannot be in the past.')</script>";
			} elseif ($check_in_ts >= $check_out_ts) {
				// Check-in date must be before the check-out date
				echo "<script>alert('Check-out date must be after the check-in date.')</script>";
			} else {

				// 4. If all checks pass, proceed with the database insertion
				// Convert UI dates (e.g., m/d/Y) to MySQL format Y-m-d
				$check_in_for_db = date('Y-m-d', $check_in_ts);
				$check_out_for_db = date('Y-m-d', $check_out_ts);
				$email = $_POST['email'];
				$phone_number = $_POST['phone_number']; // maps to DB column 'phone'
				$full_name = $_POST['full_name'];       // maps to DB column 'fullname'
				$room_name = $singleRoom->name;
				$hotel_name = $singleRoom->hotel_name;
				$status = "pending";

				// Calculate total price = price per night * number of nights
				$inDateObj = (new DateTime())->setTimestamp($check_in_ts);
				$outDateObj = (new DateTime())->setTimestamp($check_out_ts);
				$nights = (int)$inDateObj->diff($outDateObj)->format('%a');
				if ($nights < 1) {
					$nights = 1;
				}
				$totalPrice = (float)$singleRoom->price * $nights;
				// Store for payment page (formatted as string with 2 decimals)
				$_SESSION['price'] = number_format($totalPrice, 2, '.', '');

				// Ensure user is logged in
				if (empty($_SESSION['user_id'])) {
					echo "<script>alert('Please log in to book a room.'); window.location.href='" . APPURL . "/auth/login.php';</script>";
					exit;
				}
				$user_id = $_SESSION['user_id'];

				// keep $_SESSION['price'] set to total (do not override)

				// Sanitize and validate phone number to avoid DB errors (too long or invalid characters)
				$phone_number = trim($_POST['phone_number']);
				// Allow digits, spaces, plus, hyphen and parentheses only
				$phone_number = preg_replace('/[^0-9\+\-\(\) ]/', '', $phone_number);
				$maxPhoneLen = 20; // adjust if your DB column is larger
				if (strlen($phone_number) > $maxPhoneLen) {
					echo "<script>alert('Phone number too long (max {$maxPhoneLen} characters). Please shorten it.')</script>";
				} elseif (!preg_match('/^[0-9\+\-\(\) ]+$/', $phone_number)) {
					echo "<script>alert('Phone number contains invalid characters. Only digits, space, +, -, ( and ) are allowed.')</script>";
				} else {
					// Use column names that match your table: full_name, phone_number
					$booking = $conn->prepare("INSERT INTO bookings (user_id, hotel_name, room_name, email, full_name, phone_number, check_in, check_out, status, payment)
					 VALUES(:user_id, :hotel_name, :room_name, :email, :full_name, :phone_number, :check_in, :check_out, :status, :payment)");

					try {
						$booking->execute([
							':user_id' => $user_id,
							':hotel_name' => $hotel_name,
							':room_name' => $room_name,
							':email' => $email,
							':full_name' => $full_name,
							':phone_number' => $phone_number,
							':check_in' => $check_in_for_db,
							':check_out' => $check_out_for_db,
							':status' => $status,
							':payment' => $_SESSION['price']

						]);

						// Add a success message and redirect to payment
						echo "<script>alert('Booking successful!')</script>";
						echo "<script>window.location.href='" . APPURL . "/rooms/pay.php';</script>";
					} catch (PDOException $e) {
						// Log the error for the developer and show a generic message to the user
						error_log('Booking insert error: ' . $e->getMessage());
						echo "<script>alert('Booking failed on server. Please try again later.')</script>";
					}
				}
			}
		}
	}
} else {
	echo "<script>window.location.href='" . APPURL . "/404.php'</script>";
}

?>

<div class="hero-wrap js-fullheight" style="background-image: url(<?php echo APPURL; ?>/images/<?php echo $singleRoom->image; ?>);" data-stellar-background-ratio="0.5">

	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
			<div class="col-md-7 ftco-animate">
				<h2 class="subheading">Welcome to Vacation Rental</h2>
				<h1 class="mb-4"><?php echo $singleRoom->name; ?></h1>
				<!-- <p><a href="#" class="btn btn-primary">Learn more</a> <a href="#" class="btn btn-white">Contact us</a></p> -->
			</div>
		</div>
	</div>
</div>

<section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-lg-4">
				<form action="room-single.php?id=<?php echo $room_id; ?>" method="POST" class="appointment-form" style="margin-top: -568px;">
					<h3 class="mb-3">Book this room</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" name="email" class="form-control" placeholder="Email">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="text" name="full_name" class="form-control" placeholder="Full Name">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="input-wrap">
									<div class="icon"><span class="ion-md-calendar"></span></div>
									<input type="text" name="check_in" class="form-control appointment_date-check-in" placeholder="Check-In">
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="icon"><span class="ion-md-calendar"></span></div>
								<input type="text" name="check_out" class="form-control appointment_date-check-out" placeholder="Check-Out">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" name="submit" value="Book and Pay Now" class="btn btn-primary py-3 px-4">
							</div>
						</div>


					</div>
				</form>
			</div>
		</div>
	</div>
</section>


<section class="ftco-section bg-light">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-md-6 wrap-about">
				<div class="img img-2 mb-4" style="background-image: url(<?php echo APPURL; ?>/images/image_2.jpg);">
				</div>
				<h2>The most recommended vacation rental</h2>
				<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
			</div>
			<div class="col-md-6 wrap-about ftco-animate">
				<div class="heading-section">
					<div class="pl-md-5">
						<h2 class="mb-2">What we offer</h2>
					</div>
				</div>
				<div class="pl-md-5">
					<?php foreach ($getAllRooms as $room): ?>
					<p><?php echo $room->description; ?></p>
					<?php endforeach; ?>
					<div class="row">
						<?php foreach ($allUtilities as $utility): ?>
							<div class="services-2 col-lg-6 d-flex w-100">
								<div class="icon d-flex justify-content-center align-items-center">
									<span class="<?php echo $utility->icon; ?>"></span>
								</div>
								<div class="media-body pl-3">
									<h3 class="heading"><?php echo $utility->name; ?></h3>
									<p><?php echo $utility->description; ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-intro" style="background-image: url(<?php echo APPURL; ?>/images/image_2.jpg);" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-9 text-center">
				<h2>Ready to get started</h2>
				<p class="mb-4">It’s safe to book online with us! Get your dream stay in clicks or drop us a line with your questions.</p>
				<p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Learn More</a> <a href="#" class="btn btn-white px-4 py-3">Contact us</a></p>
			</div>
		</div>
	</div>
</section>

<?php require_once '../includes/footer.php'; ?>