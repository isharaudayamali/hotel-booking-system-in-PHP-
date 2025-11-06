<?php require_once 'includes/header.php'; ?>
<?php require_once 'config/config.php'; ?>

<?php
// Get general utilities/amenities (room_id = 0 or NULL for global services)
$utilities = $conn->query("SELECT * FROM utilities WHERE room_id IS NULL OR room_id = 0 ORDER BY name");
$utilities->execute();

$allUtilities = $utilities->fetchAll(PDO::FETCH_OBJ);
?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/image_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs mb-2"><span class="mr-2"><a href="<?php echo APPURL; ?>">Home <i class="fa fa-chevron-right"></i></a></span> <span>Services <i class="fa fa-chevron-right"></i></span></p>
        <h1 class="mb-0 bread">Services</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
        <div class="d-block services-wrap text-center">
          <div class="img" style="background-image: url(images/services-1.jpg);"></div>
          <div class="media-body py-4 px-3">
            <h3 class="heading">Map Direction</h3>
            <p>Get easy-to-follow directions to our hotel with detailed maps, GPS coordinates, and landmark references. We provide comprehensive navigation assistance from airports, train stations, and major highways to ensure your smooth arrival.</p>
            <p><a href="<?php echo APPURL; ?>/contact.php" class="btn btn-primary">View Map</a></p>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
        <div class="d-block services-wrap text-center">
          <div class="img" style="background-image: url(images/services-2.jpg);"></div>
          <div class="media-body py-4 px-3">
            <h3 class="heading">Accommodation Services</h3>
            <p>Experience comfortable and luxurious stays with our diverse range of rooms and suites. From budget-friendly options to premium accommodations, each room features modern amenities, complimentary WiFi, and 24/7 housekeeping services for your ultimate comfort.</p>
            <p><a href="<?php echo APPURL; ?>/index.php" class="btn btn-primary">View Rooms</a></p>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
        <div class="d-block services-wrap text-center">
          <div class="img" style="background-image: url(images/image_2.jpg);"></div>
          <div class="media-body py-4 px-3">
            <h3 class="heading">Great Experience</h3>
            <p>Create unforgettable memories with our exceptional hospitality and personalized services. From stunning views and gourmet dining to recreational activities and cultural tours, we ensure every moment of your stay exceeds expectations and leaves lasting impressions.</p>
            <p><a href="<?php echo APPURL; ?>/about.php" class="btn btn-primary">Learn More</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light ftco-no-pt">
  <div class="container">
    <div class="row no-gutters justify-content-center pb-5 mb-3">
      <div class="col-md-7 heading-section text-center ftco-animate">
        <h2>Amenities</h2>
      </div>
    </div>
    <div class="row">
      <?php if (!empty($allUtilities)): ?>
        <?php foreach ($allUtilities as $utility): ?>
          <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
            <div class="icon d-flex justify-content-center align-items-center">
              <?php if (str_ends_with($utility->icon, '.svg')): ?>
                <img src="<?php echo APPURL; ?>/images/icons/<?php echo htmlspecialchars($utility->icon); ?>" alt="<?php echo htmlspecialchars($utility->name); ?>" class="icon-svg">
              <?php else: ?>
                <span class="<?php echo htmlspecialchars($utility->icon); ?>"></span>
              <?php endif; ?>
            </div>
            <div class="media-body pl-3">
              <h3 class="heading"><?php echo htmlspecialchars($utility->name); ?></h3>
              <p><?php echo htmlspecialchars($utility->description); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- Fallback content if no utilities found -->
        <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
          <div class="icon d-flex justify-content-center align-items-center">
            <span class="flaticon-diet"></span>
          </div>
          <div class="media-body pl-3">
            <h3 class="heading">Tea Coffee</h3>
            <p>Complimentary tea and coffee service available for all guests</p>
          </div>
        </div>
        <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
          <div class="icon d-flex justify-content-center align-items-center">
            <span class="flaticon-workout"></span>
          </div>
          <div class="media-body pl-3">
            <h3 class="heading">Hot Showers</h3>
            <p>24/7 hot water supply with modern shower facilities</p>
          </div>
        </div>
        <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
          <div class="icon d-flex justify-content-center align-items-center">
            <span class="flaticon-diet-1"></span>
          </div>
          <div class="media-body pl-3">
            <h3 class="heading">Laundry</h3>
            <p>Professional laundry and dry cleaning services available</p>
          </div>
        </div>
        <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
          <div class="icon d-flex justify-content-center align-items-center">
            <span class="flaticon-first"></span>
          </div>
          <div class="media-body pl-3">
            <h3 class="heading">Free WiFi</h3>
            <p>High-speed wireless internet access throughout the property</p>
          </div>
        </div>
        <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
          <div class="icon d-flex justify-content-center align-items-center">
            <span class="flaticon-diet"></span>
          </div>
          <div class="media-body pl-3">
            <h3 class="heading">Air Conditioning</h3>
            <p>Climate controlled rooms with individual temperature settings</p>
          </div>
        </div>
        <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
          <div class="icon d-flex justify-content-center align-items-center">
            <span class="flaticon-workout"></span>
          </div>
          <div class="media-body pl-3">
            <h3 class="heading">Fitness Center</h3>
            <p>Modern gym equipment available 24/7 for guest use</p>
          </div>
        </div>
        <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
          <div class="icon d-flex justify-content-center align-items-center">
            <span class="flaticon-diet-1"></span>
          </div>
          <div class="media-body pl-3">
            <h3 class="heading">Room Service</h3>
            <p>24-hour room service with extensive menu options</p>
          </div>
        </div>
        <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
          <div class="icon d-flex justify-content-center align-items-center">
            <span class="flaticon-first"></span>
          </div>
          <div class="media-body pl-3">
            <h3 class="heading">Parking</h3>
            <p>Secure parking facilities available for all guests</p>
          </div>
        </div>
        <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
          <div class="icon d-flex justify-content-center align-items-center">
            <span class="flaticon-diet"></span>
          </div>
          <div class="media-body pl-3">
            <h3 class="heading">Swimming Pool</h3>
            <p>Outdoor swimming pool with poolside service and loungers</p>
          </div>
        </div>
        <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
          <div class="icon d-flex justify-content-center align-items-center">
            <span class="flaticon-workout"></span>
          </div>
          <div class="media-body pl-3">
            <h3 class="heading">Concierge</h3>
            <p>Professional concierge service for tours and reservations</p>
          </div>
        </div>
        <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
          <div class="icon d-flex justify-content-center align-items-center">
            <span class="flaticon-diet-1"></span>
          </div>
          <div class="media-body pl-3">
            <h3 class="heading">Spa Services</h3>
            <p>Relaxing spa treatments and massage therapy available</p>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>