<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>


<?php
//hotels
	$hotels = $conn->query("SELECT * FROM hotels WHERE status = 1");
	$hotels->execute();

	$allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);

	//rooms
	$rooms = $conn->query("SELECT * FROM rooms WHERE status = 1");
	$rooms->execute();

	$allRooms = $rooms->fetchAll(PDO::FETCH_OBJ);

?>

    <div class="hero-wrap js-fullheight" style="background-image: url('images/image_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">
          	<h2 class="subheading">Welcome to Vacation Rental</h2>
          	<h1 class="mb-4">Rent an appartment for your vacation</h1>
            <p><a href="#" class="btn btn-primary">Learn more</a> <a href="<?php echo APPURL;?>/contact.php" class="btn btn-white">Contact us</a></p>
          </div>
        </div>
      </div>
    </div>

  
    <section class="ftco-section ftco-services">
    	<div class="container">
    		<div class="row">
				<?php foreach($allHotels as $hotel): ?>
          <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
            <div class="d-block services-wrap text-center">
              <div class="img" style="background-image: url(admin-panel/hotels-admins/hotels-images/<?php echo $hotel->image; ?>);"></div>
              <div class="media-body py-4 px-3">
                <h3 class="heading"><?php echo $hotel->name; ?></h3>
                <p><?php echo $hotel->description; ?></p>
                <p>Location: <?php echo $hotel->location ?></p>
				<p><a href="rooms.php?id=<?php echo $hotel->id; ?>" class="btn btn-primary">View rooms</a></p>
              </div>
            </div>      
          </div>
		  <?php endforeach; ?>
        </div>
    	</div>
    </section>

    <section class="ftco-section bg-light">
			<div class="container-fluid px-md-0">
				<div class="row no-gutters justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2>Apartment Room</h2>
          </div>
        </div>
				<div class="row no-gutters">
<?php foreach($allRooms as $room): ?>
    			<div class="col-lg-6">
    				<div class="room-wrap d-md-flex">
    					<a href="#" class="img" style="background-image: url(images/<?php echo $room->image; ?>);"></a>
    					<div class="half left-arrow d-flex align-items-center">
    						<div class="text p-4 p-xl-5 text-center">
    							<p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>
    							<!-- <p class="mb-0"><span class="price mr-1">$120.00</span> <span class="per">per night</span></p> -->
	    						<h3 class="mb-3"><a href="<?php echo APPURL;?>/rooms/room-single.php?id=<?php echo $room->id; ?>"><?php echo $room->name; ?></a></h3>
	    						<ul class="list-accomodation">
	    							<li><span>Max:</span><?php echo $room->num_persons; ?></li>
	    							<li><span>Size:</span><?php echo $room->size; ?></li>
	    							<li><span>View:</span> <?php echo $room->view; ?></li>
	    							<li><span>Bed:</span> <?php echo $room->num_beds; ?></li>
									<li><span>Price Per Night:</span> $ <?php echo $room->price; ?></li>
	    						</ul>
	    						<p class="pt-1"><a href="<?php echo APPURL;?>/rooms/room-single.php?id=<?php echo $room->id; ?>" class="btn-custom px-3 py-2">View Room Details <span class="icon-long-arrow-right"></span></a></p>
    						</div>
    					</div>
    				</div>
    			</div>

<?php endforeach; ?>
    		</div>
			</div>
		</section>



    <section class="ftco-section bg-light">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-6 wrap-about">
						<div class="img img-2 mb-4" style="background-image: url(images/image_2.jpg);">
						</div>
						<h2>The most recommended vacation rental</h2>
						<p>While there are lots of creative and luxurious amenities examples hotels are known for, a comfortable 
							stay for your guests always starts with the essential ones. The useful facilities in a hotel range 
							from personal care items to free parking & Wi-Fi. As hotel essentials, they are expected by guests in 
							the rooms in all cases. Thus, the amenities hotel offers that are listed below can often heavily influence 
							the first impression your guests have.</p>
					</div>
					<div class="col-md-6 wrap-about ftco-animate">
	          <div class="heading-section">
	          	<div class="pl-md-5">
		            <h2 class="mb-2">What we offer</h2>
	            </div>
	          </div>
	          <div class="pl-md-5">
							<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
							<div class="row">
		            <!-- <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-diet"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Tea Coffee</h3>
		                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
		              </div>
		            </div>  -->
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-workout"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Free parking space</h3>
		                <p>providing a safe parking space for your guests is a must. Furthermore, if you run a hotel providing a luxury environment, consider investing in valet parking. It will increase your guests’ trust and loyalty even further.</p>
		              </div>
		            </div>
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-diet-1"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Laundry & Ironing</h3>
		                <p>Washing and ironing services are essential for guest comfort, especially for those on extended stays. Providing these amenities can significantly enhance your hotel's reputation.</p>
		              </div>
		            </div>      
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-first"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Air Conditioning</h3>
		                <p>Ensuring the best climate in all hotel rooms can’t be done without air conditioning equipment. Guests usually stay at your hotel in the warm or cold seasons, providing them with properly functioning heating and air conditioning amenities examples is as important as delivering fresh bed linens daily.</p>
		              </div>
		            </div>
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-first"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Free Wifi</h3>
		                <p>Access to a hotel’s Wi-Fi network is arguably one of the most widespread hotel essentials today. Whether your guests are traveling on business or for local sightseeing, when staying at a hotel everyone expects a free & stable Wi-fi connection available at all times.</p>
		              </div>
		            </div> 
		            <!-- <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-first"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Kitchen</h3>
		                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
		              </div>
		            </div>  -->
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-first"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Free breakfast</h3>
		                <p>To provide this kind of convenience is a free breakfast. Note that some hotels may provide breakfast for free depending 
							on the star rating. Still, this amenity ensures that your day will start on a high note.</p>
		              </div>
		            </div> 
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-first"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">TV & telephone</h3>
		                <p>Providing a TV and telephone in each room is essential for guest comfort. While many guests may have their own devices, having a reliable landline and a TV with various channels can enhance their stay.</p>
		              </div>
		            </div>
		          </div>  
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="ftco-intro" style="background-image: url(images/image_2.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-9 text-center">
						<h2>Ready to get started</h2>
						<p class="mb-4">It’s safe to book online with us! Get your dream stay in clicks or drop us a line with your questions.</p>
						<p class="mb-0"><a href="<?php echo APPURL;?>/about.php" class="btn btn-primary px-4 py-3">Learn More</a> <a href="#" class="btn btn-white px-4 py-3">Contact us</a></p>
					</div>
				</div>
			</div>
		</section>


   <?php require "includes/footer.php"; ?>